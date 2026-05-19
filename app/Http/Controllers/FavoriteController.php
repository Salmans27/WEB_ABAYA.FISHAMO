<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('favorite.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        Favorite::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Produk ditambahkan ke favorite');
    }

    public function destroy($id)
    {
        Favorite::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->back()->with('success', 'Favorite dihapus');
    }
}