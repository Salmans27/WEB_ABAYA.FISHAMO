@extends('layouts.store')

@section('title', $product->name . ' — Abaya Fishamo')

@section('content')

<div class="bg-[#edf1eb] min-h-screen py-6 sm:py-10 md:py-16">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- BREADCRUMB --}}
        <div class="mb-8 flex items-center text-xs tracking-[2px] uppercase text-[#7b8870] font-medium">
            <a href="{{ route('dashboard') }}" class="hover:text-[#55624d] transition">Shop</a>
            <span class="mx-3">/</span>
            <span class="text-[#55624d]">{{ $product->category }}</span>
            <span class="mx-3">/</span>
            <span class="text-[#2d312b] line-clamp-1">{{ $product->name }}</span>
        </div>

        <div class="bg-white rounded-2xl sm:rounded-[32px] md:rounded-[48px] shadow-sm border border-[#e4eae0] overflow-hidden">

            <div class="grid lg:grid-cols-2 gap-0">

                {{-- LEFT: IMAGE --}}
                <div class="p-4 sm:p-6 md:p-10 lg:p-12 lg:border-r border-[#e4eae0] bg-white">

                    @if($product->image)
                        <div class="overflow-hidden rounded-[24px] md:rounded-[32px] shadow-[0_20px_50px_rgba(0,0,0,0.05)]">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full aspect-[3/4] object-cover hover:scale-105 transition-transform duration-1000 ease-in-out cursor-zoom-in">
                        </div>
                    @else
                        <div class="w-full aspect-[3/4] bg-[#dfe6da]/50 rounded-[24px] flex items-center justify-center">
                            <i class="bi bi-image text-6xl text-[#7b8870]"></i>
                        </div>
                    @endif

                </div>

                {{-- RIGHT: PRODUCT INFO --}}
                <div class="p-5 sm:p-8 md:p-12 lg:p-16 flex flex-col justify-center">

                    <div class="mb-8">
                        <p class="text-xs uppercase tracking-[4px] text-[#7b8870] font-semibold mb-3">
                            {{ $product->category }}
                        </p>

                        <h1 class="text-2xl sm:text-3xl md:text-5xl font-light text-[#2d312b] leading-tight tracking-[1px]">
                            {{ $product->name }}
                        </h1>

                        <p class="text-xl sm:text-3xl md:text-4xl font-normal text-[#55624d] mt-4 sm:mt-6 tracking-[1px]">
                            IDR {{ number_format($product->price) }}
                        </p>
                    </div>

                    <div class="w-full h-[1px] bg-[#e4eae0] mb-8"></div>

                    <form method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        @php
                            $colors = $product->color ? array_map('trim', explode(',', $product->color)) : [];
                            $sizes  = $product->size ? array_map('trim', explode(',', $product->size)) : [];
                        @endphp

                        {{-- COLOR SELECTION --}}
                        @if(count($colors) > 0)
                            <div class="mb-8">
                                <h3 class="text-sm font-medium text-[#2d312b] uppercase tracking-[2px] mb-4">Warna</h3>
                                <div class="flex flex-wrap gap-3" id="color-buttons">
                                    @foreach($colors as $color)
                                        @if($color)
                                        <label class="cursor-pointer group">
                                            <input type="radio" name="color" value="{{ $color }}" class="hidden peer color-radio" required onchange="checkVariant()">
                                            <div class="px-6 py-3 rounded-full border border-[#dce3d8] text-xs uppercase tracking-[1px] text-[#55624d] font-medium
                                                        transition-all duration-300
                                                        group-hover:border-[#55624d]
                                                        peer-checked:bg-[#55624d] peer-checked:text-white peer-checked:border-[#55624d] shadow-sm">
                                                {{ $color }}
                                            </div>
                                        </label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- SIZE SELECTION --}}
                        @if(count($sizes) > 0)
                            <div class="mb-8">
                                <h3 class="text-sm font-medium text-[#2d312b] uppercase tracking-[2px] mb-4 flex items-center justify-between">
                                    Ukuran
                                    <span class="text-[10px] text-[#7b8870] underline cursor-pointer hover:text-[#55624d]">Size Guide</span>
                                </h3>
                                <div class="flex flex-wrap gap-3" id="size-buttons">
                                    @foreach($sizes as $size)
                                        @if($size)
                                        <label class="cursor-pointer group">
                                            <input type="radio" name="size" value="{{ $size }}" class="hidden peer size-radio" required onchange="checkVariant()">
                                            <div class="min-w-[48px] px-3 h-12 flex items-center justify-center rounded-full border border-[#dce3d8] text-sm uppercase text-[#55624d] font-medium
                                                        transition-all duration-300
                                                        group-hover:border-[#55624d]
                                                        peer-checked:bg-[#55624d] peer-checked:text-white peer-checked:border-[#55624d] shadow-sm">
                                                {{ $size }}
                                            </div>
                                        </label>
                                        @endif
                                    @endforeach
                                </div>
                                {{-- STOK DISPLAY --}}
                                <div id="stock-info" class="mt-4 hidden">
                                    <p id="stock-label" class="text-xs font-medium"></p>
                                </div>
                            </div>
                        @endif

                        {{-- QUANTITY & STOCK --}}
                        <div class="mb-10">
                            <h3 class="text-sm font-medium text-[#2d312b] uppercase tracking-[2px] mb-4 flex items-center gap-3">
                                Jumlah
                                <span id="total-stock-badge"
                                      class="{{ $product->stock <= 5 && $product->stock > 0 ? 'bg-red-100 text-red-600' : 'bg-[#edf1eb] text-[#55624d]' }} text-[9px] px-2 py-0.5 rounded-full font-bold">
                                    STOK: {{ $product->stock }}
                                </span>
                            </h3>
                            
                            <div class="flex items-center w-fit border border-[#dce3d8] rounded-full overflow-hidden bg-white shadow-sm">
                                <button type="button" onclick="decreaseQty()" class="w-12 h-12 flex items-center justify-center text-[#55624d] hover:bg-[#edf1eb] transition">
                                    <i class="bi bi-dash text-xl"></i>
                                </button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" readonly
                                       class="w-14 text-center border-none focus:ring-0 text-[#2d312b] font-medium p-0 bg-transparent">
                                <button type="button" onclick="increaseQty()" class="w-12 h-12 flex items-center justify-center text-[#55624d] hover:bg-[#edf1eb] transition">
                                    <i class="bi bi-plus text-xl"></i>
                                </button>
                            </div>
                        </div>

                        {{-- ACTION BUTTONS --}}
                        <div class="flex flex-col sm:flex-row gap-4 mb-10">
                            
                            @auth
                                <button type="submit" formaction="{{ route('cart.store') }}" formmethod="POST"
                                        class="flex-1 bg-white border border-[#55624d] text-[#55624d] py-4 rounded-full text-xs font-semibold uppercase tracking-[2px] shadow-sm hover:bg-[#edf1eb] transition-all flex items-center justify-center gap-2">
                                    <i class="bi bi-cart-plus text-lg"></i>
                                    Add to Cart
                                </button>

                                <button type="submit" formaction="{{ route('checkout.direct') }}" formmethod="POST"
                                        class="flex-1 bg-[#55624d] text-white py-4 rounded-full text-xs font-semibold uppercase tracking-[2px] shadow-[0_10px_20px_rgba(85,98,77,0.3)] hover:bg-[#40483a] hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                                    <i class="bi bi-bag text-lg"></i>
                                    Buy Now
                                </button>

                                {{-- FAVORITE BUTTON --}}
                                <button type="submit" formaction="{{ route('favorite.store') }}" formmethod="POST" formnovalidate
                                        class="w-12 h-12 sm:w-auto sm:h-auto sm:px-6 flex-none bg-[#f8faf7] border border-[#dce3d8] text-[#55624d] rounded-full flex items-center justify-center hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all shadow-sm" title="Add to Wishlist">
                                    <i class="bi bi-heart text-xl"></i>
                                </button>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="flex-1 bg-[#55624d] text-white py-4 rounded-full text-xs font-semibold uppercase tracking-[2px] text-center hover:bg-[#40483a] transition-all shadow-md">
                                    Login to Buy
                                </a>
                            @endauth
                            
                        </div>

                    </form>

                    {{-- DESCRIPTION ACCORDION --}}
                    <div class="border-t border-[#e4eae0] pt-8">
                        <div class="group">
                            <h3 class="text-sm font-medium text-[#2d312b] uppercase tracking-[2px] flex items-center justify-between cursor-pointer mb-4">
                                Deskripsi Produk
                                <i class="bi bi-chevron-down text-[#7b8870] group-hover:text-[#55624d] transition-colors"></i>
                            </h3>
                            <div class="text-[#6d7568] text-sm leading-relaxed font-light whitespace-pre-line pr-4 pb-4">
                                {{ $product->description }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
    function increaseQty() {
        let qtyInput = document.getElementById('quantity');
        let current = parseInt(qtyInput.value);
        let max = parseInt(qtyInput.max);
        if (current < max) {
            qtyInput.value = current + 1;
        }
    }

    function decreaseQty() {
        let qtyInput = document.getElementById('quantity');
        let current = parseInt(qtyInput.value);
        if (current > 1) {
            qtyInput.value = current - 1;
        }
    }

    function updateStock(stock) {
        const qtyInput = document.getElementById('quantity');
        const stockInfo = document.getElementById('stock-info');
        const stockLabel = document.getElementById('stock-label');
        const badge = document.getElementById('total-stock-badge');

        // Update quantity input max
        qtyInput.max = stock;
        qtyInput.value = 1;

        // Show stock info
        stockInfo.classList.remove('hidden');

        if (stock === 0) {
            stockLabel.textContent = 'Ukuran ini habis terjual';
            stockLabel.className = 'text-xs font-medium text-red-500';
            badge.textContent = 'HABIS';
            badge.className = 'text-[9px] px-2 py-0.5 rounded-full font-bold bg-red-100 text-red-600';
        } else if (stock <= 5) {
            stockLabel.textContent = `Sisa ${stock} item untuk ukuran ini!`;
            stockLabel.className = 'text-xs font-medium text-orange-500';
            badge.textContent = `SISA: ${stock}`;
            badge.className = 'text-[9px] px-2 py-0.5 rounded-full font-bold bg-orange-100 text-orange-600';
        } else {
            stockLabel.textContent = `Stok tersedia: ${stock} item`;
            stockLabel.className = 'text-xs font-medium text-[#55624d]';
            badge.textContent = `STOK: ${stock}`;
            badge.className = 'text-[9px] px-2 py-0.5 rounded-full font-bold bg-[#edf1eb] text-[#55624d]';
        }
    }

    const variants = JSON.parse('{!! json_encode($product->variants) !!}');

    function checkVariant() {
        const colorInput = document.querySelector('input[name="color"]:checked');
        const sizeInput = document.querySelector('input[name="size"]:checked');
        
        const stockInfo = document.getElementById('stock-info');
        const stockLabel = document.getElementById('stock-label');
        
        if (variants && variants.length > 0 && colorInput && sizeInput) {
            const selectedColor = colorInput.value;
            const selectedSize = sizeInput.value;
            
            const variant = variants.find(v => v.color === selectedColor && v.size === selectedSize);
            
            if (variant) {
                updateStock(variant.stock);
            } else {
                updateStock(0); // Kombinasi tidak tersedia
                stockLabel.textContent = 'Kombinasi warna dan ukuran ini tidak tersedia';
            }
        }
    }
</script>
@endsection