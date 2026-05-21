<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-[#edf1eb] text-[#2f312e]">

<!-- NAVBAR -->
<nav class="sticky top-0 z-50
            bg-[#edf1eb]/95
            backdrop-blur-md
            border-b border-[#d8ddd3]
            shadow-sm">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center justify-between h-24">

            <!-- LEFT -->
            <div class="flex items-center gap-14">

                <!-- LOGO -->
                <a href="/" class="flex items-center gap-4">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        class="w-14 h-14 rounded-full shadow">

                    <div>

                        <h1 class="text-3xl font-semibold text-[#2f312e]">
                            Abaya Fishamo
                        </h1>

                        <p class="text-[#7b8870]">
                            Luxury Collection
                        </p>

                    </div>

                </a>

                <!-- MENU -->
                <div class="hidden md:flex items-center gap-8">

                    <a href="/dashboard"
                       class="text-lg font-medium hover:text-black transition">

                        Dashboard

                    </a>

                    <a href="/products"
                       class="text-lg font-medium hover:text-black transition">

                        Products

                    </a>

                    <a href="/orders"
                       class="text-lg font-semibold
                              text-[#55624d]
                              border-b-2
                              border-[#55624d]
                              pb-1">

                        Pesanan

                    </a>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-5">

                <!-- CART -->
                <a href="/cart"
                   class="bg-white
                          px-6 py-4
                          rounded-2xl
                          shadow
                          flex items-center gap-3
                          hover:scale-105
                          transition">

                    <i class="bi bi-cart text-xl"></i>

                    <span class="font-semibold">
                        Cart
                    </span>

                </a>

                <!-- PROFILE -->
                <div class="flex items-center gap-4
                            bg-white
                            px-4 py-3
                            rounded-2xl
                            shadow">

                    <img
                        src="{{ asset('storage/' . auth()->user()->photo) }}"
                        class="w-12 h-12 rounded-full object-cover">

                    <div>

                        <p class="font-semibold">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            User
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</nav>

<!-- PAGE -->
<div class="max-w-6xl mx-auto py-12 px-6">

    <!-- TITLE -->
    <div class="mb-12">

        <p class="uppercase tracking-[4px]
                  text-[#7b8870]
                  text-sm">

            ABAYA FISHAMO

        </p>

        <h1 class="text-6xl font-light mt-3">
            Pesanan Saya
        </h1>

    </div>

    @if($orders->count() > 0)

        @foreach($orders as $order)

            <div class="bg-white
                        rounded-[40px]
                        shadow-lg
                        border border-[#dde3d7]
                        p-10
                        mb-10">

                <!-- TOP -->
                <div class="flex flex-col md:flex-row
                            md:items-center
                            md:justify-between
                            gap-8">

                    <!-- LEFT -->
                    <div>

                        <h2 class="text-4xl font-semibold">
                            Order #{{ $order->id }}
                        </h2>

                        <p class="text-gray-500 mt-3 text-lg">
                            {{ $order->created_at->format('d M Y H:i') }}
                        </p>

                    </div>

                    <!-- TOTAL -->
                    <div class="text-right">

                        <p class="text-gray-500 text-lg">
                            Total Harga
                        </p>

                        <p class="text-5xl font-bold text-[#55624d] mt-2">

                            Rp {{ number_format($order->total_price) }}

                        </p>

                    </div>

                </div>

                <!-- STATUS -->
                <div class="mt-10">

                    @php

                        $statusColor = match($order->status) {

                            'pending' => 'bg-gray-200 text-gray-700',
                            'paid' => 'bg-blue-100 text-blue-700',
                            'packing' => 'bg-yellow-100 text-yellow-700',
                            'shipped' => 'bg-purple-100 text-purple-700',
                            'delivered' => 'bg-green-100 text-green-700',
                            'cancelled' => 'bg-red-100 text-red-700',

                            default => 'bg-gray-200 text-gray-700'

                        };

                    @endphp

                    <div class="flex flex-wrap items-center gap-5">

                        <!-- BADGE -->
                        <span class="px-6 py-3 rounded-full
                                     font-bold text-lg {{ $statusColor }}">

                            {{ strtoupper($order->status) }}

                        </span>

                        <!-- TIMELINE -->
                        <div class="flex items-center gap-4 text-lg">

                            <div class="flex items-center gap-2">

                                <div class="w-4 h-4 rounded-full
                                    {{ in_array($order->status, ['paid','packing','shipped','delivered']) ? 'bg-green-500' : 'bg-gray-300' }}">
                                </div>

                                <span>Dibayar</span>

                            </div>

                            <div class="w-10 h-[2px] bg-gray-300"></div>

                            <div class="flex items-center gap-2">

                                <div class="w-4 h-4 rounded-full
                                    {{ in_array($order->status, ['packing','shipped','delivered']) ? 'bg-green-500' : 'bg-gray-300' }}">
                                </div>

                                <span>Dikemas</span>

                            </div>

                            <div class="w-10 h-[2px] bg-gray-300"></div>

                            <div class="flex items-center gap-2">

                                <div class="w-4 h-4 rounded-full
                                    {{ in_array($order->status, ['shipped','delivered']) ? 'bg-green-500' : 'bg-gray-300' }}">
                                </div>

                                <span>Dikirim</span>

                            </div>

                            <div class="w-10 h-[2px] bg-gray-300"></div>

                            <div class="flex items-center gap-2">

                                <div class="w-4 h-4 rounded-full
                                    {{ $order->status == 'delivered' ? 'bg-green-500' : 'bg-gray-300' }}">
                                </div>

                                <span>Sampai</span>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- PRODUCTS -->
                <div class="mt-10 space-y-8">

                    @foreach($order->items as $item)

                        <div class="flex flex-col md:flex-row
                                    gap-6
                                    items-center
                                    border-t
                                    pt-8">

                            <!-- IMAGE -->
                            <img
                                src="{{ asset('storage/' . $item->product->image) }}"
                                class="w-32 h-32 object-cover rounded-3xl shadow">

                            <!-- INFO -->
                            <div class="flex-1">

                                <h3 class="text-3xl font-semibold">
                                    {{ $item->product->name }}
                                </h3>

                                <p class="text-gray-500 mt-3 text-xl">
                                    {{ $item->color }} / {{ $item->size }}
                                </p>

                                <p class="text-gray-500 text-lg mt-1">
                                    Qty : {{ $item->quantity }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endforeach

    @else

        <div class="bg-white
                    rounded-[40px]
                    shadow-lg
                    p-20
                    text-center">

            <h2 class="text-5xl text-gray-400">
                Belum ada pesanan
            </h2>

        </div>

    @endif

</div>

</body>
</html>