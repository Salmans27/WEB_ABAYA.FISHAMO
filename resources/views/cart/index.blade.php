<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Abaya Fishamo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

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
                        class="w-14 h-20
                               object-cover
                               rounded-[30px]">

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
                   class="text-[#2d312b]
                          font-semibold
                          hover:text-black
                          transition">

                    Dashboard

                </a>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                <div class="flex items-center gap-3
                            bg-white/90
                            px-4 py-2
                            rounded-full
                            border border-[#d7ddd2]
                            shadow-sm">

                    <img
                        src="{{ asset('storage/' . auth()->user()->photo) }}"
                        alt="Profile"
                        class="w-12 h-12 rounded-full object-cover">

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

    <div class="max-w-5xl mx-auto px-6">

        <div class="bg-white rounded-3xl shadow-xl p-8">

            <h1 class="text-4xl font-light text-[#2f312e] mb-10">
                Keranjang Belanja
            </h1>

            @if(session('success'))

                <div class="bg-green-100
                            text-green-700
                            p-4
                            rounded-2xl
                            mb-6">

                    {{ session('success') }}

                </div>

            @endif

            @if(session('error'))

                <div class="bg-red-100
                            text-red-700
                            p-4
                            rounded-2xl
                            mb-6">

                    {{ session('error') }}

                </div>

            @endif

            @if($cart->count() > 0)

                <form action="/checkout"
                      method="POST">

                    @csrf

                    @foreach($cart as $item)

                        @if($item->product)

                        <div class="flex flex-col md:flex-row
                                    justify-between
                                    md:items-center
                                    border-b border-[#e4e7e1]
                                    py-8 gap-6">

                            <!-- LEFT -->
                            <div class="flex gap-5 items-start">

                                <!-- CHECKBOX -->
                                <div class="pt-12">

                                    <input type="checkbox"
                                           name="selected_items[]"
                                           value="{{ $item->id }}"
                                           data-price="{{ $item->product->price * $item->quantity }}"
                                           class="product-check
                                                  w-5 h-5
                                                  rounded-lg">

                                </div>

                                <!-- IMAGE -->
                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                     class="w-32 h-32
                                            rounded-3xl
                                            object-cover
                                            shadow-md">

                                <!-- INFO -->
                                <div>

                                    <h2 class="text-2xl
                                               font-semibold
                                               text-[#2f312e]">

                                        {{ $item->product->name }}

                                    </h2>

                                    <p class="text-[#6d7568] mt-2">
                                        Size: {{ $item->size }}
                                    </p>

                                    <p class="text-[#6d7568]">
                                        Color: {{ $item->color }}
                                    </p>

                                    <p class="text-[#6d7568]">
                                        Qty: {{ $item->quantity }}
                                    </p>

                                    <p class="text-[#55624d]
                                              text-2xl
                                              font-bold
                                              mt-4">

                                        Rp {{ number_format($item->product->price * $item->quantity) }}

                                    </p>

                                </div>

                            </div>

                            <!-- DELETE -->
                            <button type="button"
                                    onclick="document.getElementById('delete-form-{{ $item->id }}').submit()"
                                    class="bg-red-500
                                           hover:bg-red-600
                                           text-white
                                           px-5 py-3
                                           rounded-2xl
                                           transition">

                                Hapus

                            </button>

                        </div>

                        @endif

                    @endforeach

                    <!-- TOTAL -->
                    <div class="mt-10 flex flex-col md:flex-row
                                items-start md:items-center
                                justify-between gap-6">

                        <div>

                            <h2 class="text-2xl
                                       font-semibold
                                       text-[#2f312e]">

                                Total Checkout

                            </h2>

                            <p id="total-price"
                               class="text-4xl
                                      font-bold
                                      text-[#55624d]
                                      mt-3">

                                Rp 0

                            </p>

                        </div>

                        <button type="submit"
                                class="bg-[#55624d]
                                       hover:bg-[#3f4739]
                                       text-white
                                       px-8 py-4
                                       rounded-2xl
                                       font-semibold
                                       shadow-md
                                       transition">

                            Checkout Pilihan

                        </button>

                    </div>

                </form>

                <!-- DELETE FORM -->
                @foreach($cart as $item)

                    <form id="delete-form-{{ $item->id }}"
                          action="/cart/{{ $item->id }}"
                          method="POST"
                          class="hidden">

                        @csrf
                        @method('DELETE')

                    </form>

                @endforeach

            @else

                <div class="text-center py-24">

                    <h2 class="text-3xl
                               text-[#9aa39a]
                               font-semibold">

                        Keranjang Kosong

                    </h2>

                </div>

            @endif

        </div>

    </div>

</div>

<!-- TOTAL SCRIPT -->
<script>

    const checkboxes =
        document.querySelectorAll('.product-check');

    const totalPrice =
        document.getElementById('total-price');

    function calculateTotal()
    {
        let total = 0;

        checkboxes.forEach((checkbox) => {

            if (checkbox.checked)
            {
                total += parseInt(
                    checkbox.dataset.price
                );
            }

        });

        totalPrice.innerText =
            'Rp ' + total.toLocaleString('id-ID');
    }

    checkboxes.forEach((checkbox) => {

        checkbox.addEventListener(
            'change',
            calculateTotal
        );

    });

</script>

</body>
</html>