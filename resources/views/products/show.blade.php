<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product->name }}</title>

    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#edf1ed]">

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

                    <!-- LOGO -->
                    <div class="flex items-center gap-4">

                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Abaya Fishamo"
                            class="w-14 h-20
                                   object-cover
                                   rounded-full">

                        <div>

                            <h1 class="text-2xl md:text-3xl
                                       font-semibold
                                       text-[#2d312b]">

                                Abaya Fishamo

                            </h1>

                            <p class="text-[#7c8477] text-sm">
                                Abaya Fishamo Store
                            </p>

                        </div>

                    </div>

                    <!-- MENU -->
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

                    <!-- FAVORITE -->
                   <a href="/favorite"
   class="w-12 h-12 md:w-12 md:h-12
          rounded-full
          bg-gradient-to-br
          from-[#dfe6da]
          to-[#cfd7c8]
          flex items-center justify-center
          text-[#55624d]
          shadow-md
          hover:scale-105 transition">

    <i class="bi bi-box2-heart-fill"></i>

</a>

                    <!-- CART -->
                    <a href="/cart"
   class="relative
          w-12 h-12 md:w-12 md:h-12
          rounded-full
          bg-gradient-to-br
          from-[#66725d]
          to-[#4e5b46]
          flex items-center justify-center
          text-white
          shadow-lg
          hover:scale-105 transition">

    <i class="bi bi-cart-plus-fill"></i>
                        @if(session('cart'))

                            <span class="absolute -top-1 -right-1
                                         bg-black text-white
                                         text-xs font-bold
                                         w-6 h-6 rounded-full
                                         flex items-center justify-center">

                                {{ count(session('cart')) }}

                            </span>

                        @endif

                    </a>

                    <!-- PROFILE -->
                    <div class="flex items-center gap-3
                                bg-white
                                px-4 py-2
                                rounded-2xl
                                shadow-md">

                        <img
                            src="{{ asset('storage/' . auth()->user()->photo) }}"
                            alt="Profile"
                            class="w-12 h-12 rounded-full object-cover">

                        <div>

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
    <div class="min-h-screen py-12">

        <div class="max-w-7xl mx-auto px-6">

            <div class="bg-white rounded-[40px] shadow-2xl overflow-hidden">

                <div class="grid lg:grid-cols-2 gap-12">

                    <!-- IMAGE -->
                    <div class="p-8">

                        @if($product->image)

                            <div class="overflow-hidden rounded-[35px]">

                                <img src="{{ asset('storage/' . $product->image) }}"
                                     class="w-full h-[750px]
                                            object-cover
                                            hover:scale-105
                                            transition duration-700">

                            </div>

                        @else

                            <div class="w-full h-[750px]
                                        bg-gray-200
                                        rounded-[35px]
                                        flex items-center justify-center">

                                <span class="text-gray-500 text-xl">
                                    No Image
                                </span>

                            </div>

                        @endif

                    </div>

                    <!-- CONTENT -->
                    <div class="p-10 flex flex-col justify-center">

                        <!-- CATEGORY -->
                        <p class="text-sm uppercase
                                  tracking-[5px]
                                  text-[#7c8477]">

                            {{ $product->category }}

                        </p>

                        <!-- TITLE -->
                        <h1 class="text-5xl lg:text-6xl
                                   font-light
                                   text-[#2d312b]
                                   mt-4 leading-tight">

                            {{ $product->name }}

                        </h1>

                        <!-- PRICE -->
                        <p class="text-5xl
                                  font-bold
                                  text-[#55624d]
                                  mt-8">

                            Rp {{ number_format($product->price) }}

                        </p>

                        <!-- STOCK -->
                        <div class="mt-6">

                            <span class="bg-[#edf1ed]
                                         text-[#55624d]
                                         px-6 py-3
                                         rounded-2xl
                                         font-semibold">

                                Stock: {{ $product->stock }}

                            </span>

                        </div>

                        <!-- FORM -->
                        <form action="/cart" method="POST">

                            @csrf

                            <input type="hidden"
                                   name="product_id"
                                   value="{{ $product->id }}">

                            <!-- SIZE -->
                            <div class="mt-12">

                                <h3 class="font-semibold
                                           text-xl
                                           text-[#2d312b]
                                           mb-5">

                                    Pilih Size

                                </h3>

                                <div class="flex gap-4 flex-wrap">

                                    @if($product->size)

                                        @foreach(explode(',', $product->size) as $size)

                                            <label>

                                                <input type="radio"
                                                       name="size"
                                                       value="{{ trim($size) }}"
                                                       class="hidden peer"
                                                       required>

                                                <div class="px-7 py-4
                                                            rounded-2xl
                                                            border border-[#d7ddd2]
                                                            bg-white
                                                            text-[#2d312b]
                                                            font-semibold
                                                            cursor-pointer
                                                            hover:border-[#55624d]
                                                            peer-checked:bg-[#55624d]
                                                            peer-checked:text-white
                                                            transition">

                                                    {{ trim($size) }}

                                                </div>

                                            </label>

                                        @endforeach

                                    @endif

                                </div>

                            </div>

                            <!-- COLOR -->
                            <div class="mt-12">

                                <h3 class="font-semibold
                                           text-xl
                                           text-[#2d312b]
                                           mb-5">

                                    Pilih Warna

                                </h3>

                                <div class="flex gap-4 flex-wrap">

                                    @if($product->color)

                                        @foreach(explode(',', $product->color) as $color)

                                            <label>

                                                <input type="radio"
                                                       name="color"
                                                       value="{{ trim($color) }}"
                                                       class="hidden peer"
                                                       required>

                                                <div class="px-7 py-4
                                                            rounded-2xl
                                                            border border-[#d7ddd2]
                                                            bg-white
                                                            text-[#2d312b]
                                                            font-semibold
                                                            cursor-pointer
                                                            hover:border-[#55624d]
                                                            peer-checked:bg-[#55624d]
                                                            peer-checked:text-white
                                                            transition">

                                                    {{ trim($color) }}

                                                </div>

                                            </label>

                                        @endforeach

                                    @endif

                                </div>

                            </div>

                            <!-- QUANTITY -->
                            <div class="mt-12">

                                <h3 class="font-semibold
                                           text-xl
                                           text-[#2d312b]
                                           mb-5">

                                    Quantity

                                </h3>

                                <div class="flex items-center
                                            w-fit
                                            rounded-2xl
                                            overflow-hidden
                                            border border-[#d7ddd2]
                                            shadow-sm">

                                    <!-- MINUS -->
                                    <button type="button"
                                            onclick="decreaseQty()"
                                            class="w-16 h-16
                                                   bg-[#edf1ed]
                                                   hover:bg-[#dfe4d8]
                                                   text-3xl
                                                   text-[#2d312b]
                                                   transition">

                                        −

                                    </button>

                                    <!-- INPUT -->
                                    <input type="number"
                                           id="quantity"
                                           name="quantity"
                                           value="1"
                                           min="1"
                                           max="{{ $product->stock }}"
                                           readonly
                                           class="w-24
                                                  text-center
                                                  border-0
                                                  focus:ring-0
                                                  text-2xl
                                                  font-bold
                                                  text-[#2d312b]">

                                    <!-- PLUS -->
                                    <button type="button"
                                            onclick="increaseQty()"
                                            class="w-16 h-16
                                                   bg-[#edf1ed]
                                                   hover:bg-[#dfe4d8]
                                                   text-3xl
                                                   text-[#2d312b]
                                                   transition">

                                        +

                                    </button>

                                </div>

                            </div>

                            <!-- DESCRIPTION -->
                            <div class="mt-12">

                                <h3 class="font-semibold
                                           text-xl
                                           text-[#2d312b]
                                           mb-4">

                                    Description

                                </h3>

                                <p class="text-[#6d7568]
                                          leading-relaxed
                                          text-lg">

                                    {{ $product->description }}

                                </p>

                            </div>

                            <!-- BUTTON -->
                            <div class="mt-14 flex flex-wrap gap-5">

                                <!-- CART -->
                                <button type="submit"
                                        class="bg-[#55624d]
                                               hover:bg-[#40483a]
                                               text-white
                                               px-10 py-5
                                               rounded-2xl
                                               font-semibold
                                               text-lg
                                               shadow-lg
                                               transition">

                                    Add To Cart

                                </button>

                                <!-- BUY -->
                                <button type="submit"
                                        formaction="/checkout/direct"
                                        class="bg-[#2d312b]
                                               hover:bg-black
                                               text-white
                                               px-10 py-5
                                               rounded-2xl
                                               font-semibold
                                               text-lg
                                               shadow-lg
                                               transition">

                                    Buy Now

                                </button>

                            </div>

                        </form>

                        <!-- FAVORITE -->
                        <form action="/favorite"
                              method="POST"
                              class="mt-5">

                            @csrf

                            <input type="hidden"
                                   name="product_id"
                                   value="{{ $product->id }}">

                            <button type="submit"
                                    class="border border-[#55624d]
                                           text-[#55624d]
                                           hover:bg-[#55624d]
                                           hover:text-white
                                           px-8 py-4
                                           rounded-2xl
                                           font-semibold
                                           transition">

                                <i class="bi bi-heart mr-2"></i>

                                Favorite

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- SCRIPT -->
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

    </script>

</body>
</html>