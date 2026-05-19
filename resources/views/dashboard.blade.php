<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abaya Fishamo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-[#edf1eb] text-[#2f312e]">

@php
    use App\Models\Cart;

    $cartCount = Cart::where('user_id', auth()->id())->count();
@endphp

<div class="min-h-screen bg-[#edf1eb]">

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
                <div class="hidden lg:flex items-center gap-8">

                    <a href="/dashboard"
                       class="text-[#2d312b]
                              border-b border-[#2d312b]
                              pb-1
                              font-medium">

                        All Products

                    </a>

                    <a href="#"
                       class="text-[#4d5449] hover:text-black transition">

                        New Arrivals

                    </a>

                    <a href="#"
                       class="text-[#4d5449] hover:text-black transition">

                        Best Seller

                    </a>

                </div>

                <!-- MOBILE -->
                <button onclick="toggleMenu()"
                        class="lg:hidden text-3xl text-[#4b5446]">

                    <i class="bi bi-list-stars"></i>

                </button>

                <!-- LOGO -->
                <div class="text-center">

                    <h1 class="text-2xl md:text-4xl
                               tracking-[6px] md:tracking-[10px]
                               font-light
                               leading-none
                               text-[#252825]">

                        ABAYA

                    </h1>

                    <p class="text-[10px] md:text-xs
                              tracking-[5px]
                              text-[#6d7568]
                              mt-1">

                        FISHAMO

                    </p>

                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-3 md:gap-5">

                    <!-- SEARCH -->
                    <div class="relative">

                        <button id="searchToggle"
                                class="w-12 h-12
                                       rounded-full
                                       bg-gradient-to-br
                                       from-[#dfe6da]
                                       to-[#cfd7c8]
                                       flex items-center justify-center
                                       text-[#55624d]
                                       shadow-md
                                       hover:scale-105 transition">

                            <i class="bi bi-search"></i>

                        </button>

                        <!-- SEARCH BOX -->
                        <div id="searchBox"
                             class="hidden absolute right-0 top-16 w-[300px]">

                            <form action="/dashboard" method="GET">

                                <div class="relative">

                                    <input type="text"
                                           name="search"
                                           value="{{ request('search') }}"
                                           placeholder="Search product..."
                                           class="w-full
                                                  bg-white
                                                  border border-[#d7ddd2]
                                                  rounded-2xl
                                                  py-4 pl-5 pr-12
                                                  shadow-xl
                                                  focus:outline-none
                                                  focus:ring-2
                                                  focus:ring-[#55624d]">

                                    <button type="submit"
                                            class="absolute
                                                   right-4 top-1/2
                                                   -translate-y-1/2">

                                        <i class="bi bi-search text-[#55624d]"></i>

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                    <!-- FAVORITE -->
                    <a href="/favorite"
                       class="w-12 h-12
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
                              w-12 h-12
                              rounded-full
                              bg-gradient-to-br
                              from-[#66725d]
                              to-[#4e5b46]
                              flex items-center justify-center
                              text-white
                              shadow-lg
                              hover:scale-105 transition">

                       <i class="bi bi-handbag-fill"></i>

                       @if($cartCount > 0)

                            <span class="absolute
                                         -top-1 -right-1
                                         bg-[#cfd7c8]
                                         text-[#55624d]
                                         text-[10px]
                                         w-5 h-5
                                         rounded-full
                                         flex items-center justify-center">

                                {{ $cartCount }}

                            </span>

                        @endif

                    </a>

                    <!-- PROFILE -->
                    @auth

                    <div class="relative" id="profileWrapper">

                        <button onclick="toggleProfileMenu()"
                                class="flex items-center gap-3
                                       bg-white/80
                                       hover:bg-white
                                       px-3 py-2
                                       rounded-full
                                       border border-[#d7ddd2]
                                       shadow-sm
                                       transition">

                            <img
                                src="{{ asset('storage/' . auth()->user()->photo) }}"
                                alt="Profile"
                                class="w-10 h-10 rounded-full object-cover">

                            <div class="hidden md:block text-left">

                                <p class="text-xs text-gray-500">
                                    Welcome
                                </p>

                                <p class="font-semibold text-sm text-[#2f312e]">
                                    {{ Auth::user()->name }}
                                </p>

                            </div>

                            <i class="bi bi-chevron-down text-sm"></i>

                        </button>

                        <!-- DROPDOWN -->
                        <div id="profileMenu"
                             class="hidden absolute right-0 mt-3
                                    w-56 bg-white rounded-2xl
                                    shadow-xl border border-[#dde3d8]
                                    overflow-hidden">

                            <div class="px-4 py-4
                                        bg-gradient-to-r
                                        from-[#66725d]
                                        to-[#87927d]
                                        text-white">

                                <p class="font-semibold">
                                    {{ Auth::user()->name }}
                                </p>

                                <p class="text-sm opacity-80 break-all">
                                    {{ Auth::user()->email }}
                                </p>

                            </div>

                            <div class="py-2">

                                <a href="/profile"
                                   class="block px-4 py-3 hover:bg-[#edf1eb]">

                                    Profile Saya

                                </a>

                                <a href="{{ route('my.orders') }}"
                                    class="block px-4 py-3 hover:bg-[#edf1eb]">
                                    
                                    Pesanan Saya
                                </a>

                                <form method="POST"
                                      action="{{ route('logout') }}">

                                    @csrf

                                    <button type="submit"
                                            class="w-full text-left
                                                   px-4 py-3
                                                   hover:bg-red-50
                                                   text-red-500">

                                        Logout

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                    @endauth

                </div>

            </div>

            <!-- MOBILE MENU -->
            <div id="mobileMenu"
                 class="hidden lg:hidden pb-6">

                <div class="flex flex-col gap-4 pt-4">

                    <a href="/dashboard" class="text-[#444] font-medium">
                        All Products
                    </a>

                    <a href="#" class="text-[#444] font-medium">
                        New Arrivals
                    </a>

                    <a href="#" class="text-[#444] font-medium">
                        Best Seller
                    </a>

                    <a href="#" class="text-[#444] font-medium">
                        Occasion
                    </a>

                </div>

            </div>

        </div>

    </nav>

   <!-- HERO SECTION -->
<section class="bg-[#edf1eb] overflow-hidden">

    <!-- CONTENT -->
    <div class="max-w-7xl mx-auto
                text-center
                pt-20 md:pt-28
                px-6">

        <p class="tracking-[10px]
                  text-[#55624d]
                  text-sm md:text-lg
                  mb-5">

            ELEGANCE IN EVERY DETAIL

        </p>

        <h1 class="text-5xl
                   md:text-7xl
                   font-extralight
                   text-[#55624d]
                   leading-none">

            ABAYA FISHAMO

        </h1>

        <p class="mt-6
                  text-sm md:text-xl
                  text-[#55624d]/90
                  max-w-2xl
                  mx-auto">

            Discover timeless modest fashion
            designed with luxury and elegance.

        </p>

        <a href="#products"
           class="inline-block
                  mt-10
                  px-10 py-4
                  rounded-full
                  bg-[#6c775f]
                  hover:bg-[#55624d]
                  transition
                  shadow-xl
                  tracking-[3px]
                  text-white">

            SHOP NOW

        </a>

    </div>

</section>

<!-- BANNER IMAGE -->
    <div class="mt-16">

        <img src="{{ asset('images/banner-abaya.jpg') }}"
             alt="Banner"
             class="w-full
                    h-auto
                    object-cover">

    </div>
<!-- TITLE -->
<div class="max-w-7xl mx-auto
            px-4 sm:px-6 lg:px-8
            pt-14">

    <h1 class="text-5xl md:text-7xl
               font-light
               text-[#222822]">

        All Products

    </h1>

</div>

    <!-- PRODUCT GRID -->
    <div class="max-w-7xl mx-auto
                px-4 sm:px-6 lg:px-8
                py-10 md:py-16">

        @if(isset($products) && count($products) > 0)

            <div class="grid
                        grid-cols-2
                        md:grid-cols-3
                        xl:grid-cols-4
                        gap-x-4 md:gap-x-7
                        gap-y-10">

                @foreach($products as $product)

                    <a href="/products/{{ $product->id }}"
                       class="group transition duration-300 hover:-translate-y-1">

                        <!-- IMAGE -->
                        <div class="relative overflow-hidden
                                    rounded-[24px] md:rounded-[34px]
                                    bg-white
                                    shadow-[0_10px_30px_rgba(0,0,0,0.08)]">

                            @if($product->image)

                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full
                                            h-[240px]
                                            sm:h-[320px]
                                            md:h-[380px]
                                            object-cover
                                            group-hover:scale-105
                                            transition duration-500">

                            @endif

                        </div>

                        <!-- CONTENT -->
                        <div class="pt-4">

                            <h2 class="text-sm md:text-lg
                                       text-[#252825]
                                       line-clamp-1">

                                {{ $product->name }}

                            </h2>

                            <p class="text-xs md:text-sm
                                      text-[#798072]
                                      mt-1">

                                {{ $product->category }}

                            </p>

                            <p class="mt-2
                                      text-[#55624d]
                                      font-semibold
                                      text-sm md:text-lg">

                                Rp {{ number_format($product->price) }}

                            </p>

                        </div>

                    </a>

                @endforeach

            </div>

        @endif

    </div>

</div>

<!-- SCRIPT -->
<script>

    function toggleMenu() {

        document
            .getElementById('mobileMenu')
            ?.classList
            .toggle('hidden');

    }

    function toggleProfileMenu() {

        document
            .getElementById('profileMenu')
            ?.classList
            .toggle('hidden');

    }

    const searchToggle =
        document.getElementById('searchToggle');

    const searchBox =
        document.getElementById('searchBox');

    searchToggle.addEventListener('click', () => {

        searchBox.classList.toggle('hidden');

    });

    window.addEventListener('click', function(e) {

        const wrapper = document.getElementById('profileWrapper');
        const menu = document.getElementById('profileMenu');

        if (wrapper && menu && !wrapper.contains(e.target)) {

            menu.classList.add('hidden');

        }

    });

</script>

</body>
</html>

