@extends('layouts.store')

@section('title', 'Abaya Fishamo — Luxury Modest Fashion')

@section('meta_description', 'Abaya Fishamo menghadirkan koleksi fashion muslim premium dengan desain elegan, modern, dan mewah.')

@section('topbar_text', 'LUXURY MODEST FASHION • ABAYA FISHAMO')

@section('content')

{{-- HERO VIDEO --}}
<section class="relative h-[60vh] sm:h-[70vh] md:h-[85vh] overflow-hidden">

    <video autoplay muted loop playsinline
           class="absolute inset-0 w-full h-full object-cover">
        <source src="{{ asset('videos/luxury 1.mp4') }}" type="video/mp4">
    </video>

    {{-- OVERLAY --}}
    <div class="absolute inset-0 bg-black/40"></div>

    {{-- HERO TEXT --}}
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">

        <p class="tracking-[3px] sm:tracking-[6px] text-[#7b8870] text-[10px] md:text-xs mb-3 md:mb-4 uppercase font-medium">
            New Collection 2026
        </p>

        <h1 class="text-3xl sm:text-4xl md:text-7xl font-extralight tracking-[5px] sm:tracking-[10px] md:tracking-[16px] text-[#55624d] uppercase leading-none">
            ABAYA <br class="md:hidden"> FISHAMO
        </h1>

        <p class="mt-6 text-[#7b8870] text-xs md:text-sm max-w-md leading-relaxed font-light tracking-[1px]">
            Discover timeless modest fashion designed with luxury and elegance.
        </p>

        <div class="flex flex-col sm:flex-row items-center gap-3 sm:gap-4 mt-6 sm:mt-10 w-full sm:w-auto px-4 sm:px-0">

            <a href="#products"
               class="px-8 sm:px-10 py-3 sm:py-4 bg-[#55624d] text-white font-semibold uppercase tracking-[2px] sm:tracking-[3px] text-[10px] md:text-xs hover:bg-[#3d4637] transition-colors duration-500 w-full sm:w-auto text-center">
                Explore Collection
            </a>

            @guest
                <a href="{{ route('register') }}"
                   class="px-8 sm:px-10 py-3 sm:py-4 border border-[#55624d] text-[#55624d] font-semibold uppercase tracking-[2px] sm:tracking-[3px] text-[10px] md:text-xs hover:bg-[#55624d] hover:text-white transition-colors duration-500 w-full sm:w-auto text-center">
                    Join Us
                </a>
            @endguest

        </div>

    </div>

    {{-- SCROLL INDICATOR --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-[#7b8870]">
        <p class="text-[9px] tracking-[4px] uppercase font-semibold">Scroll</p>
        <i class="bi bi-chevron-down text-lg animate-bounce"></i>
    </div>

</section>

{{-- FEATURED PRODUCTS --}}
<section id="products" class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-12 py-12 sm:py-20 md:py-32 scroll-mt-20">

    {{-- HEADING --}}
    <div class="flex flex-col items-center mb-8 sm:mb-16">
        <p class="text-[10px] md:text-xs tracking-[3px] sm:tracking-[4px] text-[#7b8870] uppercase font-bold mb-3 md:mb-4">New Collection</p>
        <h2 class="text-2xl sm:text-3xl md:text-5xl font-light text-[#55624d] tracking-[2px] sm:tracking-[4px] uppercase mb-4 text-center">Featured Products</h2>
        <div class="w-12 h-[1px] bg-[#55624d]"></div>
    </div>

    {{-- GRID --}}
    @if($products->count() > 0)

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-3 sm:gap-x-4 md:gap-x-8 gap-y-8 sm:gap-y-16">

            @foreach($products as $product)
                <div class="group relative flex flex-col">
                    
                    {{-- IMAGE --}}
                    <a href="{{ route('products.show', $product->id) }}" class="block relative overflow-hidden bg-[#f4f4f4] aspect-[3/4] mb-3 sm:mb-6">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover object-center transition-transform duration-[1.5s] group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-[#d8ddd3]">
                                <i class="bi bi-image text-3xl"></i>
                            </div>
                        @endif


                        
                    </a>



                    {{-- INFO --}}
                    <div class="text-center md:text-left flex flex-col flex-1">
                        <a href="{{ route('products.show', $product->id) }}">
                            <h3 class="text-xs sm:text-sm font-medium text-[#55624d] tracking-[1px] line-clamp-1 mb-1 sm:mb-2 group-hover:text-[#7b8870] transition-colors">
                                {{ $product->name }}
                            </h3>
                        </a>
                        
                        <div class="mt-auto">
                            <p class="text-xs sm:text-sm text-[#7b8870] tracking-[1px]">IDR {{ number_format($product->price) }}</p>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>

    @else

        <div class="text-center py-24 text-[#7b8870] flex flex-col items-center">
            <i class="bi bi-box2 text-5xl mb-4"></i>
            <p class="text-lg font-light tracking-[1px]">Belum ada produk tersedia.</p>
        </div>

    @endif

</section>

{{-- ABOUT --}}
<section id="about" class="bg-[#dfe6da] py-12 sm:py-16 md:py-24">

    <div class="max-w-5xl mx-auto text-center px-6">

        <p class="tracking-[4px] sm:tracking-[8px] text-[#7b8870] text-xs sm:text-sm uppercase">About Us</p>

        <h2 class="text-3xl sm:text-5xl md:text-7xl font-light text-[#55624d] mt-4 md:mt-5">
            Luxury Modest Fashion
        </h2>

        <p class="mt-6 sm:mt-10 text-sm sm:text-lg md:text-2xl leading-relaxed text-[#55624d]/80 max-w-3xl mx-auto">
            Abaya Fishamo menghadirkan fashion muslim premium
            dengan desain elegan, modern, dan mewah
            untuk wanita yang ingin tampil anggun setiap hari.
        </p>

        <div class="flex items-center justify-center gap-4 sm:gap-6 mt-8 sm:mt-12">

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