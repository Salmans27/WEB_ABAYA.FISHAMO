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

        // SEARCH
        $search = $request->search;

        // PRODUCT QUERY
        $products = Product::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('category', 'like', '%' . $search . '%')
                      ->orWhere('color', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('dashboard', compact('products'));
    }
}
