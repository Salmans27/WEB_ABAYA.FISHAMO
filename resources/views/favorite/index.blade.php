@extends('layouts.store')

@section('title', 'Favorit Saya — Abaya Fishamo')

@section('content')

<section class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-12 py-10 sm:py-16 md:py-24">

    {{-- HEADING --}}
    <div class="flex flex-col items-center mb-16">
        <p class="text-[10px] md:text-xs tracking-[4px] text-[#7b8870] uppercase font-bold mb-4">My Wishlist</p>
        <h1 class="text-2xl sm:text-3xl md:text-5xl font-light text-[#2d312b] tracking-[2px] sm:tracking-[4px] uppercase mb-4 text-center">Favorit Saya</h1>
        <div class="w-12 h-[1px] bg-[#55624d]"></div>
    </div>

    @if($favorites->count() > 0)
        
        {{-- GRID --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-3 sm:gap-x-4 md:gap-x-8 gap-y-8 sm:gap-y-16">
            
            @foreach($favorites as $favorite)
                <div class="group relative flex flex-col">
                    
                    {{-- IMAGE --}}
                    <a href="{{ route('products.show', $favorite->product->id) }}" class="block relative overflow-hidden bg-[#f4f4f4] aspect-[3/4] mb-3 sm:mb-6">
                        @if($favorite->product->image)
                            <img src="{{ asset('storage/' . $favorite->product->image) }}" alt="{{ $favorite->product->name }}" 
                                 class="w-full h-full object-cover object-center transition-transform duration-[1.5s] group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <i class="bi bi-image text-3xl"></i>
                            </div>
                        @endif

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        {{-- Quick Remove Button --}}
                        <div class="absolute top-4 right-4 z-10">
                            <form action="/favorite/{{ $favorite->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 rounded-full bg-white text-[#55624d] flex items-center justify-center shadow-md hover:bg-red-50 hover:text-red-500 transition-colors" title="Hapus dari Favorit">
                                    <i class="bi bi-heartbreak"></i>
                                </button>
                            </form>
                        </div>
                    </a>

                    {{-- INFO --}}
                    <div class="text-center md:text-left flex flex-col flex-1">
                        <a href="{{ route('products.show', $favorite->product->id) }}">
                            <h3 class="text-xs sm:text-sm font-medium text-[#2d312b] tracking-[1px] line-clamp-1 mb-1 sm:mb-2 group-hover:text-[#55624d] transition-colors">
                                {{ $favorite->product->name }}
                            </h3>
                        </a>
                        
                        <div class="mt-auto">
                            <p class="text-xs sm:text-sm text-[#7b8870] tracking-[1px]">IDR {{ number_format($favorite->product->price) }}</p>
                        </div>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="mt-6 flex flex-col gap-3">
                        <a href="{{ route('products.show', $favorite->product->id) }}" 
                           class="w-full bg-transparent border border-[#55624d] text-[#55624d] py-3 text-center text-[10px] md:text-xs uppercase tracking-[2px] font-semibold hover:bg-[#55624d] hover:text-white transition-colors">
                            Lihat Produk
                        </a>
                    </div>

                </div>
            @endforeach

        </div>

    @else
        
        {{-- EMPTY STATE --}}
        <div class="py-24 text-center flex flex-col items-center max-w-lg mx-auto">
            <div class="w-24 h-24 mb-8 text-[#d8ddd3] flex items-center justify-center">
                <i class="bi bi-heart text-6xl md:text-7xl"></i>
            </div>
            <h2 class="text-xl sm:text-2xl md:text-3xl font-light text-[#2d312b] tracking-[2px] mb-4">Belum Ada Favorit</h2>
            <p class="text-sm text-[#7b8870] mb-10 leading-relaxed">
                Anda belum menambahkan produk apa pun ke daftar favorit Anda. Temukan koleksi terbaik kami dan simpan yang paling Anda sukai.
            </p>
            <a href="{{ route('dashboard') }}" class="bg-[#55624d] text-white px-10 py-4 text-xs md:text-sm uppercase tracking-[3px] font-semibold hover:bg-[#40483a] transition-colors">
                Mulai Belanja
            </a>
        </div>

    @endif

</section>

@endsection
