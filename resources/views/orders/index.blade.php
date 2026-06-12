@extends('layouts.store')

@section('title', 'Pesanan Saya — Abaya Fishamo')

@section('content')

<div class="bg-[#edf1eb] min-h-screen py-6 sm:py-10 md:py-16">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-10 text-center">
            <p class="tracking-[4px] uppercase text-[#7b8870] text-xs font-semibold mb-3">Order History</p>
            <h1 class="text-3xl md:text-5xl font-light text-[#2d312b] tracking-[2px]">Pesanan Saya</h1>
        </div>

        @if($orders->count() > 0)
            <div class="space-y-8 max-w-5xl mx-auto">
                @foreach($orders as $order)
                    <div class="bg-white rounded-[24px] md:rounded-[32px] border border-[#e4eae0] shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        
                        {{-- ORDER HEADER --}}
                        <div class="p-5 sm:p-6 md:p-8 bg-[#f8faf7] border-b border-[#e4eae0] flex flex-col md:flex-row md:items-center justify-between gap-6">
                            
                            <div class="flex flex-col sm:flex-row gap-6 sm:gap-12">
                                <div>
                                    <p class="text-[10px] uppercase tracking-[2px] text-[#7b8870] font-semibold mb-1">Order ID</p>
                                    <h2 class="text-xl md:text-2xl font-light text-[#2d312b]">#{{ $order->id }}</h2>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase tracking-[2px] text-[#7b8870] font-semibold mb-1">Tanggal Transaksi</p>
                                    <p class="text-sm font-medium text-[#2d312b] mt-1">{{ $order->created_at->format('d M Y • H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase tracking-[2px] text-[#7b8870] font-semibold mb-1">Total Pembayaran</p>
                                    <p class="text-lg font-bold text-[#55624d] mt-1">IDR {{ number_format($order->total_price) }}</p>
                                </div>
                            </div>

                            <div class="text-left md:text-right">
                                @php
                                    $statusConfig = match($order->status) {
                                        'pending' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-600', 'border' => 'border-orange-200', 'icon' => 'bi-hourglass-split'],
                                        'paid' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'border' => 'border-blue-200', 'icon' => 'bi-check2-circle'],
                                        'packing' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-600', 'border' => 'border-yellow-200', 'icon' => 'bi-box-seam'],
                                        'shipped' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-600', 'border' => 'border-purple-200', 'icon' => 'bi-truck'],
                                        'delivered' => ['bg' => 'bg-green-50', 'text' => 'text-green-600', 'border' => 'border-green-200', 'icon' => 'bi-house-check'],
                                        'cancelled' => ['bg' => 'bg-red-50', 'text' => 'text-red-600', 'border' => 'border-red-200', 'icon' => 'bi-x-circle'],
                                        default => ['bg' => 'bg-gray-50', 'text' => 'text-gray-600', 'border' => 'border-gray-200', 'icon' => 'bi-info-circle']
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-[1px] border {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }}">
                                    <i class="bi {{ $statusConfig['icon'] }}"></i> {{ $order->status }}
                                </span>
                            </div>

                        </div>

                        {{-- TIMELINE (Only if not cancelled) --}}
                        @if($order->status !== 'cancelled')
                        <div class="px-4 sm:px-6 py-6 md:px-8 border-b border-[#e4eae0] bg-white overflow-x-auto">
                            <div class="flex items-center justify-between min-w-[500px] max-w-2xl mx-auto relative">
                                
                                {{-- Background Line --}}
                                <div class="absolute left-6 right-6 top-1/2 -translate-y-1/2 h-[2px] bg-[#edf1eb] -z-10"></div>
                                
                                @php
                                    $statuses = ['paid' => 'Dibayar', 'packing' => 'Dikemas', 'shipped' => 'Dikirim', 'delivered' => 'Selesai'];
                                    $currentStatusIndex = array_search($order->status, array_keys($statuses));
                                    if ($currentStatusIndex === false) $currentStatusIndex = -1; // pending
                                    $i = 0;
                                @endphp

                                @foreach($statuses as $key => $label)
                                    @php
                                        $isCompleted = $i <= $currentStatusIndex;
                                        $isCurrent = $i === $currentStatusIndex;
                                    @endphp
                                    <div class="flex flex-col items-center gap-2 bg-white px-2">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center border-2 transition-colors duration-500 {{ $isCompleted ? 'bg-[#55624d] border-[#55624d] text-white shadow-md shadow-[#55624d]/20' : 'bg-white border-[#dce3d8] text-[#a0aca0]' }}">
                                            @if($isCompleted)
                                                <i class="bi bi-check lg"></i>
                                            @else
                                                <div class="w-2 h-2 rounded-full bg-[#dce3d8]"></div>
                                            @endif
                                        </div>
                                        <span class="text-[10px] font-medium uppercase tracking-[1px] {{ $isCompleted ? 'text-[#55624d]' : 'text-[#a0aca0]' }}">
                                            {{ $label }}
                                        </span>
                                    </div>
                                    @php $i++; @endphp
                                @endforeach

                            </div>
                        </div>
                        @endif

                        {{-- ORDER ITEMS --}}
                        <div class="p-5 sm:p-6 md:p-8">
                            <div class="space-y-6">
                                @foreach($order->items as $item)
                                    <div class="flex gap-4 md:gap-6">
                                        <div class="w-20 h-28 md:w-24 md:h-32 shrink-0 rounded-[16px] overflow-hidden bg-[#f8faf7] border border-[#e4eae0]">
                                            <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1 flex flex-col justify-center">
                                            <h3 class="text-sm md:text-base font-medium text-[#2d312b] line-clamp-1 mb-1">{{ $item->product->name }}</h3>
                                            <p class="text-[10px] uppercase tracking-[2px] text-[#7b8870] font-semibold mb-3">{{ $item->product->category }}</p>
                                            
                                            <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-[#6d7568] mb-3">
                                                <span>Color: <span class="font-medium text-[#2d312b]">{{ $item->color ?? '-' }}</span></span>
                                                <span class="w-1 h-1 rounded-full bg-[#dce3d8] self-center"></span>
                                                <span>Size: <span class="font-medium text-[#2d312b]">{{ $item->size ?? '-' }}</span></span>
                                                <span class="w-1 h-1 rounded-full bg-[#dce3d8] self-center"></span>
                                                <span>Qty: <span class="font-medium text-[#2d312b]">{{ $item->quantity }}</span></span>
                                            </div>

                                            <p class="text-sm md:text-base font-bold text-[#55624d]">IDR {{ number_format($item->price) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-6 text-[#c4d0bb] shadow-sm">
                    <i class="bi bi-box-seam text-4xl"></i>
                </div>
                <h2 class="text-xl font-medium text-[#2d312b] mb-2">Belum Ada Pesanan</h2>
                <p class="text-[#7b8870] text-sm mb-8">Anda belum pernah melakukan pemesanan sebelumnya.</p>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-8 py-3 rounded-full bg-[#55624d] text-white text-sm font-semibold uppercase tracking-[2px] hover:bg-[#3f4939] transition shadow-sm">
                    Mulai Belanja
                </a>
            </div>
        @endif

    </div>

</div>

@endsection