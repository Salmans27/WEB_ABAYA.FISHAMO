<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;

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
        | VALIDASI STOCK
        |--------------------------------------------------------------------------
        */

        if ($request->quantity > $product->stock) {

            return back()->with(
                'error',
                'Stock tidak mencukupi'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CEK PRODUK SUDAH ADA ATAU BELUM
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

            if ($newQty > $product->stock) {

                return back()->with(
                    'error',
                    'Jumlah melebihi stock'
                );
            }

            $existingCart->update([
                'quantity' => $newQty
            ]);

        } else {

            /*
            |--------------------------------------------------------------------------
            | CREATE CART BARU
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
    | DELETE CART ITEM
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
    | CHECKOUT PAGE
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
        $request->validate([
            'product_id' => 'required',
            'size'       => 'required',
            'color'      => 'required',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        /*
        |--------------------------------------------------------------------------
        | VALIDASI STOCK
        |--------------------------------------------------------------------------
        */

        if ($request->quantity > $product->stock) {

            return back()->with(
                'error',
                'Stock tidak mencukupi'
            );
        }

        $checkoutItems = collect([
            (object)[
                'id'       => 0,
                'product'  => $product,
                'size'     => $request->size,
                'color'    => $request->color,
                'quantity' => $request->quantity,
            ]
        ]);

        $total = $product->price * $request->quantity;

        $selectedItems = [];

        return view('checkout.index', compact(
            'checkoutItems',
            'selectedItems',
            'total'
        ));
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
        ]);

        $selectedItems = $request->selected_items ?? [];

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->whereIn('id', $selectedItems)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | VALIDASI CART
        |--------------------------------------------------------------------------
        */

        if ($cartItems->count() == 0) {

            return back()->with(
                'error',
                'Tidak ada produk dipilih'
            );
        }

        $totalPrice = 0;
        $totalItem  = 0;

        /*
        |--------------------------------------------------------------------------
        | LOOP CART
        |--------------------------------------------------------------------------
        */

        foreach ($cartItems as $item) {

            $product = $item->product;

            if (!$product) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | VALIDASI STOCK
            |--------------------------------------------------------------------------
            */

            if ($product->stock < $item->quantity) {

                return back()->with(
                    'error',
                    'Stock produk tidak mencukupi'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | UPDATE PRODUCT
            |--------------------------------------------------------------------------
            */

            $product->stock -= $item->quantity;
            $product->sold  += $item->quantity;

            $product->save();

            /*
            |--------------------------------------------------------------------------
            | TOTAL
            |--------------------------------------------------------------------------
            */

            $totalPrice += (
                $product->price *
                $item->quantity
            );

            $totalItem += $item->quantity;
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE ORDER
        |--------------------------------------------------------------------------
        */

        $order = Order::create([
            'customer_name' => Auth::user()->name,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'total_price'   => $totalPrice,
            'total_item'    => $totalItem,
        ]);

        /*
        |--------------------------------------------------------------------------
        | SIMPAN ORDER ITEMS
        |--------------------------------------------------------------------------
        */

        foreach ($cartItems as $item) {

            if (!$item->product) {
                continue;
            }

            OrderItem::create([

                'order_id'   => $order->id,

                'product_id' => $item->product->id,

                'size'       => $item->size,

                'color'      => $item->color,

                'quantity'   => $item->quantity,

                'price'      => $item->product->price,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | DELETE CART
        |--------------------------------------------------------------------------
        */

        Cart::where('user_id', Auth::id())
            ->whereIn('id', $selectedItems)
            ->delete();

        return redirect('/dashboard')->with(
            'success',
            'Checkout berhasil!'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PESANAN SAYA
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