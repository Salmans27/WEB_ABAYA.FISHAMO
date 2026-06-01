@extends('layouts.store')

@section('title', 'Abaya Fishamo — Luxury Modest Fashion')

@section('meta_description', 'Abaya Fishamo menghadirkan koleksi fashion muslim premium dengan desain elegan, modern, dan mewah.')

@section('topbar_text', 'LUXURY MODEST FASHION • ABAYA FISHAMO')

@section('content')

{{-- HERO VIDEO --}}
<section class="relative h-screen overflow-hidden">

    <video autoplay muted loop playsinline
           class="absolute inset-0 w-full h-full object-cover">
        <source src="{{ asset('videos/luxury.mp4') }}" type="video/mp4">
    </video>

    {{-- OVERLAY --}}
    <div class="absolute inset-0 bg-black/30"></div>

    {{-- HERO TEXT --}}
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">

        <p class="tracking-[8px] text-white/80 text-xs md:text-sm mb-4 uppercase">
            New Collection 2026
        </p>

        <h1 class="text-5xl md:text-8xl font-extralight tracking-[10px] md:tracking-[20px] text-white leading-none">
            ABAYA
        </h1>

        <p class="tracking-[8px] md:tracking-[14px] text-sm md:text-lg text-white/90 mt-2">
            FISHAMO
        </p>

        <p class="mt-6 text-white/80 text-sm md:text-lg max-w-lg leading-relaxed">
            Discover timeless modest fashion designed with luxury and elegance.
        </p>

        <div class="flex items-center gap-4 mt-10">

            <a href="#products"
               class="px-10 py-4 rounded-full bg-white text-[#55624d]
                      hover:bg-[#edf1eb] hover:scale-105 transition shadow-xl
                      tracking-[3px] text-sm font-semibold">
                SHOP NOW
            </a>

            @guest
                <a href="{{ route('register') }}"
                   class="px-8 py-4 rounded-full border border-white/50 text-white
                          hover:bg-white/10 transition tracking-[2px] text-sm">
                    JOIN US
                </a>
            @endguest

        </div>

    </div>

    {{-- SCROLL INDICATOR --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/60">
        <p class="text-[10px] tracking-[4px]">SCROLL</p>
        <i class="bi bi-chevron-down text-lg animate-bounce"></i>
    </div>

</section>

{{-- FEATURED PRODUCTS --}}
<section id="products" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">

    {{-- HEADING --}}
    <div class="mb-16 text-center">

        <p class="tracking-[8px] text-[#7b8870] text-sm uppercase">New Collection</p>

        <h2 class="text-5xl md:text-7xl font-light mt-4 text-[#55624d]">
            Featured Products
        </h2>

    </div>

    {{-- GRID --}}
    @if($products->count() > 0)

        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-x-5 gap-y-12">

            @foreach($products as $product)

                <a href="{{ route('products.show', $product->id) }}" class="group">

                    {{-- IMAGE --}}
                    <div class="overflow-hidden rounded-[28px] bg-white shadow-lg">

                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-[260px] md:h-[360px] object-cover
                                    group-hover:scale-105 transition duration-500">

                    </div>

                    {{-- INFO --}}
                    <div class="pt-5">

                        <h3 class="text-lg md:text-xl font-light line-clamp-1">
                            {{ $product->name }}
                        </h3>

                        <p class="text-[#7d8577] mt-1 text-sm">
                            {{ $product->category }}
                        </p>

                        <p class="mt-3 text-[#55624d] font-semibold text-lg">
                            Rp {{ number_format($product->price) }}
                        </p>

                    </div>

                </a>

            @endforeach

        </div>

    @else

        <div class="text-center py-20 text-[#7b8870]">
            <i class="bi bi-box2 text-5xl"></i>
            <p class="mt-4 text-lg">Belum ada produk tersedia.</p>
        </div>

    @endif

</section>

{{-- ABOUT --}}
<section id="about" class="bg-[#dfe6da] py-24">

    <div class="max-w-5xl mx-auto text-center px-6">

        <p class="tracking-[8px] text-[#7b8870] text-sm uppercase">About Us</p>

        <h2 class="text-5xl md:text-7xl font-light text-[#55624d] mt-5">
            Luxury Modest Fashion
        </h2>

        <p class="mt-10 text-lg md:text-2xl leading-relaxed text-[#55624d]/80 max-w-3xl mx-auto">
            Abaya Fishamo menghadirkan fashion muslim premium
            dengan desain elegan, modern, dan mewah
            untuk wanita yang ingin tampil anggun setiap hari.
        </p>

        <div class="flex items-center justify-center gap-6 mt-12">

            <a href="https://www.instagram.com/abaya.fishamo" target="_blank"
               class="w-12 h-12 rounded-full bg-[#55624d] text-white
                      flex items-center justify-center hover:scale-110 transition shadow-lg">
                <i class="bi bi-instagram text-xl"></i>
            </a>

            <a href="https://wa.me/6283180065732" target="_blank"
               class="w-12 h-12 rounded-full bg-[#55624d] text-white
                      flex items-center justify-center hover:scale-110 transition shadow-lg">
                <i class="bi bi-whatsapp text-xl"></i>
            </a>

            <a href="https://www.tiktok.com/@abaya.fishamo" target="_blank"
               class="w-12 h-12 rounded-full bg-[#55624d] text-white
                      flex items-center justify-center hover:scale-110 transition shadow-lg">
                <i class="bi bi-tiktok text-xl"></i>
            </a>

        </div>

    </div>

</section>

@endsection