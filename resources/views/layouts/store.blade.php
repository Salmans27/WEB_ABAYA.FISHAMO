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
        
        /* Smooth scrolling */
        html { scroll-behavior: smooth; }

        /* Hide scrollbar for category pills but keep functionality */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-[#edf1eb] text-[#2f312e] overflow-x-hidden font-sans antialiased selection:bg-[#55624d] selection:text-white">

@php
    use App\Models\Cart;
    $cartCount = auth()->check() ? Cart::where('user_id', auth()->id())->count() : 0;
@endphp

{{-- TOP BAR --}}
<div class="bg-gradient-to-r from-[#55624d] via-[#7b8870] to-[#55624d] text-white text-center py-2 md:py-3 text-[8px] sm:text-[10px] md:text-sm tracking-[2px] sm:tracking-[4px] px-4">
    @yield('topbar_text', 'LUXURY MODEST FASHION • FREE SHIPPING ACROSS INDONESIA')
</div>

{{-- NAVBAR (LUXURY LAYOUT: Links Left, Logo Center, Icons Right) --}}
<nav id="mainNav"
     class="sticky top-0 z-50 bg-[#edf1eb]/95 backdrop-blur-md border-b border-[#d8ddd3] shadow-sm transition-all duration-300">

    <div class="max-w-[1400px] mx-auto px-3 sm:px-6 lg:px-12">

        <div class="flex items-center justify-between h-16 sm:h-20 md:h-24 relative">

            {{-- LEFT: NAVIGATION LINKS & HAMBURGER --}}
            <div class="flex-1 flex items-center">
                
                {{-- MOBILE HAMBURGER --}}
                <button onclick="toggleMobileMenu()" class="lg:hidden text-2xl text-[#2d312b] hover:text-[#55624d] transition-colors mr-4">
                    <i class="bi bi-list"></i>
                </button>

                {{-- DESKTOP LINKS --}}
                <div class="hidden lg:flex items-center gap-8 text-[11px] font-semibold tracking-[2px] uppercase">
                    <a href="{{ route('dashboard') }}" class="text-[#2d312b] hover:text-[#7b8870] transition-colors @yield('nav_allproducts')">
                        Boutique
                    </a>
                    <a href="#new-arrivals" class="text-[#2d312b] hover:text-[#7b8870] transition-colors">
                        New Arrivals
                    </a>
                    <a href="#best-sellers" class="text-[#2d312b] hover:text-[#7b8870] transition-colors">
                        Best Sellers
                    </a>
                </div>
            </div>

            {{-- CENTER: LOGO --}}
            <a href="{{ route('dashboard') }}" class="flex-shrink-0 text-center flex flex-col items-center justify-center absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10 pointer-events-none sm:pointer-events-auto">
                <h1 class="text-base sm:text-2xl md:text-[34px] tracking-[3px] sm:tracking-[6px] md:tracking-[10px] font-extralight text-[#1a1a1a] uppercase leading-none pointer-events-auto">
                    ABAYA
                </h1>
                <p class="text-[6px] sm:text-[9px] md:text-[10px] tracking-[3px] sm:tracking-[8px] text-[#55624d] mt-1 sm:mt-2 ml-1 sm:ml-2 uppercase font-medium pointer-events-auto">
                    FISHAMO
                </p>
            </a>

            {{-- RIGHT: ICONS --}}
            <div class="flex-1 flex items-center justify-end gap-2 sm:gap-5 md:gap-6 relative z-20">

                @auth
                {{-- SEARCH ICON --}}
                <button onclick="toggleSearch()" class="text-lg sm:text-xl text-[#2d312b] hover:text-[#7b8870] transition-colors">
                    <i class="bi bi-search"></i>
                </button>

                {{-- FAVORITE ICON --}}
                <a href="{{ route('favorite.index') }}" class="text-lg sm:text-xl text-[#2d312b] hover:text-[#7b8870] transition-colors hidden sm:block">
                    <i class="bi bi-heart"></i>
                </a>

                {{-- PROFILE DROPDOWN --}}
                <div class="relative" id="profileWrapper">
                    <button onclick="toggleProfileMenu()" class="text-lg sm:text-xl text-[#2d312b] hover:text-[#7b8870] transition-colors flex items-center gap-2">
                        <i class="bi bi-person"></i>
                    </button>

                    {{-- DROPDOWN --}}
                    <div id="profileMenu" class="hidden absolute right-[-20px] sm:right-0 mt-5 w-56 sm:w-64 bg-white border border-gray-100 shadow-2xl z-50 p-6">
                        <div class="mb-6 pb-6 border-b border-gray-100 text-center">
                            <div class="w-16 h-16 rounded-full mx-auto mb-3 overflow-hidden border border-gray-100">
                                <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Profile" class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=55624d&color=fff'">
                            </div>
                            <p class="font-medium text-sm text-[#1a1a1a]">{{ Auth::user()->name }}</p>
                            <p class="text-[11px] text-gray-500 mt-1">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="space-y-4">
                            <a href="{{ route('profile.edit') }}" class="block text-xs uppercase tracking-[1px] text-[#55624d] hover:text-black transition-colors"><i class="bi bi-person-gear mr-3"></i> Profile Saya</a>
                            <a href="{{ route('my.orders') }}" class="block text-xs uppercase tracking-[1px] text-[#55624d] hover:text-black transition-colors"><i class="bi bi-bag-check mr-3"></i> Pesanan Saya</a>
                            <a href="{{ route('favorite.index') }}" class="block text-xs uppercase tracking-[1px] text-[#55624d] hover:text-black transition-colors"><i class="bi bi-heart mr-3"></i> Favorit Saya</a>
                            
                            <form method="POST" action="{{ route('logout') }}" class="pt-4 mt-4 border-t border-gray-100">
                                @csrf
                                <button type="submit" class="w-full text-left text-xs uppercase tracking-[1px] text-red-500 hover:text-red-700 transition-colors">
                                    <i class="bi bi-box-arrow-right mr-3"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- CART ICON --}}
                <a href="{{ route('cart.index') }}" class="relative text-lg sm:text-xl text-[#2d312b] hover:text-[#7b8870] transition-colors">
                    <i class="bi bi-bag"></i>
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-[#55624d] text-white text-[8px] sm:text-[9px] w-3.5 h-3.5 sm:w-4 sm:h-4 rounded-full flex items-center justify-center font-bold">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                @else
                
                {{-- GUEST --}}
                <a href="{{ route('login') }}" class="text-[10px] md:text-xs font-semibold uppercase tracking-[2px] text-[#2d312b] hover:text-[#7b8870] transition-colors">
                    Login
                </a>
                <span class="text-gray-300">|</span>
                <a href="{{ route('register') }}" class="text-[10px] md:text-xs font-semibold uppercase tracking-[2px] text-[#2d312b] hover:text-[#7b8870] transition-colors">
                    Register
                </a>
                
                @endauth

            </div>

        </div>

    </div>

    {{-- SEARCH DROPDOWN (Centered) --}}
    <div id="searchOverlay" class="hidden absolute top-[100%] left-1/2 -translate-x-1/2 w-[95%] sm:w-[90%] md:w-[500px] bg-white border-x border-b border-[#d8ddd3] rounded-b-2xl shadow-xl z-[60] p-3 sm:p-5 transition-all duration-300">
        <form action="{{ route('dashboard') }}" method="GET" class="relative flex items-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." 
                   class="w-full bg-[#edf1eb] border-none text-sm text-[#2d312b] rounded-full py-3 px-5 pr-12 focus:ring-1 focus:ring-[#55624d] placeholder-gray-400 transition-colors" autofocus id="searchInput">
            <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-lg text-[#55624d] w-10 h-10 flex items-center justify-center hover:bg-[#d8ddd3] rounded-full transition-colors">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

</nav>

    {{-- MOBILE MENU SLIDEOUT --}}
    <div id="mobileMenu" class="fixed inset-y-0 left-0 w-[85%] sm:w-[350px] bg-white shadow-[20px_0_50px_rgba(0,0,0,0.1)] z-[60] transform -translate-x-full transition-transform duration-500 flex flex-col">
        
        {{-- HEADER --}}
        <div class="px-6 py-5 border-b border-[#ecefea] flex justify-between items-center bg-white">
            <h2 class="text-xs tracking-[4px] uppercase font-bold text-[#55624d]">Menu</h2>
            <button onclick="toggleMobileMenu()" class="text-2xl text-gray-400 hover:text-black transition-colors">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        
        <div class="flex-1 overflow-y-auto bg-white pb-10">
            
            {{-- PROFILE SECTION --}}
            @auth
            <div class="p-6 border-b border-[#ecefea] bg-[#f8faf7] flex items-center gap-4">
                <div class="w-14 h-14 rounded-full overflow-hidden border border-[#d8ddd3] shrink-0">
                    <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Profile" class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=55624d&color=fff'">
                </div>
                <div>
                    <p class="font-bold text-[#2d312b] line-clamp-1">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] tracking-[1px] uppercase text-[#7b8870] mt-1">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Customer' }}</p>
                </div>
            </div>
            @else
            <div class="p-6 border-b border-[#ecefea] bg-[#f8faf7] text-center">
                <p class="text-xs text-[#7b8870] mb-4">Selamat datang di Abaya Fishamo</p>
                <div class="flex gap-3 justify-center">
                    <a href="{{ route('login') }}" class="px-6 py-2.5 bg-[#55624d] text-white text-[10px] uppercase tracking-[2px] font-semibold rounded-full shadow-md hover:bg-[#40483a] transition">Login</a>
                    <a href="{{ route('register') }}" class="px-6 py-2.5 border border-[#55624d] text-[#55624d] text-[10px] uppercase tracking-[2px] font-semibold rounded-full hover:bg-[#edf1eb] transition">Register</a>
                </div>
            </div>
            @endauth

            {{-- MAIN LINKS --}}
            <div class="p-4 space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium text-[#2d312b] hover:bg-[#edf1eb] transition-colors">
                    <i class="bi bi-shop text-lg text-[#7b8870]"></i> Boutique
                </a>
                <a href="#new-arrivals" class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium text-[#2d312b] hover:bg-[#edf1eb] transition-colors">
                    <i class="bi bi-stars text-lg text-[#7b8870]"></i> New Arrivals
                </a>
                <a href="#best-sellers" class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium text-[#2d312b] hover:bg-[#edf1eb] transition-colors">
                    <i class="bi bi-award text-lg text-[#7b8870]"></i> Best Sellers
                </a>
            </div>
            
            {{-- ACCOUNT LINKS --}}
            @auth
            <div class="px-4 pb-4 border-b border-[#ecefea] space-y-1">
                <p class="text-[10px] tracking-[2px] text-gray-400 uppercase font-bold mt-2 mb-3 px-4">My Account</p>
                <a href="{{ route('cart.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium text-[#2d312b] hover:bg-[#edf1eb] transition-colors">
                    <i class="bi bi-bag text-lg text-[#55624d]"></i> Keranjang Saya
                </a>
                <a href="{{ route('favorite.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium text-[#2d312b] hover:bg-[#edf1eb] transition-colors">
                    <i class="bi bi-heart text-lg text-[#55624d]"></i> Favorit Saya
                </a>
                <a href="{{ route('my.orders') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium text-[#2d312b] hover:bg-[#edf1eb] transition-colors">
                    <i class="bi bi-bag-check text-lg text-[#55624d]"></i> Pesanan Saya
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium text-[#2d312b] hover:bg-[#edf1eb] transition-colors">
                    <i class="bi bi-person-gear text-lg text-[#55624d]"></i> Profil
                </a>
            </div>
            
            <div class="p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full gap-4 px-4 py-3 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50 transition-colors">
                        <i class="bi bi-box-arrow-right text-lg"></i> Logout
                    </button>
                </form>
            </div>
            @endauth
            
        </div>
    </div>
    
    {{-- MOBILE MENU BACKDROP --}}
    <div id="mobileBackdrop" onclick="toggleMobileMenu()" class="fixed inset-0 bg-black/50 z-[55] opacity-0 pointer-events-none transition-opacity duration-500"></div>

{{-- PAGE CONTENT --}}
<main class="min-h-screen">
    @yield('content')
</main>

{{-- FOOTER (HIGH-END MINIMALIST) --}}
<footer class="bg-[#55624d] text-white border-t border-[#55624d] pt-12 md:pt-24 pb-8 md:pb-12">

    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-12">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 sm:gap-12 lg:gap-10 mb-12 md:mb-20">

            {{-- BRAND --}}
            <div class="lg:col-span-1">
                <h2 class="text-[28px] tracking-[8px] font-extralight text-white uppercase leading-none">ABAYA</h2>
                <p class="text-[10px] tracking-[6px] text-white/70 mt-2 ml-1 uppercase font-medium">FISHAMO</p>
                <p class="mt-8 text-sm text-white/70 leading-relaxed font-light">
                    Redefining luxury modest fashion. Crafted with elegance, beauty, and timeless design for the modern woman.
                </p>
            </div>

            {{-- BOUTIQUE --}}
            <div>
                <h3 class="text-xs tracking-[3px] font-semibold text-white uppercase mb-8">Boutique</h3>
                <ul class="space-y-4 text-sm font-light text-white/70">
                    <li><a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Shop All Collection</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">New Arrivals</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Best Sellers</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Size Guide</a></li>
                </ul>
            </div>

            {{-- CUSTOMER CARE --}}
            <div>
                <h3 class="text-xs tracking-[3px] font-semibold text-white uppercase mb-8">Customer Care</h3>
                <ul class="space-y-4 text-sm font-light text-white/70">
                    <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Shipping & Returns</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Terms & Conditions</a></li>
                </ul>
            </div>

            {{-- CONNECT --}}
            <div>
                <h3 class="text-xs tracking-[3px] font-semibold text-white uppercase mb-8">Connect With Us</h3>
                <div class="flex gap-5">
                    <a href="https://www.instagram.com/abaya.fishamo" target="_blank" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white/70 hover:bg-white hover:text-[#55624d] hover:border-white transition-all">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://wa.me/6283180065732" target="_blank" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white/70 hover:bg-white hover:text-[#55624d] hover:border-white transition-all">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                    <a href="https://www.tiktok.com/@abaya.fishamo" target="_blank" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white/70 hover:bg-white hover:text-[#55624d] hover:border-white transition-all">
                        <i class="bi bi-tiktok"></i>
                    </a>
                </div>
                <p class="text-xs text-white/70 font-light mt-6">Email: hello@abayafishamo.com</p>
                <p class="text-xs text-white/70 font-light mt-2">WA: +62 831 8006 5732</p>
            </div>

        </div>

        {{-- BOTTOM --}}
        <div class="border-t border-white/10 pt-6 md:pt-8 flex flex-col md:flex-row items-center justify-between gap-3 md:gap-4 text-[10px] sm:text-xs font-light text-white/50 uppercase tracking-[1px]">
            <p>© {{ date('Y') }} ABAYA FISHAMO. ALL RIGHTS RESERVED.</p>
            <p>IDR / INDONESIA</p>
        </div>

    </div>

</footer>

{{-- SCRIPTS --}}
<script>

    // Mobile Menu
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        const backdrop = document.getElementById('mobileBackdrop');
        
        if (menu.classList.contains('-translate-x-full')) {
            menu.classList.remove('-translate-x-full');
            backdrop.classList.remove('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'hidden'; // prevent scrolling
        } else {
            menu.classList.add('-translate-x-full');
            backdrop.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = '';
        }
    }

    // Search Dropdown
    function toggleSearch() {
        const overlay = document.getElementById('searchOverlay');
        const input = document.getElementById('searchInput');
        
        if (overlay.classList.contains('hidden')) {
            overlay.classList.remove('hidden');
            setTimeout(() => input.focus(), 100);
        } else {
            overlay.classList.add('hidden');
        }
    }

    // Profile Menu
    function toggleProfileMenu() {
        document.getElementById('profileMenu')?.classList.toggle('hidden');
    }

    // Close dropdowns on outside click
    window.addEventListener('click', function (e) {
        const profileWrapper = document.getElementById('profileWrapper');
        const profileMenu    = document.getElementById('profileMenu');

        if (profileWrapper && profileMenu && !profileWrapper.contains(e.target)) {
            profileMenu.classList.add('hidden');
        }
    });

    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('mainNav');
        if (nav) {
            if (window.scrollY > 10) {
                nav.classList.add('py-0');
            } else {
                nav.classList.remove('py-0');
            }
        }
    });

</script>

@yield('scripts')

</body>
</html>
