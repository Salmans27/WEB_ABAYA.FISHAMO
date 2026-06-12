<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Display the welcome page.
     */
    public function welcome()
    {
        $products = Product::latest()->get();

        return view('welcome', compact('products'));
    }

    /**
     * Display the user dashboard.
     */
    public function index(Request $request)
    {
        // ADMIN REDIRECT
        if (Auth::check() && Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard');
        }

        // UNIQUE CATEGORIES FOR FILTER PILLS
        $categories = Product::select('category')->distinct()->pluck('category');

        // INPUTS
        $search = $request->search;
        $category = $request->category;
        $sort = $request->sort;

        // PRODUCT QUERY
        $query = Product::query();

        // SEARCH FILTER
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('category', 'like', '%' . $search . '%')
                  ->orWhere('color', 'like', '%' . $search . '%');
            });
        }

        // CATEGORY FILTER
        if ($category) {
            $query->where('category', $category);
        }

        // SORTING
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest(); // Default: Newest
        }

        $products = $query->get();

        return view('dashboard', compact('products', 'categories'));
    }
}
