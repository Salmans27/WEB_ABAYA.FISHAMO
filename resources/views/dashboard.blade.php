@extends('layouts.store')

@section('title', 'Boutique — Abaya Fishamo')

@section('nav_allproducts', '!text-[#55624d]')

@section('content')

{{-- HERO BANNER (MASSIVE) --}}
@if(file_exists(public_path('images/banner-abaya.jpg')))
<section class="relative w-full h-[70vh] md:h-[85vh] overflow-hidden">
    {{-- IMAGE --}}
    <img src="{{ asset('images/banner-abaya.jpg') }}" 
         alt="Abaya Fishamo New Collection" 
         class="absolute inset-0 w-full h-full object-cover object-top scale-105 animate-[kenburns_20s_ease-out_forwards]">
    
    {{-- OVERLAY --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>

    {{-- HERO TEXT --}}
    <div class="absolute inset-0 flex flex-col justify-end items-center text-center pb-20 md:pb-32 px-6">
        <p class="text-[10px] md:text-xs tracking-[6px] text-white/80 uppercase font-medium mb-4 animate-fade-in-up">The New Standard of Elegance</p>
        <h2 class="text-4xl md:text-7xl font-extralight text-white tracking-[8px] md:tracking-[12px] uppercase leading-none animate-fade-in-up animation-delay-200">
            Timeless <br class="md:hidden">Collection
        </h2>
        <a href="#collection" class="mt-6 sm:mt-10 px-8 sm:px-10 py-3 sm:py-4 bg-white text-[#55624d] text-[10px] md:text-xs font-semibold uppercase tracking-[2px] sm:tracking-[3px] hover:bg-[#55624d] hover:text-white transition-colors duration-500 animate-fade-in-up animation-delay-400">
            Explore Now
        </a>
    </div>
</section>
@endif

{{-- COLLECTION FILTERS & GRID --}}
<section id="collection" class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-12 py-12 sm:py-20 md:py-32 scroll-mt-20">

    <div class="flex flex-col items-center mb-8 sm:mb-16">
        <h3 class="text-xl sm:text-2xl md:text-4xl font-light text-[#55624d] tracking-[2px] sm:tracking-[4px] uppercase mb-4 text-center">Our Collection</h3>
        <div class="w-12 h-[1px] bg-[#55624d]"></div>
    </div>

    {{-- FILTER & SORT DESKTOP/MOBILE --}}
    <div class="flex flex-col lg:flex-row justify-between items-start sm:items-center mb-8 sm:mb-12 border-b border-[#d8ddd3] pb-6 gap-6 w-full">
        
        {{-- Categories --}}
        <div class="flex gap-8 overflow-x-auto w-full lg:w-auto scrollbar-hide">
            <a href="{{ route('dashboard', array_merge(request()->except(['category', 'page']))) }}"
               class="text-xs uppercase tracking-[2px] whitespace-nowrap pb-2 border-b-2 transition-colors
                      {{ !request('category') ? 'border-[#55624d] text-[#55624d] font-medium' : 'border-transparent text-gray-400 hover:text-[#55624d]' }}">
                All
            </a>

            @foreach($categories as $cat)
                @if($cat)
                    <a href="{{ route('dashboard', array_merge(request()->all(), ['category' => $cat])) }}"
                       class="text-xs uppercase tracking-[2px] whitespace-nowrap pb-2 border-b-2 transition-colors
                              {{ request('category') === $cat ? 'border-[#55624d] text-[#55624d] font-medium' : 'border-transparent text-gray-400 hover:text-[#55624d]' }}">
                        {{ $cat }}
                    </a>
                @endif
            @endforeach
        </div>

        {{-- Sort --}}
        <div class="flex items-center gap-6 w-full lg:w-auto justify-between lg:justify-end">
            
            @if(request('search'))
                <div class="flex items-center gap-3 text-xs uppercase tracking-[1px] text-[#7b8870]">
                    <span>Search: "{{ request('search') }}"</span>
                    <a href="{{ route('dashboard', request()->except(['search', 'page'])) }}" class="text-red-400 hover:text-red-600"><i class="bi bi-x-lg"></i></a>
                </div>
            @endif

            <div class="relative group">
                <select onchange="location = this.value;"
                        class="appearance-none bg-transparent border-none text-xs uppercase tracking-[2px] text-[#7b8870] cursor-pointer focus:ring-0 pr-8 py-2 font-medium group-hover:text-[#55624d] transition-colors">
                    <option value="{{ route('dashboard', array_merge(request()->all(), ['sort' => 'latest'])) }}" {{ request('sort') == 'latest' || !request('sort') ? 'selected' : '' }}>
                        Sort: Latest
                    </option>
                    <option value="{{ route('dashboard', array_merge(request()->all(), ['sort' => 'price_asc'])) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                        Price: Low to High
                    </option>
                    <option value="{{ route('dashboard', array_merge(request()->all(), ['sort' => 'price_desc'])) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                        Price: High to Low
                    </option>
                </select>
                <i class="bi bi-chevron-down absolute right-2 top-1/2 -translate-y-1/2 text-[10px] text-gray-400 pointer-events-none group-hover:text-[#55624d]"></i>
            </div>

        </div>

    </div>

    {{-- PRODUCT GRID --}}
    @if(isset($products) && $products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-3 sm:gap-x-4 md:gap-x-8 gap-y-8 sm:gap-y-16">
            
            @foreach($products as $product)
                <div class="group relative flex flex-col">
                    
                    {{-- IMAGE --}}
                    <a href="{{ route('products.show', $product->id) }}" class="block relative overflow-hidden bg-[#f4f4f4] aspect-[3/4] mb-3 sm:mb-6">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover object-center transition-transform duration-[1.5s] group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <i class="bi bi-image text-3xl"></i>
                            </div>
                        @endif

                        {{-- Hover Overlay & Quick Add (Desktop) --}}
                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-500 hidden md:block">
                            <form action="{{ route('cart.store') }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                {{-- We'll assume default size/color if not selected, or redirect to show page. 
                                     Best to link to product page for variants in luxury e-commerce --}}
                                <button type="button" onclick="window.location='{{ route('products.show', $product->id) }}'" 
                                        class="w-full bg-white text-[#55624d] py-3 text-[10px] uppercase tracking-[2px] font-semibold hover:bg-[#55624d] hover:text-white transition-colors">
                                    View Details
                                </button>
                            </form>
                        </div>

                        {{-- BADGES --}}
                        @if($product->stock == 0)
                            <span class="absolute top-4 right-4 bg-white px-3 py-1 text-[9px] uppercase tracking-[1px] text-[#7b8870] font-semibold shadow-sm">
                                Sold Out
                            </span>
                        @elseif($product->stock <= 5 && $product->stock > 0)
                            <span class="absolute top-4 right-4 bg-red-50 text-red-600 px-3 py-1 text-[9px] uppercase tracking-[1px] font-semibold border border-red-100">
                                Low Stock
                            </span>
                        @endif
                    </a>

                    {{-- INFO --}}
                    <div class="text-center md:text-left flex flex-col flex-1">
                        <a href="{{ route('products.show', $product->id) }}">
                            <h3 class="text-xs sm:text-sm font-medium text-[#55624d] tracking-[1px] line-clamp-1 mb-1 sm:mb-2 group-hover:text-[#55624d] transition-colors">
                                {{ $product->name }}
                            </h3>
                        </a>
                        
                        <div class="mt-auto">
                            <p class="text-xs sm:text-sm text-[#7b8870] tracking-[1px]">IDR {{ number_format($product->price) }}</p>
                            
                            @if($product->color)
                                <p class="text-[10px] text-gray-400 mt-2 uppercase tracking-[1px]">{{ count(explode(',', $product->color)) }} Colors</p>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    @else
        <div class="py-32 text-center flex flex-col items-center">
            <h2 class="text-2xl font-light text-[#55624d] tracking-[2px] mb-4">No Products Found</h2>
            <p class="text-sm text-[#7b8870] mb-8">We couldn't find any products matching your selection.</p>
            <a href="{{ route('dashboard') }}" class="border border-[#1a1a1a] text-[#55624d] px-8 py-3 text-xs uppercase tracking-[2px] hover:bg-[#55624d] hover:text-white transition-colors">
                Clear Filters
            </a>
        </div>
    @endif

</section>

<style>
    @keyframes kenburns {
        0% { transform: scale(1); }
        100% { transform: scale(1.05); }
    }
    .animate-\\[kenburns_20s_ease-out_forwards\\] {
        animation: kenburns 20s ease-out forwards;
    }
    
    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out forwards;
        opacity: 0;
    }
    .animation-delay-200 { animation-delay: 0.2s; }
    .animation-delay-400 { animation-delay: 0.4s; }
</style>

@endsection
