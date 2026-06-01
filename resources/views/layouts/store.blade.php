<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Abaya Fishamo — Luxury Modest Fashion')</title>
    <meta name="description" content="@yield('meta_description', 'Abaya Fishamo menghadirkan fashion muslim premium dengan desain elegan, modern, dan mewah untuk wanita yang ingin tampil anggun setiap hari.')">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        [x-cloak] { display: none !important; }

        .nav-link-active {
            border-bottom: 2px solid #55624d;
        }
    </style>
</head>

<body class="bg-[#edf1eb] text-[#2f312e] overflow-x-hidden">

@php
    use App\Models\Cart;
    $cartCount = auth()->check() ? Cart::where('user_id', auth()->id())->count() : 0;
@endphp

{{-- TOP BAR --}}
<div class="bg-gradient-to-r from-[#55624d] via-[#7b8870] to-[#55624d]
            text-white text-center py-3 text-[10px] md:text-sm tracking-[4px]">

    @yield('topbar_text', 'LUXURY MODEST FASHION • ABAYA FISHAMO')

</div>

{{-- NAVBAR --}}
<nav id="mainNav"
     class="sticky top-0 z-50 bg-[#edf1eb]/95 backdrop-blur-md border-b border-[#d8ddd3] shadow-sm transition-shadow duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between h-20 md:h-24">

            {{-- LEFT MENU --}}
            <div class="hidden lg:flex items-center gap-8">

                <a href="{{ route('dashboard') }}"
                   class="text-[#4d5449] hover:text-[#2d312b] transition font-medium
                          @yield('nav_allproducts')">

                    All Products

                </a>

                <a href="#"
                   class="text-[#4d5449] hover:text-[#2d312b] transition">
                    New Arrivals
                </a>

                <a href="#"
                   class="text-[#4d5449] hover:text-[#2d312b] transition">
                    Best Seller
                </a>

            </div>

            {{-- MOBILE HAMBURGER --}}
            <button onclick="toggleMobileMenu()"
                    class="lg:hidden text-3xl text-[#4b5446]">
                <i class="bi bi-list-stars"></i>
            </button>

            {{-- CENTER LOGO --}}
            <a href="{{ route('dashboard') }}" class="text-center">

                <h1 class="text-2xl md:text-4xl
                           tracking-[6px] md:tracking-[10px]
                           font-extralight
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

            </a>

            {{-- RIGHT ICONS --}}
            <div class="flex items-center gap-3 md:gap-5">

                @auth

                {{-- SEARCH --}}
                <div class="relative" id="searchWrapper">

                    <button id="searchToggle"
                            class="w-11 h-11 rounded-full
                                   bg-gradient-to-br from-[#dfe6da] to-[#cfd7c8]
                                   flex items-center justify-center
                                   text-[#55624d] shadow-md
                                   hover:scale-105 transition">
                        <i class="bi bi-search"></i>
                    </button>

                    <div id="searchBox"
                         class="hidden absolute right-0 top-14 w-[300px] z-50">

                        <form action="{{ route('dashboard') }}" method="GET">
                            <div class="relative">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Cari produk..."
                                       class="w-full bg-white border border-[#d7ddd2]
                                              rounded-2xl py-4 pl-5 pr-12 shadow-xl
                                              focus:outline-none focus:ring-2 focus:ring-[#55624d]">
                                <button type="submit"
                                        class="absolute right-4 top-1/2 -translate-y-1/2">
                                    <i class="bi bi-search text-[#55624d]"></i>
                                </button>
                            </div>
                        </form>

                    </div>

                </div>

                {{-- FAVORITE --}}
                <a href="{{ route('favorite.index') }}"
                   class="w-11 h-11 rounded-full
                          bg-gradient-to-br from-[#dfe6da] to-[#cfd7c8]
                          flex items-center justify-center
                          text-[#55624d] shadow-md
                          hover:scale-105 transition"
                   title="Favorit">
                    <i class="bi bi-box2-heart-fill"></i>
                </a>

                {{-- CART --}}
                <a href="{{ route('cart.index') }}"
                   class="relative w-11 h-11 rounded-full
                          bg-gradient-to-br from-[#66725d] to-[#4e5b46]
                          flex items-center justify-center
                          text-white shadow-lg
                          hover:scale-105 transition"
                   title="Keranjang">

                    <i class="bi bi-handbag-fill"></i>

                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1
                                     bg-[#cfd7c8] text-[#55624d]
                                     text-[10px] w-5 h-5 rounded-full
                                     flex items-center justify-center font-semibold">
                            {{ $cartCount }}
                        </span>
                    @endif

                </a>

                {{-- PROFILE DROPDOWN --}}
                <div class="relative" id="profileWrapper">

                    <button onclick="toggleProfileMenu()"
                            class="flex items-center gap-2
                                   bg-white/80 hover:bg-white
                                   px-3 py-2 rounded-full
                                   border border-[#d7ddd2] shadow-sm transition">

                        <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                             alt="Profile"
                             class="w-9 h-9 rounded-full object-cover"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=66725d&color=fff'">

                        <div class="hidden md:block text-left">
                            <p class="text-[10px] text-gray-400">Welcome</p>
                            <p class="font-semibold text-xs text-[#2f312e]">{{ Auth::user()->name }}</p>
                        </div>

                        <i class="bi bi-chevron-down text-xs text-gray-400"></i>

                    </button>

                    {{-- DROPDOWN --}}
                    <div id="profileMenu"
                         class="hidden absolute right-0 mt-3 w-56 bg-white
                                rounded-2xl shadow-2xl border border-[#dde3d8] overflow-hidden z-50">

                        <div class="px-4 py-4 bg-gradient-to-r from-[#66725d] to-[#87927d] text-white">
                            <p class="font-semibold text-sm">{{ Auth::user()->name }}</p>
                            <p class="text-xs opacity-75 break-all mt-0.5">{{ Auth::user()->email }}</p>
                        </div>

                        <div class="py-1">

                            <a href="{{ route('profile.edit') }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm
                                      hover:bg-[#edf1eb] transition">
                                <i class="bi bi-person text-[#55624d]"></i>
                                Profile Saya
                            </a>

                            <a href="{{ route('my.orders') }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm
                                      hover:bg-[#edf1eb] transition">
                                <i class="bi bi-bag-check text-[#55624d]"></i>
                                Pesanan Saya
                            </a>

                            <a href="{{ route('favorite.index') }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm
                                      hover:bg-[#edf1eb] transition">
                                <i class="bi bi-heart text-[#55624d]"></i>
                                Favorit Saya
                            </a>

                            <div class="border-t border-gray-100 mt-1 pt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full flex items-center gap-3 px-4 py-3 text-sm
                                                   text-red-500 hover:bg-red-50 transition">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>

                @else

                {{-- GUEST BUTTONS --}}
                <a href="{{ route('login') }}"
                   class="px-5 py-2 rounded-full border border-[#55624d]
                          text-[#55624d] hover:bg-[#55624d] hover:text-white transition text-sm">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="px-5 py-2 rounded-full bg-[#55624d]
                          text-white hover:bg-[#66725d] hover:scale-105 transition text-sm shadow-md">
                    Register
                </a>

                @endauth

            </div>

        </div>

        {{-- MOBILE MENU --}}
        <div id="mobileMenu" class="hidden lg:hidden pb-5 border-t border-[#d8ddd3] mt-1">

            <div class="flex flex-col gap-3 pt-4">

                <a href="{{ route('dashboard') }}" class="text-[#444] font-medium py-1">
                    All Products
                </a>

                <a href="#" class="text-[#444] font-medium py-1">New Arrivals</a>

                <a href="#" class="text-[#444] font-medium py-1">Best Seller</a>

                @auth
                    <a href="{{ route('my.orders') }}" class="text-[#444] font-medium py-1">
                        Pesanan Saya
                    </a>
                    <a href="{{ route('cart.index') }}" class="text-[#444] font-medium py-1">
                        Keranjang
                        @if($cartCount > 0)
                            <span class="ml-1 bg-[#55624d] text-white text-xs px-2 py-0.5 rounded-full">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                @endauth

            </div>

        </div>

    </div>

</nav>

{{-- PAGE CONTENT --}}
<main>
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="bg-[#55624d] text-white pt-20 pb-10">

    <div class="max-w-7xl mx-auto px-6">

        {{-- TOP --}}
        <div class="grid md:grid-cols-3 gap-14 border-b border-white/10 pb-14">

            {{-- BRAND --}}
            <div>

                <h2 class="text-4xl tracking-[8px] font-extralight">ABAYA</h2>

                <p class="tracking-[6px] text-sm mt-2 text-white/70">FISHAMO</p>

                <p class="mt-6 text-white/70 leading-8">
                    Luxury modest fashion collection
                    crafted with elegance,
                    beauty, and timeless design.
                </p>

            </div>

            {{-- NAVIGATION --}}
            <div>

                <h3 class="text-lg tracking-[2px] mb-6 font-light">Navigation</h3>

                <div class="flex flex-col gap-4 text-white/70">

                    <a href="{{ route('dashboard') }}" class="hover:text-white transition">Home</a>

                    <a href="{{ route('dashboard') }}" class="hover:text-white transition">Collection</a>

                    <a href="#" class="hover:text-white transition">About Us</a>

                    <a href="https://wa.me/6283180065732" target="_blank"
                       class="hover:text-white transition">Contact</a>

                </div>

            </div>

            {{-- SOCIAL --}}
            <div>

                <h3 class="text-lg tracking-[2px] mb-6 font-light">Follow Us</h3>

                <div class="flex flex-col gap-5 text-white/70">

                    <a href="https://www.instagram.com/abaya.fishamo"
                       target="_blank"
                       class="flex items-center gap-3 hover:text-white transition">
                        <i class="bi bi-instagram text-xl"></i>
                        Instagram
                    </a>

                    <a href="https://wa.me/6283180065732"
                       target="_blank"
                       class="flex items-center gap-3 hover:text-white transition">
                        <i class="bi bi-whatsapp text-xl"></i>
                        WhatsApp
                    </a>

                    <a href="https://www.tiktok.com/@abaya.fishamo"
                       target="_blank"
                       class="flex items-center gap-3 hover:text-white transition">
                        <i class="bi bi-tiktok text-xl"></i>
                        TikTok
                    </a>

                    <a href="https://shopee.co.id/abaya.fishamo"
                       target="_blank"
                       class="flex items-center gap-3 hover:text-white transition">
                        <i class="bi bi-bag-heart text-xl"></i>
                        Shopee
                    </a>

                    <a href="https://tk.tokopedia.com/ZSx5A4B6h/"
                       target="_blank"
                       class="flex items-center gap-3 hover:text-white transition">
                        <i class="bi bi-shop text-xl"></i>
                        Tokopedia
                    </a>

                </div>

            </div>

        </div>

        {{-- BOTTOM --}}
        <div class="pt-8 flex flex-col md:flex-row items-center justify-between
                    gap-4 text-white/50 text-sm">

            <p>© {{ date('Y') }} Abaya Fishamo. All Rights Reserved.</p>

            <p>Luxury Modest Fashion Indonesia</p>

        </div>

    </div>

</footer>

{{-- SCRIPTS --}}
<script>

    function toggleMobileMenu() {
        document.getElementById('mobileMenu')?.classList.toggle('hidden');
    }

    function toggleProfileMenu() {
        document.getElementById('profileMenu')?.classList.toggle('hidden');
    }

    // Search toggle
    const searchToggle = document.getElementById('searchToggle');
    const searchBox    = document.getElementById('searchBox');
    const searchWrapper = document.getElementById('searchWrapper');

    if (searchToggle && searchBox) {
        searchToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            searchBox.classList.toggle('hidden');
        });
    }

    // Close dropdowns when clicking outside
    window.addEventListener('click', function (e) {

        // Close profile menu
        const profileWrapper = document.getElementById('profileWrapper');
        const profileMenu    = document.getElementById('profileMenu');

        if (profileWrapper && profileMenu && !profileWrapper.contains(e.target)) {
            profileMenu.classList.add('hidden');
        }

        // Close search
        if (searchWrapper && searchBox && !searchWrapper.contains(e.target)) {
            searchBox.classList.add('hidden');
        }

    });

    // Navbar shadow on scroll
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('mainNav');
        if (nav) {
            if (window.scrollY > 10) {
                nav.classList.add('shadow-md');
            } else {
                nav.classList.remove('shadow-md');
            }
        }
    });

</script>

@yield('scripts')

</body>
</html>
