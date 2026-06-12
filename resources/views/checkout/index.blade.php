@extends('layouts.store')

@section('title', 'Checkout — Abaya Fishamo')

@section('content')

<div class="bg-[#edf1eb] min-h-screen py-6 sm:py-10 md:py-16">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-light text-[#2d312b] tracking-[1px]">Checkout</h1>
                <p class="text-[#7b8870] text-sm mt-1">Lengkapi informasi pengiriman dan pembayaran Anda.</p>
            </div>
            
            <a href="{{ route('cart.index') }}" class="hidden sm:flex items-center gap-2 text-sm text-[#55624d] hover:text-[#2d312b] transition font-medium">
                <i class="bi bi-arrow-left"></i> Kembali ke Keranjang
            </a>
        </div>

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 shadow-sm">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <form action="/checkout/process" method="POST" enctype="multipart/form-data">
            @csrf

            @if(isset($buyNow))
                <input type="hidden" name="buy_now" value="1">
                <input type="hidden" name="product_id" value="{{ $product_id }}">
                <input type="hidden" name="size" value="{{ $size }}">
                <input type="hidden" name="color" value="{{ $color }}">
                <input type="hidden" name="quantity" value="{{ $quantity }}">
            @endif

            @foreach($selectedItems as $selectedItem)
                <input type="hidden" name="selected_items[]" value="{{ $selectedItem }}">
            @endforeach

            <div class="grid lg:grid-cols-12 gap-8 lg:gap-10">

                {{-- LEFT: FORM --}}
                <div class="lg:col-span-7 space-y-8">

                    {{-- SHIPPING INFO --}}
                    <div class="bg-white rounded-2xl sm:rounded-[32px] shadow-sm border border-[#e4eae0] p-5 sm:p-6 md:p-10">
                        
                        <h2 class="text-lg font-medium text-[#2d312b] mb-6 flex items-center gap-3">
                            <i class="bi bi-geo-alt text-[#7b8870]"></i> Informasi Pengiriman
                        </h2>

                        <div class="space-y-5">
                            {{-- NAME --}}
                            <div>
                                <label class="block text-xs uppercase tracking-[1px] text-[#7b8870] font-semibold mb-2">Nama Penerima</label>
                                <input type="text" name="name" value="{{ auth()->user()->name }}" readonly
                                       class="w-full bg-[#f8faf7] border border-[#dce3d8] rounded-xl py-3 px-4 text-[#2d312b] focus:outline-none cursor-not-allowed">
                            </div>

                            {{-- PHONE & EMAIL --}}
                            <div class="grid md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs uppercase tracking-[1px] text-[#7b8870] font-semibold mb-2">Nomor WhatsApp / HP</label>
                                    <input type="text" name="phone" placeholder="08xxxxxxxxxx" required
                                           class="w-full bg-white border border-[#dce3d8] rounded-xl py-3 px-4 text-[#2d312b] focus:outline-none focus:border-[#55624d] focus:ring-1 focus:ring-[#55624d] transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs uppercase tracking-[1px] text-[#7b8870] font-semibold mb-2">Email</label>
                                    <input type="email" name="email" value="{{ auth()->user()->email }}" readonly
                                           class="w-full bg-[#f8faf7] border border-[#dce3d8] rounded-xl py-3 px-4 text-[#2d312b] focus:outline-none cursor-not-allowed">
                                </div>
                            </div>

                            {{-- COUNTRY & PROVINCE --}}
                            <div class="grid md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs uppercase tracking-[1px] text-[#7b8870] font-semibold mb-2">Negara</label>
                                    <select name="country" id="country" onchange="toggleProvince()" required
                                            class="w-full bg-white border border-[#dce3d8] rounded-xl py-3 px-4 text-[#2d312b] focus:outline-none focus:border-[#55624d] focus:ring-1 focus:ring-[#55624d] transition-colors appearance-none cursor-pointer">
                                        <option value="" disabled selected>Pilih Negara</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Singapore">Singapore</option>
                                    </select>
                                </div>
                                <div id="province-container" class="hidden">
                                    <label class="block text-xs uppercase tracking-[1px] text-[#7b8870] font-semibold mb-2">Provinsi</label>
                                    <select name="province" id="province"
                                            class="w-full bg-white border border-[#dce3d8] rounded-xl py-3 px-4 text-[#2d312b] focus:outline-none focus:border-[#55624d] focus:ring-1 focus:ring-[#55624d] transition-colors appearance-none cursor-pointer">
                                        <option value="" disabled selected>Pilih Provinsi</option>
                                        <option value="Aceh">Aceh</option>
                                        <option value="Sumatera Utara">Sumatera Utara</option>
                                        <option value="Sumatera Barat">Sumatera Barat</option>
                                        <option value="Riau">Riau</option>
                                        <option value="Jambi">Jambi</option>
                                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                                        <option value="Bengkulu">Bengkulu</option>
                                        <option value="Lampung">Lampung</option>
                                        <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
                                        <option value="Kepulauan Riau">Kepulauan Riau</option>
                                        <option value="DKI Jakarta">DKI Jakarta</option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                        <option value="Jawa Tengah">Jawa Tengah</option>
                                        <option value="DI Yogyakarta">DI Yogyakarta</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Banten">Banten</option>
                                        <option value="Bali">Bali</option>
                                        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                                        <option value="Kalimantan Utara">Kalimantan Utara</option>
                                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                        <option value="Gorontalo">Gorontalo</option>
                                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                                        <option value="Maluku">Maluku</option>
                                        <option value="Maluku Utara">Maluku Utara</option>
                                        <option value="Papua Barat">Papua Barat</option>
                                        <option value="Papua">Papua</option>
                                        <option value="Papua Selatan">Papua Selatan</option>
                                        <option value="Papua Tengah">Papua Tengah</option>
                                        <option value="Papua Pegunungan">Papua Pegunungan</option>
                                        <option value="Papua Barat Daya">Papua Barat Daya</option>
                                    </select>
                                </div>
                            </div>

                            {{-- FULL ADDRESS --}}
                            <div>
                                <label class="block text-xs uppercase tracking-[1px] text-[#7b8870] font-semibold mb-2">Alamat Lengkap</label>
                                <textarea name="address" rows="3" placeholder="Nama Jalan, Gedung, No. Rumah, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten, Kode Pos" required
                                          class="w-full bg-white border border-[#dce3d8] rounded-xl py-3 px-4 text-[#2d312b] focus:outline-none focus:border-[#55624d] focus:ring-1 focus:ring-[#55624d] transition-colors resize-none"></textarea>
                            </div>
                        </div>

                    </div>

                    {{-- PAYMENT INFO --}}
                    <div class="bg-white rounded-2xl sm:rounded-[32px] shadow-sm border border-[#e4eae0] p-5 sm:p-6 md:p-10">
                        
                        <h2 class="text-lg font-medium text-[#2d312b] mb-6 flex items-center gap-3">
                            <i class="bi bi-wallet2 text-[#7b8870]"></i> Metode Pembayaran
                        </h2>

                        <div class="space-y-5">
                            
                            {{-- METHOD SELECT --}}
                            <div>
                                <select name="payment_method" id="payment_method" onchange="togglePayment()" required
                                        class="w-full bg-white border border-[#dce3d8] rounded-xl py-3 px-4 text-[#2d312b] focus:outline-none focus:border-[#55624d] focus:ring-1 focus:ring-[#55624d] transition-colors cursor-pointer appearance-none">
                                    <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                    <option value="QRIS">QRIS / Transfer Bank</option>
                                    <option value="COD">Cash on Delivery (COD)</option>
                                </select>
                            </div>

                            {{-- QRIS SECTION --}}
                            <div id="qris-section" class="hidden mt-6 bg-[#f8faf7] border border-[#e4eae0] rounded-2xl p-6">
                                <p class="text-sm text-[#55624d] font-medium mb-4 text-center">Silakan scan QRIS di bawah ini menggunakan aplikasi M-Banking atau E-Wallet Anda.</p>
                                
                                <div class="flex justify-center mb-6">
                                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-[#e4eae0]">
                                        <img src="{{ asset('qris/qris-butik.png') }}" alt="QRIS Code" class="w-48 h-48 object-contain">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs uppercase tracking-[1px] text-[#7b8870] font-semibold mb-2">Upload Bukti Pembayaran</label>
                                    <input type="file" name="proof" id="proof" accept="image/*"
                                           class="w-full bg-white border border-[#dce3d8] rounded-xl py-2 px-3 text-sm text-[#2d312b] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#edf1eb] file:text-[#55624d] hover:file:bg-[#dfe6da] cursor-pointer">
                                    <p class="text-[10px] text-[#7b8870] mt-2">* Format: JPG, PNG. Maksimal ukuran file 2MB.</p>
                                </div>
                            </div>

                            {{-- COD SECTION --}}
                            <div id="cod-section" class="hidden mt-6 bg-blue-50 border border-blue-100 rounded-2xl p-5 flex gap-4">
                                <i class="bi bi-info-circle text-blue-500 text-xl"></i>
                                <div>
                                    <p class="text-sm font-medium text-blue-900">Pembayaran di Tempat</p>
                                    <p class="text-xs text-blue-700 mt-1">Anda dapat membayar tunai kepada kurir saat pesanan tiba di alamat Anda. Pastikan ada penerima di lokasi.</p>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- RIGHT: ORDER SUMMARY --}}
                <div class="lg:col-span-5">
                    <div class="bg-white rounded-2xl sm:rounded-[32px] shadow-sm border border-[#e4eae0] p-5 sm:p-6 md:p-8 sticky top-32">
                        
                        <h2 class="text-lg font-medium text-[#2d312b] mb-6 border-b border-[#e4eae0] pb-4">
                            Ringkasan Pesanan
                        </h2>

                        <div class="space-y-6 mb-6">
                            @foreach($checkoutItems as $item)
                                <div class="flex gap-4">
                                    <div class="relative w-16 h-20 rounded-xl overflow-hidden bg-[#f8faf7] border border-[#e4eae0] shrink-0">
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                        <span class="absolute -top-2 -right-2 bg-[#55624d] text-white text-[9px] w-5 h-5 rounded-full flex items-center justify-center font-bold border border-white">
                                            {{ $item->quantity }}
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-sm font-medium text-[#2d312b] line-clamp-1">{{ $item->product->name }}</h3>
                                        <p class="text-xs text-[#7b8870] mt-1">{{ $item->color ?? '-' }} / {{ $item->size ?? '-' }}</p>
                                        <p class="text-sm font-semibold text-[#55624d] mt-1">IDR {{ number_format($item->product->price) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-[#e4eae0] pt-6 space-y-3 mb-6">
                            <div class="flex justify-between text-sm text-[#6d7568]">
                                <span>Subtotal</span>
                                <span class="font-medium text-[#2d312b]">IDR {{ number_format($total) }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-[#6d7568]">
                                <span>Ongkos Kirim</span>
                                <span class="text-green-600 font-medium italic">Gratis</span>
                            </div>
                        </div>

                        <div class="border-t border-[#e4eae0] pt-6 mb-8 flex justify-between items-center">
                            <span class="text-base font-medium text-[#2d312b]">Total Akhir</span>
                            <span class="text-xl sm:text-2xl font-bold text-[#55624d] tracking-[1px]">IDR {{ number_format($total) }}</span>
                        </div>

                        <button type="submit" class="w-full py-4 rounded-full bg-[#55624d] text-white font-semibold uppercase tracking-[2px] text-sm shadow-[0_10px_20px_rgba(85,98,77,0.2)] hover:bg-[#3f4939] hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                            <i class="bi bi-lock-fill"></i> Bayar Sekarang
                        </button>

                        <p class="text-[10px] text-center text-[#a0aca0] mt-4 flex items-center justify-center gap-1">
                            <i class="bi bi-shield-check"></i> Transaksi Anda aman dan terenkripsi
                        </p>

                    </div>
                </div>

            </div>

        </form>

    </div>

</div>

@endsection

@section('scripts')
<script>
    function togglePayment() {
        const method = document.getElementById('payment_method').value;
        const qrisSection = document.getElementById('qris-section');
        const codSection = document.getElementById('cod-section');
        const proofInput = document.getElementById('proof');

        if (method === 'QRIS') {
            qrisSection.classList.remove('hidden');
            codSection.classList.add('hidden');
            proofInput.required = true;
        } else if (method === 'COD') {
            qrisSection.classList.add('hidden');
            codSection.classList.remove('hidden');
            proofInput.required = false;
            proofInput.value = ''; // clear file
        } else {
            qrisSection.classList.add('hidden');
            codSection.classList.add('hidden');
            proofInput.required = false;
        }
    }

    function toggleProvince() {
        const country = document.getElementById('country').value;
        const provinceContainer = document.getElementById('province-container');
        const provinceInput = document.getElementById('province');

        if (country === 'Indonesia') {
            provinceContainer.classList.remove('hidden');
            provinceInput.required = true;
        } else {
            provinceContainer.classList.add('hidden');
            provinceInput.required = false;
            provinceInput.value = ''; // clear selection
        }
    }

    // Init state
    togglePayment();
</script>
@endsection