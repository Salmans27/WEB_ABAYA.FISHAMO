@extends('layouts.store')

@section('title', 'Keranjang Belanja — Abaya Fishamo')

@section('content')

<div class="bg-[#edf1eb] min-h-screen py-6 sm:py-10 md:py-16">

    <div class="max-w-5xl mx-auto px-4 sm:px-6">

        {{-- HEADER --}}
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-light text-[#2d312b] tracking-[1px]">Keranjang Belanja</h1>
                <p class="text-[#7b8870] text-sm mt-1">Review item Anda sebelum melanjutkan ke pembayaran.</p>
            </div>
            
            <a href="{{ route('dashboard') }}" class="hidden sm:flex items-center gap-2 text-sm text-[#55624d] hover:text-[#2d312b] transition font-medium">
                <i class="bi bi-arrow-left"></i> Lanjut Belanja
            </a>
        </div>

        {{-- ALERTS --}}
        @if(session('success'))
            <div class="bg-[#dfe6da] border border-[#c4d0bb] text-[#3f4939] px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 shadow-sm">
                <i class="bi bi-check-circle-fill text-[#55624d]"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 shadow-sm">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl sm:rounded-[32px] md:rounded-[40px] shadow-sm border border-[#e4eae0] overflow-hidden p-4 sm:p-6 md:p-10">

            @if($cart->count() > 0)

                <form action="/checkout" method="POST">
                    @csrf

                    <div class="space-y-6">
                        @foreach($cart as $item)
                            @if($item->product)
                                
                                <div class="group relative flex flex-col sm:flex-row gap-6 p-4 sm:p-6 rounded-[24px] border border-[#e4eae0] hover:border-[#c4d0bb] bg-[#f8faf7] hover:bg-white transition-all duration-300">
                                    
                                    {{-- CHECKBOX --}}
                                    <div class="absolute sm:relative top-6 sm:top-auto right-6 sm:right-auto z-10 sm:flex sm:items-center">
                                        <label class="relative flex items-center justify-center cursor-pointer">
                                            <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" data-price="{{ $item->product->price * $item->quantity }}"
                                                   class="product-check peer appearance-none w-6 h-6 border-2 border-[#dce3d8] rounded-md checked:bg-[#55624d] checked:border-[#55624d] transition-colors cursor-pointer">
                                            <i class="bi bi-check text-white absolute text-xl opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity"></i>
                                        </label>
                                    </div>

                                    {{-- IMAGE --}}
                                    <div class="w-24 h-32 sm:w-32 sm:h-40 shrink-0 rounded-[16px] overflow-hidden bg-white shadow-sm">
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                    </div>

                                    {{-- INFO --}}
                                    <div class="flex-1 flex flex-col justify-between">
                                        
                                        <div>
                                            <div class="flex justify-between items-start gap-4">
                                                <h2 class="text-base sm:text-lg md:text-xl font-medium text-[#2d312b] leading-tight">{{ $item->product->name }}</h2>
                                                
                                                <button type="button" onclick="document.getElementById('delete-form-{{ $item->id }}').submit()"
                                                        class="text-[#a0aca0] hover:text-red-500 transition-colors p-2 -mt-2 -mr-2 rounded-full hover:bg-red-50" title="Hapus Item">
                                                    <i class="bi bi-trash3 text-lg"></i>
                                                </button>
                                            </div>
                                            
                                            <p class="text-[10px] uppercase tracking-[2px] text-[#7b8870] font-semibold mt-1">{{ $item->product->category }}</p>
                                        </div>

                                        <div class="mt-4 flex flex-wrap gap-x-6 gap-y-2 text-sm text-[#6d7568]">
                                            @if($item->size)
                                                <div class="flex items-center gap-2">
                                                    <span class="text-[#a0aca0]">Size:</span> 
                                                    <span class="font-medium text-[#2d312b]">{{ $item->size }}</span>
                                                </div>
                                            @endif
                                            
                                            @if($item->color)
                                                <div class="flex items-center gap-2">
                                                    <span class="text-[#a0aca0]">Warna:</span> 
                                                    <span class="font-medium text-[#2d312b]">{{ $item->color }}</span>
                                                </div>
                                            @endif
                                            
                                            <div class="flex items-center gap-2">
                                                <span class="text-[#a0aca0]">Qty:</span> 
                                                <span class="font-medium text-[#2d312b]">{{ $item->quantity }}</span>
                                            </div>
                                        </div>

                                        <div class="mt-4 sm:mt-auto pt-4 border-t border-[#e4eae0]/50 sm:border-0 sm:pt-0 flex justify-end sm:justify-start">
                                            <p class="text-lg font-bold text-[#55624d] tracking-[1px]">
                                                IDR {{ number_format($item->product->price * $item->quantity) }}
                                            </p>
                                        </div>

                                    </div>

                                </div>

                            @endif
                        @endforeach
                    </div>

                    {{-- SUMMARY STICKY BAR --}}
                    <div class="mt-8 sm:mt-10 p-5 sm:p-8 rounded-[24px] bg-[#f8faf7] border border-[#e4eae0] flex flex-col md:flex-row items-center justify-between gap-4 sm:gap-6">
                        
                        <div>
                            <p class="text-sm text-[#7b8870] font-medium uppercase tracking-[2px] mb-1">Total Terpilih</p>
                            <p id="total-price" class="text-2xl sm:text-3xl font-bold text-[#2d312b] tracking-[1px]">IDR 0</p>
                        </div>

                        <button type="submit" class="w-full md:w-auto px-10 py-4 rounded-full bg-[#55624d] text-white font-semibold uppercase tracking-[2px] text-sm shadow-[0_10px_20px_rgba(85,98,77,0.2)] hover:bg-[#3f4939] hover:-translate-y-1 transition-all">
                            Checkout Sekarang
                        </button>

                    </div>

                </form>

                {{-- HIDDEN DELETE FORMS --}}
                @foreach($cart as $item)
                    <form id="delete-form-{{ $item->id }}" action="/cart/{{ $item->id }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach

            @else

                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-[#f8faf7] rounded-full flex items-center justify-center mx-auto mb-6 text-[#c4d0bb]">
                        <i class="bi bi-cart-x text-4xl"></i>
                    </div>
                    <h2 class="text-xl font-medium text-[#2d312b] mb-2">Keranjang Anda Kosong</h2>
                    <p class="text-[#7b8870] text-sm mb-8">Sepertinya Anda belum menambahkan produk apapun ke keranjang.</p>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-8 py-3 rounded-full bg-[#55624d] text-white text-sm font-semibold uppercase tracking-[2px] hover:bg-[#3f4939] transition">
                        <i class="bi bi-bag"></i> Mulai Belanja
                    </a>
                </div>

            @endif

        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
    const checkboxes = document.querySelectorAll('.product-check');
    const totalPrice = document.getElementById('total-price');

    function calculateTotal() {
        let total = 0;
        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                total += parseInt(checkbox.dataset.price);
            }
        });
        totalPrice.innerText = 'IDR ' + total.toLocaleString('id-ID');
    }

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', calculateTotal);
    });
</script>
@endsection