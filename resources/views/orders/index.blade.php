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

@php
    use App\Models\Cart;

    $cartCount = Cart::where('user_id', auth()->id())->count();
@endphp

<!-- TOP BAR -->
<div class="bg-gradient-to-r
            from-[#55624d]
            via-[#7b8870]
            to-[#55624d]
            text-white text-center
            py-3
            text-[10px] md:text-sm
            tracking-[4px]">

    TRACK YOUR ORDER • ABAYA FISHAMO

</div>

<!-- NAVBAR -->
<nav class="sticky top-0 z-50
            bg-[#edf1eb]/95
            backdrop-blur-md
            border-b border-[#d8ddd3]
            shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between h-20 md:h-24">

            <!-- LEFT -->
            <div class="hidden lg:flex items-center gap-8">

                <a href="/dashboard"
                   class="text-[#4d5449] hover:text-black transition">

                    All Products

                </a>

                <a href="{{ route('my.orders') }}"
                   class="text-[#2d312b]
                          border-b border-[#2d312b]
                          pb-1
                          font-medium">

                    Pesanan Saya

                </a>

            </div>

            <!-- MOBILE -->
            <button onclick="toggleMenu()"
                    class="lg:hidden text-3xl text-[#4b5446]">

                <i class="bi bi-list-stars"></i>

            </button>

            <!-- LOGO -->
            <div class="text-center">

                <h1 class="text-2xl md:text-4xl
                           tracking-[6px] md:tracking-[10px]
                           font-light
                           leading-none
                           text-[#252825]">

                    ABAYA

                </h1>

                <p class="text-[10px] md:text-xs
                          tracking-[5px]
                          text-[#6d7568]
                          mt-1">

                    FISHAMO

                </p>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-3 md:gap-5">

                <!-- CART -->
                <a href="/cart"
                   class="relative
                          w-12 h-12
                          rounded-full
                          bg-gradient-to-br
                          from-[#66725d]
                          to-[#4e5b46]
                          flex items-center justify-center
                          text-white
                          shadow-lg
                          hover:scale-105 transition">

                    <i class="bi bi-handbag-fill"></i>

                    @if($cartCount > 0)

                        <span class="absolute
                                     -top-1 -right-1
                                     bg-[#cfd7c8]
                                     text-[#55624d]
                                     text-[10px]
                                     w-5 h-5
                                     rounded-full
                                     flex items-center justify-center">

                            {{ $cartCount }}

                        </span>

                    @endif

                </a>

                <!-- PROFILE -->
                <div class="flex items-center gap-3
                            bg-white/80
                            px-3 py-2
                            rounded-full
                            border border-[#d7ddd2]
                            shadow-sm">

                    <img
                        src="{{ asset('storage/' . auth()->user()->photo) }}"
                        class="w-10 h-10 rounded-full object-cover">

                    <div class="hidden md:block">

                        <p class="text-xs text-gray-500">
                            Welcome
                        </p>

                        <p class="font-semibold text-sm">
                            {{ auth()->user()->name }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</nav>

<!-- PAGE -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

    <!-- TITLE -->
    <div class="mb-14">

        <p class="tracking-[8px]
                  text-[#55624d]
                  text-sm md:text-lg
                  mb-5">

            ORDER HISTORY

        </p>

        <h1 class="text-5xl md:text-7xl
                   font-extralight
                   text-[#55624d]">

            Pesanan Saya

        </h1>

    </div>

    @if($orders->count() > 0)

        <div class="space-y-10">

            @foreach($orders as $order)

                <div class="bg-white
                            rounded-[35px]
                            border border-[#dbe2d6]
                            shadow-[0_15px_40px_rgba(0,0,0,0.06)]
                            overflow-hidden">

                    <!-- HEADER -->
                    <div class="p-8 md:p-10 border-b border-[#edf1eb]">

                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                            <div>

                                <p class="text-sm tracking-[4px]
                                          text-[#7b8870]
                                          uppercase">

                                    Order ID

                                </p>

                                <h2 class="text-3xl md:text-4xl
                                           font-light
                                           mt-2">

                                    #{{ $order->id }}

                                </h2>

                                <p class="text-[#7d8577] mt-3">

                                    {{ $order->created_at->format('d M Y • H:i') }}

                                </p>

                            </div>

                            <div class="text-left lg:text-right">

                                <p class="text-[#7d8577]">
                                    Total Harga
                                </p>

                                <h3 class="text-4xl md:text-5xl
                                           font-bold
                                           text-[#55624d]
                                           mt-2">

                                    Rp {{ number_format($order->total_price) }}

                                </h3>

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

                            <!-- BADGE -->
                            <span class="inline-flex
                                         items-center
                                         px-6 py-3
                                         rounded-full
                                         text-sm md:text-base
                                         font-bold
                                         {{ $statusColor }}">

                                {{ strtoupper($order->status) }}

                            </span>

                            <!-- TIMELINE -->
                            <div class="mt-8
                                        overflow-x-auto">

                                <div class="flex items-center gap-5 min-w-[700px]">

                                    <!-- DIBAYAR -->
                                    <div class="flex items-center gap-3">

                                        <div class="w-5 h-5 rounded-full
                                            {{ in_array($order->status, ['paid','packing','shipped','delivered']) ? 'bg-green-500' : 'bg-gray-300' }}">
                                        </div>

                                        <span>Dibayar</span>

                                    </div>

                                    <div class="w-16 h-[2px] bg-gray-300"></div>

                                    <!-- DIKEMAS -->
                                    <div class="flex items-center gap-3">

                                        <div class="w-5 h-5 rounded-full
                                            {{ in_array($order->status, ['packing','shipped','delivered']) ? 'bg-green-500' : 'bg-gray-300' }}">
                                        </div>

                                        <span>Dikemas</span>

                                    </div>

                                    <div class="w-16 h-[2px] bg-gray-300"></div>

                                    <!-- DIKIRIM -->
                                    <div class="flex items-center gap-3">

                                        <div class="w-5 h-5 rounded-full
                                            {{ in_array($order->status, ['shipped','delivered']) ? 'bg-green-500' : 'bg-gray-300' }}">
                                        </div>

                                        <span>Dikirim</span>

                                    </div>

                                    <div class="w-16 h-[2px] bg-gray-300"></div>

                                    <!-- SAMPAI -->
                                    <div class="flex items-center gap-3">

                                        <div class="w-5 h-5 rounded-full
                                            {{ $order->status == 'delivered' ? 'bg-green-500' : 'bg-gray-300' }}">
                                        </div>

                                        <span>Sampai</span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- PRODUCTS -->
                    <div class="p-8 md:p-10 space-y-8">

                        @foreach($order->items as $item)

                            <div class="flex flex-col md:flex-row gap-6">

                                <!-- IMAGE -->
                                <div class="w-full md:w-[150px]">

                                    <img
                                        src="{{ asset('storage/' . $item->product->image) }}"
                                        class="w-full h-[170px]
                                               object-cover
                                               rounded-[28px]
                                               shadow-md">

                                </div>

                                <!-- INFO -->
                                <div class="flex-1 flex flex-col justify-center">

                                    <h3 class="text-2xl md:text-3xl font-light">

                                        {{ $item->product->name }}

                                    </h3>

                                    <div class="mt-4 flex flex-wrap gap-5 text-[#6f7769]">

                                        <p>
                                            Color :
                                            <span class="font-semibold text-[#2f312e]">
                                                {{ $item->color }}
                                            </span>
                                        </p>

                                        <p>
                                            Size :
                                            <span class="font-semibold text-[#2f312e]">
                                                {{ $item->size }}
                                            </span>
                                        </p>

                                        <p>
                                            Qty :
                                            <span class="font-semibold text-[#2f312e]">
                                                {{ $item->quantity }}
                                            </span>
                                        </p>

                                    </div>

                                    <p class="mt-5
                                              text-2xl
                                              font-bold
                                              text-[#55624d]">

                                        Rp {{ number_format($item->price) }}

                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="bg-white
                    rounded-[35px]
                    p-20
                    text-center
                    shadow-lg">

            <h2 class="text-4xl text-gray-400">

                Belum ada pesanan

            </h2>

        </div>

    @endif

</div>

<script>

    function toggleMenu() {

        document
            .getElementById('mobileMenu')
            ?.classList
            .toggle('hidden');

    }

</script>

</body>
</html>