<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalStock = Product::sum('stock');
        $totalCategory = Product::distinct('category')->count('category');
        $totalSold = Product::sum('sold');
        
        $totalRevenue = Product::selectRaw('SUM(price * sold) as total')->value('total');

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalStock',
            'totalCategory',
            'totalSold',
            'totalRevenue'
        ));
    }
}
