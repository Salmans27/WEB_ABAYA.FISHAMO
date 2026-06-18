@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- WELCOME HERO CARD --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-[#bfc9c0] via-[#d8dfd8] to-[#bfc9c0] 
                rounded-2xl md:rounded-[32px] p-5 sm:p-8 md:p-12 shadow-[0_15px_40px_rgba(0,0,0,0.04)] border border-[#d7ddd2]">
        {{-- Elegant circles decoration --}}
        <div class="absolute -top-24 -right-24 w-60 h-60 rounded-full bg-white/20 blur-2xl"></div>
        <div class="absolute -bottom-24 -left-24 w-60 h-60 rounded-full bg-[#55624d]/10 blur-2xl"></div>

        <div class="relative flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="text-left">
                <p class="uppercase tracking-[2px] sm:tracking-[4px] text-xs font-semibold text-[#5e6858] mb-2">
                    KONTROL UTAMA
                </p>
                <h2 class="text-2xl sm:text-3xl md:text-5xl font-light text-[#252825] leading-tight">
                    Selamat Datang Kembali, <span class="font-semibold text-[#384232] break-words">{{ auth()->user()->name }}</span>
                </h2>
                <p class="text-[#5d6559] text-sm md:text-base mt-4 max-w-xl font-light">
                    Kelola produk premium, lacak pesanan masuk, pantau ketersediaan stok, dan kendalikan seluruh aktivitas toko Abaya Fishamo dengan dasbor modern.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="/admin/products" 
                       class="bg-[#55624d] hover:bg-[#40483a] text-white text-xs font-semibold px-6 py-3 rounded-xl shadow-md transition hover:scale-105">
                        <i class="bi bi-box-seam mr-2"></i> Kelola Produk
                    </a>
                    <a href="{{ route('admin.orders.index') }}" 
                       class="bg-white hover:bg-gray-50 text-[#2f312e] text-xs font-semibold px-6 py-3 rounded-xl border border-[#d7ddd2] shadow-sm transition hover:scale-105">
                        <i class="bi bi-bag-check mr-2"></i> Lacak Pesanan
                    </a>
                </div>
            </div>
            
            <div class="hidden md:block">
                <i class="bi bi-shield-check text-[140px] text-[#55624d]/15"></i>
            </div>
        </div>
    </div>

    {{-- STATS CARDS GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
        
        {{-- TOTAL PRODUCTS --}}
        <div class="bg-white rounded-[24px] p-6 shadow-[0_8px_30px_rgba(0,0,0,0.02)] border border-[#e4eae0] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#7c8477] text-sm font-medium">Total Products</p>
                    <h3 class="text-3xl font-light text-[#252825] mt-2">{{ $totalProducts }}</h3>
                    <p class="text-xs text-emerald-600 mt-2 font-medium">
                        <i class="bi bi-arrow-up-short"></i> +3 ditambahkan minggu ini
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-[#edf1eb] text-[#55624d] flex items-center justify-center text-xl shadow-sm">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
        </div>

        {{-- TOTAL USERS --}}
        <div class="bg-white rounded-[24px] p-6 shadow-[0_8px_30px_rgba(0,0,0,0.02)] border border-[#e4eae0] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#7c8477] text-sm font-medium">Total Users</p>
                    <h3 class="text-3xl font-light text-[#252825] mt-2">{{ $totalUsers }}</h3>
                    <p class="text-xs text-emerald-600 mt-2 font-medium">
                        <i class="bi bi-arrow-up-short"></i> +10 pendaftar baru
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-[#edf1eb] text-[#55624d] flex items-center justify-center text-xl shadow-sm">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>

        {{-- TOTAL STOCK --}}
        <div class="bg-white rounded-[24px] p-6 shadow-[0_8px_30px_rgba(0,0,0,0.02)] border border-[#e4eae0] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#7c8477] text-sm font-medium">Total Stock</p>
                    <h3 class="text-3xl font-light text-[#252825] mt-2">{{ $totalStock }} <span class="text-xs text-gray-400 font-light">pcs</span></h3>
                    <p class="text-xs text-[#7c8477] mt-2 font-medium">
                        <i class="bi bi-check-circle-fill text-emerald-500"></i> Stok terintegrasi aman
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-[#edf1eb] text-[#55624d] flex items-center justify-center text-xl shadow-sm">
                    <i class="bi bi-archive"></i>
                </div>
            </div>
        </div>

        {{-- CATEGORIES --}}
        <div class="bg-white rounded-[24px] p-6 shadow-[0_8px_30px_rgba(0,0,0,0.02)] border border-[#e4eae0] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#7c8477] text-sm font-medium">Categories</p>
                    <h3 class="text-3xl font-light text-[#252825] mt-2">{{ $totalCategory }}</h3>
                    <p class="text-xs text-[#7c8477] mt-2 font-medium">
                        <i class="bi bi-tag-fill text-[#7b8870]"></i> Kategori aktif
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-[#edf1eb] text-[#55624d] flex items-center justify-center text-xl shadow-sm">
                    <i class="bi bi-grid"></i>
                </div>
            </div>
        </div>

        {{-- PRODUCTS SOLD --}}
        <div class="bg-white rounded-[24px] p-6 shadow-[0_8px_30px_rgba(0,0,0,0.02)] border border-[#e4eae0] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#7c8477] text-sm font-medium">Products Sold</p>
                    <h3 class="text-3xl font-light text-[#252825] mt-2">{{ $totalSold }}</h3>
                    <p class="text-xs text-emerald-600 mt-2 font-medium">
                        <i class="bi bi-arrow-up-short"></i> +8 item terjual hari ini
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-[#edf1eb] text-[#55624d] flex items-center justify-center text-xl shadow-sm">
                    <i class="bi bi-bag-check"></i>
                </div>
            </div>
        </div>

        {{-- REVENUE --}}
        <div class="bg-white rounded-[24px] p-6 shadow-[0_8px_30px_rgba(0,0,0,0.02)] border border-[#e4eae0] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#7c8477] text-sm font-medium">Total Revenue</p>
                    <h3 class="text-xl sm:text-2xl font-bold text-[#55624d] mt-2 break-all">Rp {{ number_format($totalRevenue) }}</h3>
                    <p class="text-xs text-emerald-600 mt-2 font-medium">
                        <i class="bi bi-graph-up-arrow"></i> +15.4% dibanding bulan lalu
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-[#edf1eb] text-[#55624d] flex items-center justify-center text-xl shadow-sm">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- CHART SECTION --}}
    <div class="bg-white rounded-2xl md:rounded-[24px] shadow-[0_8px_30px_rgba(0,0,0,0.02)] border border-[#e4eae0] p-4 sm:p-6 md:p-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
            <div class="text-left">
                <h3 class="text-lg font-semibold text-[#252825]">Grafik Pendapatan</h3>
                <p class="text-xs text-[#7c8477] mt-0.5">Total pendapatan harian selama 7 hari terakhir</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-[#edf1eb] text-[#55624d] flex items-center justify-center text-xl shadow-sm">
                <i class="bi bi-bar-chart-fill"></i>
            </div>
        </div>
        <div class="w-full h-72">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    {{-- RECENT TRANSACTION TABLES --}}
    <div class="bg-white rounded-2xl md:rounded-[24px] shadow-[0_8px_30px_rgba(0,0,0,0.02)] border border-[#e4eae0] p-4 sm:p-6 md:p-8">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
            <div class="text-left">
                <h3 class="text-lg font-semibold text-[#252825]">Pesanan Terbaru</h3>
                <p class="text-xs text-[#7c8477] mt-0.5">Pantau pesanan yang baru masuk</p>
            </div>
            
            <a href="{{ route('admin.orders.index') }}" 
               class="text-xs font-semibold text-[#55624d] hover:text-[#40483a] hover:underline flex items-center gap-1">
                <span>Lihat Semua Pesanan</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="border-b border-[#edf1eb] text-[#7c8477] text-xs font-semibold uppercase tracking-wider">
                        <th class="py-4 px-4 whitespace-nowrap">Nama Pelanggan</th>
                        <th class="py-4 px-4 whitespace-nowrap">Kontak / HP</th>
                        <th class="py-4 px-4 whitespace-nowrap">Total Item</th>
                        <th class="py-4 px-4 whitespace-nowrap">Total Belanja</th>
                        <th class="py-4 px-4 whitespace-nowrap">Status Pesanan</th>
                        <th class="py-4 px-4 text-center whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#edf1eb]">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-[#f8faf7] transition-colors">
                            <td class="py-4 px-4 font-semibold text-[#2f312e] whitespace-nowrap">{{ $order->customer_name }}</td>
                            <td class="py-4 px-4 text-xs text-[#5d6559] whitespace-nowrap">{{ $order->phone }}</td>
                            <td class="py-4 px-4 text-center whitespace-nowrap">{{ $order->total_item }} item</td>
                            <td class="py-4 px-4 font-bold text-[#55624d] whitespace-nowrap">Rp {{ number_format($order->total_price) }}</td>
                            <td class="py-4 px-4">
                                @if($order->status == 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full bg-yellow-50 text-yellow-700 border border-yellow-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> Pending
                                    </span>
                                @elseif($order->status == 'completed' || $order->status == 'selesai')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Selesai
                                    </span>
                                @elseif($order->status == 'processing' || $order->status == 'dikirim')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full bg-sky-50 text-sky-700 border border-sky-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span> Dikirim
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full bg-gray-50 text-gray-700 border border-gray-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span> {{ $order->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-center">
                                <a href="{{ route('admin.orders.index') }}" 
                                   class="inline-flex items-center gap-1.5 bg-[#edf1eb] hover:bg-[#dfe6da] text-[#55624d] text-xs font-medium px-3.5 py-1.5 rounded-lg transition">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-10 text-[#7c8477] font-light">
                                <i class="bi bi-bag-x text-4xl block text-[#c2c8bc] mb-2"></i>
                                Belum ada pesanan terbaru masuk saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        
        // Gradient for chart
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(85, 98, 77, 0.5)'); // #55624d
        gradient.addColorStop(1, 'rgba(85, 98, 77, 0.0)');
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Pendapatan Harian (Rp)',
                    data: {!! json_encode($chartData) !!},
                    borderColor: '#55624d',
                    backgroundColor: gradient,
                    borderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#55624d',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#2f382a',
                        titleColor: '#fff',
                        bodyColor: '#bfc9bc',
                        padding: 10,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#7c8477',
                            font: {
                                size: 11
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: '#edf1eb',
                            drawBorder: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            color: '#7c8477',
                            font: {
                                size: 11
                            },
                            callback: function(value, index, values) {
                                if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                                } else if (value >= 1000) {
                                    return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                                }
                                return 'Rp ' + value;
                            }
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

@endsection