<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;

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

        // RECENT ORDERS
        $recentOrders = Order::latest()->take(5)->get();

        // CHART DATA: Revenue per day for the last 7 days
        $chartData = [];
        $chartLabels = [];
        $bulanIndo = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
        
        for ($i = 6; $i >= 0; $i--) {
            $dateObj = Carbon::now()->subDays($i);
            $date = $dateObj->format('Y-m-d');
            
            $dailyRevenue = Order::whereDate('created_at', $date)
                ->where('status', '!=', 'cancelled')
                ->sum('total_price'); 
                
            $chartLabels[] = $dateObj->format('d') . ' ' . $bulanIndo[$dateObj->month - 1];
            $chartData[] = $dailyRevenue;
        }

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalStock',
            'totalCategory',
            'totalSold',
            'totalRevenue',
            'recentOrders',
            'chartLabels',
            'chartData'
        ));
    }
}
