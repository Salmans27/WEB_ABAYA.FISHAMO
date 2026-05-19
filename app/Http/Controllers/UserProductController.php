<?php

namespace App\Http\Controllers;

use App\Models\Product;

class UserProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }
}