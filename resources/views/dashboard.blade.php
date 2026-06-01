@extends('layouts.store')

@section('title', 'Shop — Abaya Fishamo')

@section('meta_description', 'Temukan koleksi abaya terbaru dari Abaya Fishamo. Fashion muslim premium yang elegan dan modern.')

@section('topbar_text', 'FREE SHIPPING ACROSS INDONESIA ON ORDERS OVER Rp 500.000')

@section('nav_allproducts', 'nav-link-active font-semibold text-[#2d312b]')

@section('content')

{{-- HERO --}}
<section class="bg-[#edf1eb] overflow-hidden">

    <div class="max-w-7xl mx-auto text-center pt-16 md:pt-24 pb-10 px-6">

        <p class="tracking-[10px] text-[#55624d] text-sm md:text-base mb-4 uppercase">
            Elegance In Every Detail
        </p>

        <h1 class="text-5xl md:text-7xl font-extralight text-[#55624d] leading-none">
            ABAYA FISHAMO
        </h1>

        <p class="mt-6 text-sm md:text-lg text-[#55624d]/80 max-w-2xl mx-auto">
            Discover timeless modest fashion designed with luxury and elegance.
        </p>

        <a href="#products"
           class="inline-block mt-10 px-10 py-4 rounded-full
                  bg-[#6c775f] hover:bg-[#55624d] transition shadow-xl
                  tracking-[3px] text-white text-sm">
            SHOP NOW
        </a>

    </div>

</section>

{{-- BANNER --}}
@if(file_exists(public_path('images/banner-abaya.jpg')))
<div>
    <img src="{{ asset('images/banner-abaya.jpg') }}"
         alt="Banner Abaya Fishamo"
         class="w-full h-auto object-cover">
</div>
@endif

{{-- SEARCH BAR (visible if search is active) --}}
@if(request('search'))
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
    <div class="flex items-center gap-3 text-[#55624d]">
        <i class="bi bi-search"></i>
        <p>Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></p>
        <a href="{{ route('dashboard') }}"
           class="ml-2 text-sm text-[#7b8870] hover:text-[#55624d] underline transition">
            Hapus filter
        </a>
    </div>
</div>
@endif

{{-- ALL PRODUCTS --}}
<section id="products" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-20">

    {{-- TITLE --}}
    <h2 class="text-4xl md:text-6xl font-light text-[#222822] mb-10">
        {{ request('search') ? 'Hasil Pencarian' : 'All Products' }}
    </h2>

    {{-- GRID --}}
    @if(isset($products) && $products->count() > 0)

        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4
                    gap-x-4 md:gap-x-7 gap-y-10">

            @foreach($products as $product)

                <a href="{{ route('products.show', $product->id) }}"
                   class="group transition duration-300 hover:-translate-y-1">

                    {{-- IMAGE --}}
                    <div class="relative overflow-hidden rounded-[24px] md:rounded-[34px]
                                bg-white shadow-[0_10px_30px_rgba(0,0,0,0.08)]">

                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-[240px] sm:h-[320px] md:h-[380px]
                                        object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-[240px] sm:h-[320px] md:h-[380px]
                                        bg-[#dfe6da] flex items-center justify-center">
                                <i class="bi bi-image text-4xl text-[#7b8870]"></i>
                            </div>
                        @endif

                        {{-- QUICK BADGE --}}
                        @if($product->stock <= 5 && $product->stock > 0)
                            <span class="absolute top-3 left-3 bg-orange-500 text-white
                                         text-[10px] px-2 py-1 rounded-full tracking-wide">
                                Sisa {{ $product->stock }}
                            </span>
                        @elseif($product->stock == 0)
                            <span class="absolute top-3 left-3 bg-red-500 text-white
                                         text-[10px] px-2 py-1 rounded-full tracking-wide">
                                Habis
                            </span>
                        @endif

                    </div>

                    {{-- INFO --}}
                    <div class="pt-4">

                        <h3 class="text-sm md:text-lg text-[#252825] line-clamp-1 font-light">
                            {{ $product->name }}
                        </h3>

                        <p class="text-xs md:text-sm text-[#798072] mt-1">
                            {{ $product->category }}
                        </p>

                        <p class="mt-2 text-[#55624d] font-semibold text-sm md:text-lg">
                            Rp {{ number_format($product->price) }}
                        </p>

                    </div>

                </a>

            @endforeach

        </div>

    @else

        <div class="text-center py-24 text-[#7b8870]">
            <i class="bi bi-search text-5xl"></i>
            <p class="mt-4 text-xl font-light">Produk tidak ditemukan.</p>
            <a href="{{ route('dashboard') }}"
               class="inline-block mt-6 px-8 py-3 rounded-full bg-[#55624d]
                      text-white hover:bg-[#66725d] transition">
                Lihat Semua Produk
            </a>
        </div>

    @endif

</section>

@endsection
