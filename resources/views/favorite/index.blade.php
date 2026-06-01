<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Favorite Products</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-[#edf1ed]">

    <!-- TOP BAR -->
    <div class="bg-gradient-to-r
                from-[#55624d]
                via-[#6b7862]
                to-[#55624d]
                text-white text-center
                py-3
                text-[10px] md:text-sm
                tracking-[5px]">

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
                <div class="flex items-center gap-12">

                    <!-- LOGO -->
                    <a href="/dashboard"
                       class="flex items-center gap-4">

                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Abaya Fishamo"
                            class="w-14 h-20
                                   object-cover
                                   rounded-[30px]">

                        <div>

                            <h1 class="text-2xl md:text-3xl
                                       font-semibold
                                       text-[#2d312b]">

                                Abaya Fishamo

                            </h1>

                            <p class="text-[#7c8477] text-sm">
                                User Panel
                            </p>

                        </div>

                    </a>

                    <!-- MENU -->
                    <a href="/dashboard"
                       class="text-[#2d312b]
                              font-semibold
                              text-lg
                              hover:text-black
                              transition">

                        Dashboard

                    </a>

                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-4">


                   <!-- CART -->
                <a href="/cart"
                   class="px-5 py-3
                          rounded-2xl
                          bg-white
                          shadow-md
                          flex items-center gap-3
                          text-[#2f312e]
                          font-semibold">

                    <i class="bi bi-handbag-fill"></i>
                    Cart

                </a>

                    <!-- PROFILE -->
                    <div class="flex items-center gap-3
                                bg-white
                                px-4 py-2
                                rounded-full
                                shadow-md
                                border border-[#d8ddd3]">

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

                        <i class="bi bi-chevron-down text-gray-600"></i>

                    </div>

                </div>

            </div>

        </div>

    </nav>

    <!-- CONTENT -->
    <div class="min-h-screen py-12">

        <div class="max-w-7xl mx-auto px-6">

            <!-- TITLE -->
            <div class="mb-12">

                <h1 class="text-5xl md:text-6xl
                           font-light
                           text-[#2f312e]">

                    Favorite Products

                </h1>

                <p class="text-[#7c8477]
                          mt-4
                          text-lg">

                    Produk favorite pilihan kamu

                </p>

            </div>

            @if($favorites->count() > 0)

                <!-- GRID -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach($favorites as $favorite)

                        <div class="bg-white
                                    rounded-[32px]
                                    overflow-hidden
                                    shadow-xl
                                    hover:-translate-y-1
                                    transition duration-300">

                            <!-- IMAGE -->
                            <div class="relative overflow-hidden">

                                @if($favorite->product->image)

                                    <img src="{{ asset('storage/' . $favorite->product->image) }}"
                                         class="w-full
                                                h-[340px]
                                                object-cover
                                                hover:scale-105
                                                transition duration-500">

                                @endif

                            </div>

                            <!-- CONTENT -->
                            <div class="p-6">

                                <h2 class="text-2xl
                                           font-semibold
                                           text-[#2f312e]">

                                    {{ $favorite->product->name }}

                                </h2>

                                <p class="text-[#55624d]
                                          text-2xl
                                          font-bold
                                          mt-4">

                                    Rp {{ number_format($favorite->product->price) }}

                                </p>

                                <!-- BUTTON -->
                                <div class="mt-6 flex flex-col gap-3">

                                    <a href="/products/{{ $favorite->product->id }}"
                                       class="w-full
                                              bg-[#55624d]
                                              hover:bg-[#40483a]
                                              text-white
                                              text-center
                                              py-4
                                              rounded-2xl
                                              font-semibold
                                              transition">

                                        View Product

                                    </a>

                                    <form action="/favorite/{{ $favorite->id }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button class="w-full
                                                       bg-red-500
                                                       hover:bg-red-600
                                                       text-white
                                                       py-4
                                                       rounded-2xl
                                                       font-semibold
                                                       transition">

                                            Hapus Favorite

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <!-- EMPTY -->
                <div class="bg-white
                            rounded-[32px]
                            shadow-xl
                            py-24
                            text-center">

                    <i class="bi bi-heart
                              text-7xl
                              text-[#c2c8bc]"></i>

                    <h2 class="text-4xl
                               font-semibold
                               text-[#9aa39a]
                               mt-8">

                        Belum Ada Favorite

                    </h2>

                    <p class="text-[#a6ada2]
                              mt-4
                              text-lg">

                        Tambahkan produk favorite kamu

                    </p>

                </div>

            @endif

        </div>

    </div>

</body>
</html>

