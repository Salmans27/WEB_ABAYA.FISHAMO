<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\Payment;
use Midtrans\Config;
use Midtrans\Snap;

class CartController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | CART PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $cart = Cart::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('cart.index', compact('cart'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADD TO CART
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'size'       => 'required',
            'color'      => 'required',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        /*
        |--------------------------------------------------------------------------
        | VALIDASI STOCK (PER VARIANT)
        |--------------------------------------------------------------------------
        */

        $variant = ProductVariant::where('product_id', $product->id)
            ->where('size', $request->size)
            ->where('color', $request->color)
            ->first();

        $availableStock = $variant ? $variant->stock : $product->stock;

        if ($request->quantity > $availableStock) {
            return back()->with(
                'error',
                'Stok ukuran ' . $request->size . ' tidak mencukupi (tersisa ' . $availableStock . ')'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CEK CART
        |--------------------------------------------------------------------------
        */

        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->where('size', $request->size)
            ->where('color', $request->color)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | JIKA SUDAH ADA
        |--------------------------------------------------------------------------
        */

        if ($existingCart) {

            $newQty = $existingCart->quantity + $request->quantity;

            if ($newQty > $availableStock) {

                return back()->with(
                    'error',
                    'Jumlah melebihi stok ukuran ' . $request->size . ' (tersisa ' . $availableStock . ')'
                );
            }

            $existingCart->update([
                'quantity' => $newQty
            ]);

        } else {

            /*
            |--------------------------------------------------------------------------
            | CREATE CART
            |--------------------------------------------------------------------------
            */

            Cart::create([
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
                'size'       => $request->size,
                'color'      => $request->color,
                'quantity'   => $request->quantity,
            ]);
        }

        return redirect('/cart')->with(
            'success',
            'Produk berhasil masuk keranjang'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE CART
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->findOrFail($id);

        $cart->delete();

        return back()->with(
            'success',
            'Produk berhasil dihapus'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CHECKOUT CART
    |--------------------------------------------------------------------------
    */

    public function checkout(Request $request)
    {
        $selectedItems = $request->selected_items ?? [];

        $checkoutItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->whereIn('id', $selectedItems)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        if ($checkoutItems->count() == 0) {

            return redirect('/cart')->with(
                'error',
                'Pilih minimal 1 produk'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        $total = 0;

        foreach ($checkoutItems as $item) {

            if ($item->product) {

                $total += (
                    $item->product->price *
                    $item->quantity
                );
            }
        }

        return view('checkout.index', compact(
            'checkoutItems',
            'selectedItems',
            'total'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | DIRECT CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function directCheckout(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | BLOCK GET REQUEST
        |--------------------------------------------------------------------------
        */

        if ($request->isMethod('get')) {

            return redirect('/dashboard');
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'product_id' => 'required',
            'size'       => 'required',
            'color'      => 'required',
            'quantity'   => 'required|integer|min:1',
        ]);

        /*
        |--------------------------------------------------------------------------
        | PRODUCT
        |--------------------------------------------------------------------------
        */

        $product = Product::findOrFail($request->product_id);

        /*
        |--------------------------------------------------------------------------
        | VALIDASI STOCK
        |--------------------------------------------------------------------------
        */

        $variant = ProductVariant::where('product_id', $product->id)
            ->where('size', $request->size)
            ->where('color', $request->color)
            ->first();

        $availableStock = $variant ? $variant->stock : $product->stock;

        if ($request->quantity > $availableStock) {

            return back()->with(
                'error',
                'Stok ukuran ' . $request->size . ' tidak mencukupi (tersisa ' . $availableStock . ')'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CHECKOUT ITEM
        |--------------------------------------------------------------------------
        */

        $checkoutItems = collect([
            (object)[
                'id'       => 0,
                'product'  => $product,
                'size'     => $request->size,
                'color'    => $request->color,
                'quantity' => $request->quantity,
            ]
        ]);

        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        $total = $product->price * $request->quantity;

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('checkout.index', [
            'checkoutItems' => $checkoutItems,
            'selectedItems' => [],
            'total'         => $total,
            'buyNow'        => true,
            'product_id'    => $product->id,
            'size'          => $request->size,
            'color'         => $request->color,
            'quantity'      => $request->quantity,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | PROCESS CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function processCheckout(Request $request)
    {
        $request->validate([
            'phone'          => 'required',
            'address'        => 'required',
            'payment_method' => 'required',
            'proof'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $totalPrice = 0;
        $totalItem  = 0;

        $proofPath = null;
        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('payments', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | BUY NOW
        |--------------------------------------------------------------------------
        */

        if ($request->has('buy_now')) {

            $product = Product::findOrFail($request->product_id);

            // Check variant stock
            $variant = ProductVariant::where('product_id', $product->id)
                ->where('size', $request->size)
                ->where('color', $request->color)
                ->first();

            $availableStock = $variant ? $variant->stock : $product->stock;

            if ($availableStock < $request->quantity) {
                return back()->with('error', 'Stok ukuran ' . $request->size . ' tidak mencukupi (tersisa ' . $availableStock . ')');
            }

            $totalPrice = $product->price * $request->quantity;
            $totalItem  = $request->quantity;

            // Deduct variant stock
            if ($variant) {
                $variant->stock -= $request->quantity;
                $variant->save();
            }
            $product->stock -= $request->quantity;
            $product->sold  += $request->quantity;
            $product->save();

            $fullAddress = $request->address;
            if ($request->country) {
                $fullAddress .= "\nNegara: " . $request->country;
            }
            if ($request->province) {
                $fullAddress .= "\nProvinsi: " . $request->province;
            }

            $order = Order::create([
                'customer_name' => Auth::user()->name,
                'phone'         => $request->phone,
                'address'       => $fullAddress,
                'total_price'   => $totalPrice,
                'total_item'    => $totalItem,
                'status'        => 'pending',
            ]);

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'size'       => $request->size,
                'color'      => $request->color,
                'quantity'   => $request->quantity,
                'price'      => $product->price,
            ]);

            Payment::create([
                'order_id'       => $order->id,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'amount'         => $totalPrice,
                'proof'          => $proofPath,
            ]);

            return redirect('/my-orders')->with('success', 'Checkout berhasil!');

        } else {

            /*
            |--------------------------------------------------------------------------
            | CHECKOUT CART
            |--------------------------------------------------------------------------
            */

            $selectedItems = $request->selected_items ?? [];

            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->whereIn('id', $selectedItems)
                ->get();

            if ($cartItems->count() == 0) {
                return back()->with('error', 'Tidak ada produk dipilih');
            }

            foreach ($cartItems as $item) {
                $product = $item->product;
                if (!$product) continue;

                // Check variant stock
                $variant = ProductVariant::where('product_id', $product->id)
                    ->where('size', $item->size)
                    ->where('color', $item->color)
                    ->first();

                $availableStock = $variant ? $variant->stock : $product->stock;

                if ($availableStock < $item->quantity) {
                    return back()->with('error', 'Stok ukuran ' . $item->size . ' untuk produk ' . $product->name . ' tidak mencukupi (tersisa ' . $availableStock . ')');
                }

                // Deduct variant stock
                if ($variant) {
                    $variant->stock -= $item->quantity;
                    $variant->save();
                }
                $product->stock -= $item->quantity;
                $product->sold  += $item->quantity;
                $product->save();

                $totalPrice += ($product->price * $item->quantity);
                $totalItem += $item->quantity;
            }

            $fullAddress = $request->address;
            if ($request->country) {
                $fullAddress .= "\nNegara: " . $request->country;
            }
            if ($request->province) {
                $fullAddress .= "\nProvinsi: " . $request->province;
            }

            $order = Order::create([
                'customer_name' => Auth::user()->name,
                'phone'         => $request->phone,
                'address'       => $fullAddress,
                'total_price'   => $totalPrice,
                'total_item'    => $totalItem,
                'status'        => 'pending',
            ]);

            foreach ($cartItems as $item) {
                if (!$item->product) continue;

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product->id,
                    'size'       => $item->size,
                    'color'      => $item->color,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);
            }

            Cart::where('user_id', Auth::id())
                ->whereIn('id', $selectedItems)
                ->delete();

            Payment::create([
                'order_id'       => $order->id,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'amount'         => $totalPrice,
                'proof'          => $proofPath,
            ]);

            return redirect('/my-orders')->with('success', 'Checkout berhasil!');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MY ORDERS
    |--------------------------------------------------------------------------
    */

    public function orders()
    {
        $orders = Order::with('items.product')
            ->where('customer_name', Auth::user()->name)
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }
} 