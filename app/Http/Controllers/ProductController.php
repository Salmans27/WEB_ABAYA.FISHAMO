<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST PRODUCT
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::query()

            ->when($search, function ($query) use ($search) {

                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%')
                    ->orWhere('color', 'like', '%' . $search . '%');

            })

            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.products.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'color' => 'nullable|string|max:255',
            'variants' => 'required|array|min:1',
            'variants.*.size' => 'required|string|max:255',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->storeAs(
                'products',
                $imageName,
                'public'
            );

            $imagePath = 'products/' . $imageName;
        }

        $totalStock = 0;
        $sizes = [];
        $colors = [];
        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {
                $totalStock += $variant['stock'];
                $sizes[] = $variant['size'];
                $colors[] = $variant['color'];
            }
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'stock' => $totalStock,
            'image' => $imagePath,
            'size' => implode(', ', array_unique($sizes)),
            'color' => implode(', ', array_unique($colors)),
        ]);

        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {
                $product->variants()->create([
                    'size' => $variant['size'],
                    'stock' => $variant['stock'],
                    'color' => $variant['color'],
                ]);
            }
        }

        return redirect('/admin/products')
            ->with('success', 'Product berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $product = Product::with('variants')->findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'color' => 'nullable|string|max:255',
            'variants' => 'required|array|min:1',
            'variants.*.size' => 'required|string|max:255',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE IMAGE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if (
                $product->image &&
                Storage::disk('public')->exists($product->image)
            ) {

                Storage::disk('public')->delete($product->image);

            }

            $imageName = time() . '.' . $request->image->extension();

            $request->image->storeAs(
                'products',
                $imageName,
                'public'
            );

            $product->image = 'products/' . $imageName;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */

        $totalStock = 0;
        $sizes = [];
        $colors = [];
        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {
                $totalStock += $variant['stock'];
                $sizes[] = $variant['size'];
                $colors[] = $variant['color'];
            }
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->stock = $totalStock;
        $product->size = implode(', ', array_unique($sizes));
        $product->color = implode(', ', array_unique($colors));
        
        $product->save();

        if ($request->has('variants')) {
            // Delete old variants
            $product->variants()->delete();
            
            // Re-create variants
            foreach ($request->variants as $variant) {
                $product->variants()->create([
                    'size' => $variant['size'],
                    'stock' => $variant['stock'],
                    'color' => $variant['color'],
                ]);
            }
        }

        return redirect('/admin/products')
            ->with('success', 'Product berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (
            $product->image &&
            Storage::disk('public')->exists($product->image)
        ) {

            Storage::disk('public')->delete($product->image);

        }

        $product->delete();

        return redirect('/admin/products')
            ->with('success', 'Product berhasil dihapus');
    }
}