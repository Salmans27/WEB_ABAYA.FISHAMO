<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout - Abaya Fishamo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<script>

function togglePayment()
{
    const payment =
        document.querySelector('[name="payment_method"]').value;

    const qris =
        document.getElementById('qris-section');

    const proof =
        document.getElementById('proof-section');

    if(payment === 'COD')
    {
        qris.style.display = 'none';
        proof.style.display = 'none';
    }
    else
    {
        qris.style.display = 'block';
        proof.style.display = 'block';
    }
}

document
.querySelector('[name="payment_method"]')
.addEventListener('change', togglePayment);

togglePayment();

</script>

<body class="bg-[#edf1eb] text-[#2f312e]">

<!-- TOP BAR -->
<div class="bg-gradient-to-r
            from-[#55624d]
            via-[#7b8870]
            to-[#55624d]
            text-white text-center
            py-3
            text-[10px] md:text-sm
            tracking-[4px]">

    FREE SHIPPING ACROSS INDONESIA ON ORDERS OVER Rp 500.000

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
            <div class="flex items-center gap-10">

                <a href="/dashboard"
                   class="flex items-center gap-3">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Abaya Fishamo"
                        class="w-14 h-20 object-cover rounded-[30px]">

                    <div>

                        <h1 class="text-2xl md:text-3xl
                                   tracking-[4px]
                                   font-light
                                   text-[#252825]">

                            ABAYA

                        </h1>

                        <p class="text-[10px] md:text-xs
                                  tracking-[5px]
                                  text-[#6d7568]">

                            FISHAMO

                        </p>

                    </div>

                </a>

                <a href="/dashboard"
                   class="font-semibold text-[#2f312e]">

                    Dashboard

                </a>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                <a href="/cart"
                   class="relative px-5 py-3
                          rounded-2xl
                          bg-white
                          shadow-md
                          flex items-center gap-3
                          text-[#2f312e]
                          font-semibold">

                    <i class="bi bi-cart-plus-fill"></i>
                    Cart

                    @php
                        $cartCount = \App\Models\Cart::where(
                            'user_id',
                            auth()->id()
                        )->count();
                    @endphp

                    @if($cartCount > 0)

                        <span class="absolute
                                     -top-2
                                     -right-2
                                     bg-[#55624d]
                                     text-white
                                     text-xs
                                     w-6
                                     h-6
                                     rounded-full
                                     flex
                                     items-center
                                     justify-center">

                            {{ $cartCount }}

                        </span>

                    @endif

                </a>

                <div class="flex items-center gap-3
                            bg-white/90
                            px-4 py-2
                            rounded-full
                            border border-[#d7ddd2]
                            shadow-sm">

                    @if(auth()->user()->photo)

                        <img
                            src="{{ asset('storage/' . auth()->user()->photo) }}"
                            class="w-12 h-12 rounded-full object-cover">

                    @else

                        <img
                            src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                            class="w-12 h-12 rounded-full object-cover">

                    @endif

                    <div class="hidden md:block">

                        <p class="text-xs text-gray-500">
                            Welcome
                        </p>

                        <p class="font-semibold text-[#2f312e]">
                            {{ auth()->user()->name }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</nav>

<!-- CONTENT -->
<div class="min-h-screen py-10">

    <div class="max-w-7xl mx-auto px-6">

        <form action="/checkout/process"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            @if(isset($buyNow))

                <input type="hidden" name="buy_now" value="1">

                <input type="hidden"
                       name="product_id"
                       value="{{ $product_id }}">

                <input type="hidden"
                       name="size"
                       value="{{ $size }}">

                <input type="hidden"
                       name="color"
                       value="{{ $color }}">

                <input type="hidden"
                       name="quantity"
                       value="{{ $quantity }}">

            @endif

            @foreach($selectedItems as $selectedItem)

                <input type="hidden"
                       name="selected_items[]"
                       value="{{ $selectedItem }}">

            @endforeach

            <div class="grid lg:grid-cols-2 gap-10">

                <!-- LEFT -->
                <div class="bg-white rounded-[35px] p-10 shadow-xl">

                    <h2 class="text-4xl font-light mb-10">
                        Informasi Pengiriman
                    </h2>

                    <!-- EMAIL -->
                    <div class="mb-6">

                        <input type="email"
                               name="email"
                               placeholder="Email"
                               required
                               class="w-full rounded-2xl
                                      border border-[#d7ddd2]
                                      py-4 px-5
                                      bg-[#f8faf7]">

                    </div>

                    <!-- COUNTRY -->
                    <div class="mb-6">

                        <select name="country"
                                id="country"
                                onchange="toggleProvince()"
                                class="w-full rounded-2xl
                                       border border-[#d7ddd2]
                                       py-4 px-5
                                       bg-[#f8faf7]">

                            <option value="Indonesia">
                                Indonesia
                            </option>

                            <option value="Malaysia">
                                Malaysia
                            </option>

                            <option value="Singapore">
                                Singapore
                            </option>

                        </select>

                    </div>

                    <!-- NAME -->
                    <div class="grid grid-cols-2 gap-4 mb-6">

                        <input type="text"
                               name="first_name"
                               placeholder="Nama Depan"
                               required
                               class="rounded-2xl
                                      border border-[#d7ddd2]
                                      py-4 px-5
                                      bg-[#f8faf7]">

                        <input type="text"
                               name="last_name"
                               placeholder="Nama Belakang"
                               required
                               class="rounded-2xl
                                      border border-[#d7ddd2]
                                      py-4 px-5
                                      bg-[#f8faf7]">

                    </div>

                    <!-- ADDRESS -->
                    <div class="mb-6">

                        <input type="text"
                               name="address"
                               placeholder="Alamat Lengkap"
                               required
                               class="w-full rounded-2xl
                                      border border-[#d7ddd2]
                                      py-4 px-5
                                      bg-[#f8faf7]">

                    </div>

                    <!-- CITY -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                        <input type="text"
                               name="city"
                               placeholder="Kota"
                               required
                               class="rounded-2xl
                                      border border-[#d7ddd2]
                                      py-4 px-5
                                      bg-[#f8faf7]">

                        <div id="province-wrapper">

                            <select name="province"
                                    id="province"
                                    class="rounded-2xl
                                           border border-[#d7ddd2]
                                           py-4 px-5
                                           bg-[#f8faf7]
                                           w-full">

                                <option value="">
                                    Pilih Provinsi
                                </option>

            <option>Aceh</option>
            <option>Bali</option>
            <option>Banten</option>
            <option>Bengkulu</option>
            <option>DKI Jakarta</option>
            <option>Gorontalo</option>
            <option>Jambi</option>
            <option>Jawa Barat</option>
            <option>Jawa Tengah</option>
            <option>Jawa Timur</option>
            <option>Kalimantan Barat</option>
            <option>Kalimantan Selatan</option>
            <option>Kalimantan Tengah</option>
            <option>Kalimantan Timur</option>
            <option>Kalimantan Utara</option>
            <option>Kepulauan Riau</option>
            <option>Lampung</option>
            <option>Maluku</option>
            <option>Maluku Utara</option>
            <option>Nusa Tenggara Barat</option>
            <option>Nusa Tenggara Timur</option>
            <option>Papua</option>
            <option>Papua Barat</option>
            <option>Riau</option>
            <option>Sulawesi Barat</option>
            <option>Sulawesi Selatan</option>
            <option>Sulawesi Tengah</option>
            <option>Sulawesi Tenggara</option>
            <option>Sulawesi Utara</option>
            <option>Sumatera Barat</option>
            <option>Sumatera Selatan</option>
            <option>Sumatera Utara</option>
            <option>Yogyakarta</option>

                            </select>

                        </div>

                        <input type="text"
                               name="postal_code"
                               placeholder="Kode Pos"
                               required
                               class="rounded-2xl
                                      border border-[#d7ddd2]
                                      py-4 px-5
                                      bg-[#f8faf7]">

                    </div>

                    <!-- PHONE -->
                    <div class="mb-6">

                        <input type="text"
                               name="phone"
                               placeholder="Nomor HP"
                               required
                               class="w-full rounded-2xl
                                      border border-[#d7ddd2]
                                      py-4 px-5
                                      bg-[#f8faf7]">

                    </div>

                    <!-- PAYMENT -->
                    <div>

                        <select name="payment_method"
                                required
                                class="w-full rounded-2xl
                                       border border-[#d7ddd2]
                                       py-4 px-5
                                       bg-[#f8faf7]">

                            <option value="">
                                Pilih Pembayaran
                            </option>

                            <option value="COD">
                                COD
                            </option>

                            <option value="QRIS">
                                QRIS Transfer
                            </option>

                        </select>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="bg-white
                            rounded-[35px]
                            p-10
                            shadow-xl
                            h-fit">

                    <h2 class="text-4xl font-light mb-10">
                        Ringkasan Pesanan
                    </h2>

                    @foreach($checkoutItems as $item)

                        <div class="flex gap-5 mb-8">

                            <div class="relative">

                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                     class="w-32 h-32 object-cover rounded-3xl">

                                <div class="absolute
                                            -top-2 -right-2
                                            bg-[#55624d]
                                            text-white
                                            w-8 h-8
                                            rounded-full
                                            flex items-center justify-center
                                            text-sm">

                                    {{ $item->quantity }}

                                </div>

                            </div>

                            <div class="flex-1">

                                <h3 class="text-2xl font-semibold">
                                    {{ $item->product->name }}
                                </h3>

                                <p class="text-[#7a8274] mt-2">

                                    {{ $item->color }}
                                    /
                                    {{ $item->size }}

                                </p>

                                <p class="text-3xl
                                          font-bold
                                          text-[#55624d]
                                          mt-4">

                                    Rp {{ number_format($item->product->price) }}

                                </p>

                            </div>

                        </div>

                        <hr class="my-8 border-[#e5e8e2]">

                    @endforeach

                    <!-- TOTAL -->
                    <div class="flex justify-between items-center">

                        <span class="text-2xl">
                            Total
                        </span>

                        <span class="text-4xl font-bold">

                            Rp {{ number_format($total) }}

                        </span>

                    </div>

                    <!-- QRIS -->
                   <div class="mt-10" id="qris-section">

                        <h3 class="text-2xl font-semibold mb-4">
                            Pembayaran QRIS
                        </h3>

                        <p class="text-[#6d7568] mb-5">
                            Scan QRIS berikut untuk melakukan pembayaran.
                        </p>

                        <div class="bg-[#f8faf7]
                                    border border-[#d7ddd2]
                                    rounded-3xl
                                    p-6
                                    flex justify-center">

                            <img src="{{ asset('qris/qris-butik.png') }}"
                                 alt="QRIS"
                                 class="w-72 rounded-2xl shadow-md">

                        </div>

                    </div>

                    <!-- UPLOAD -->
                  <div class="mt-8" id="proof-section">

                        <label class="block mb-3
                                      font-semibold
                                      text-[#2f312e]">

                            Upload Bukti Transfer

                        </label>

                        <input type="file"
                               name="proof"
                               required
                               class="w-full
                                      rounded-2xl
                                      border border-[#d7ddd2]
                                      py-4 px-5
                                      bg-[#f8faf7]">

                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                            class="w-full mt-10
                                   bg-[#55624d]
                                   hover:bg-[#434d3d]
                                   text-white
                                   py-5
                                   rounded-2xl
                                   text-xl
                                   font-semibold
                                   shadow-md
                                   transition">

                        Selesaikan Pesanan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<script>

    function toggleProvince()
    {
        const country =
            document.getElementById('country').value;

        const provinceWrapper =
            document.getElementById('province-wrapper');

        const province =
            document.getElementById('province');

        if (country === 'Indonesia')
        {
            provinceWrapper.style.display = 'block';

            province.required = true;
        }
        else
        {
            provinceWrapper.style.display = 'none';

            province.required = false;

            province.value = '';
        }
    }

    toggleProvince();

</script>

</body>
</html>