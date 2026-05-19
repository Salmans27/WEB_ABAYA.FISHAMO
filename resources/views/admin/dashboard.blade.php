<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Abaya Fishamo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-[#edf1eb] text-[#2f312e]">

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

        ABAYA FISHAMO ADMIN PANEL

    </div>

    <!-- NAVBAR -->
    <nav class="sticky top-0 z-50
                bg-[#edf1eb]/95
                backdrop-blur-md
                border-b border-[#d8ddd3]
                shadow-sm">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between h-20 md:h-24">

                <!-- LEFT MENU -->
                <div class="hidden lg:flex items-center gap-8">

                    <a href="/admin/dashboard"
                       class="text-[#2d312b]
                              border-b border-[#2d312b]
                              pb-1
                              font-medium">

                        Dashboard

                    </a>

                    <a href="/admin/products"
                       class="text-[#4d5449] hover:text-black transition">

                        Products

                    </a>

                </div>

                <!-- MOBILE BUTTON -->
                <button onclick="toggleMenu()"
                        class="lg:hidden text-3xl text-[#4b5446]">

                    ☰

                </button>

                <!-- LOGO -->
                <div class="flex items-center gap-3">

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

                            ADMIN

                        </p>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-3 md:gap-5">

                    <!-- PRODUCT BUTTON -->
                    <a href="/admin/products/create"
                       class="hidden md:flex
                              items-center gap-2
                              bg-gradient-to-br
                              from-[#66725d]
                              to-[#4e5b46]
                              text-white
                              px-5 py-3
                              rounded-2xl
                              shadow-lg
                              hover:scale-105
                              transition">

                        <i class="bi bi-plus-circle-fill"></i>

                        Add Product

                    </a>

                    <!-- PROFILE -->
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
                                    Admin
                                </p>

                                <p class="font-semibold text-sm text-[#2f312e]">
                                    {{ auth()->user()->name }}
                                </p>

                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4 text-[#555]"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>

                            </svg>

                        </button>

                        <!-- DROPDOWN -->
                        <div id="profileMenu"
                             class="hidden absolute right-0 mt-3
                                    w-56
                                    bg-white
                                    rounded-2xl
                                    shadow-xl
                                    border border-[#dde3d8]
                                    overflow-hidden">

                            <!-- HEADER -->
                            <div class="px-4 py-4
                                        bg-gradient-to-r
                                        from-[#66725d]
                                        to-[#87927d]
                                        text-white">

                                <p class="font-semibold">
                                    {{ auth()->user()->name }}
                                </p>

                                <p class="text-sm opacity-80 break-all">
                                    {{ auth()->user()->email }}
                                </p>

                            </div>

                            <!-- MENU -->
                            <div class="py-2">

                                <a href="/profile"
                                   class="block px-4 py-3
                                          hover:bg-[#edf1eb]
                                          transition">

                                    Profile

                                </a>

                                <a href="/admin/products"
                                   class="block px-4 py-3
                                          hover:bg-[#edf1eb]
                                          transition">

                                    Manage Products

                                </a>

                                <!-- LOGOUT -->
                                <form method="POST"
                                      action="{{ route('logout') }}">

                                    @csrf

                                    <button type="submit"
                                            class="w-full text-left
                                                   px-4 py-3
                                                   hover:bg-red-50
                                                   text-red-500
                                                   transition">

                                        Logout

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- MOBILE MENU -->
            <div id="mobileMenu"
                 class="hidden lg:hidden pb-6">

                <div class="flex flex-col gap-4 pt-4">

                    <a href="/admin/dashboard"
                       class="text-[#444] font-medium">

                        Dashboard

                    </a>

                    <a href="/admin/products"
                       class="text-[#444] font-medium">

                        Products

                    </a>

                    <a href="/admin/products/create"
                       class="text-[#444] font-medium">

                        Add Product

                    </a>

                </div>

            </div>

        </div>

    </nav>

    <!-- CONTENT -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- HERO -->
        <div class="bg-gradient-to-r
                    from-[#bfc9c0]
                    to-[#d8dfd8]
                    rounded-[40px]
                    p-10 md:p-14
                    shadow-[0_15px_40px_rgba(0,0,0,0.08)]
                    border border-[#d7ddd2]">

            <div class="flex flex-col lg:flex-row
                        items-center
                        justify-between
                        gap-10">

                <!-- TEXT -->
                <div>

                    <p class="uppercase
                              tracking-[5px]
                              text-sm
                              text-[#5e6858]
                              mb-4">

                        Admin Dashboard

                    </p>

                    <h1 class="text-4xl md:text-6xl
                               font-light
                               leading-tight
                               text-[#252825]">

                        Welcome Back
                        <span class="font-semibold">
                            Admin
                        </span>

                    </h1>

                    <p class="text-[#5d6559]
                              text-lg
                              mt-6
                              max-w-2xl">

                        Kelola produk, user, stock, dan seluruh aktivitas
                        Abaya Fishamo Store dengan tampilan premium modern.

                    </p>

                    <div class="mt-8 flex flex-wrap gap-4">

                        <a href="/admin/products"
                           class="bg-[#55624d]
                                  hover:bg-[#40483a]
                                  text-white
                                  px-8 py-4
                                  rounded-2xl
                                  font-semibold
                                  transition">

                            Manage Products

                        </a>

                        <a href="/admin/products/create"
                           class="bg-white
                                  hover:bg-[#f5f5f5]
                                  text-[#2f312e]
                                  px-8 py-4
                                  rounded-2xl
                                  font-semibold
                                  border border-[#d7ddd2]
                                  transition">

                            Add New Product

                        </a>

                    </div>

                </div>

                <!-- LOGO -->
                <div>

                    <img src="{{ asset('images/logo.png') }}"
                         class="w-48 md:w-60 drop-shadow-2xl">

                </div>

            </div>

        </div>

        <!-- STATS -->
        <div class="grid
                    grid-cols-1
                    sm:grid-cols-2
                    xl:grid-cols-3
                    gap-6
                    mt-12">

            <!-- CARD -->
            <div class="bg-white
                        rounded-[30px]
                        p-8
                        shadow-[0_10px_30px_rgba(0,0,0,0.06)]
                        border border-[#e1e5dd]">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[#7c8477] text-lg">
                            Total Products
                        </p>

                        <h2 class="text-5xl font-light mt-4">
                            {{ $totalProducts }}
                        </h2>

                    </div>

                    <div class="w-16 h-16
                                rounded-2xl
                                bg-[#edf1eb]
                                flex items-center justify-center">

                        <i class="bi bi-box-seam text-3xl text-[#55624d]"></i>

                    </div>

                </div>

            </div>

            <!-- USERS -->
            <div class="bg-white
                        rounded-[30px]
                        p-8
                        shadow-[0_10px_30px_rgba(0,0,0,0.06)]
                        border border-[#e1e5dd]">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[#7c8477] text-lg">
                            Total Users
                        </p>

                        <h2 class="text-5xl font-light mt-4">
                            {{ $totalUsers }}
                        </h2>

                    </div>

                    <div class="w-16 h-16
                                rounded-2xl
                                bg-[#edf1eb]
                                flex items-center justify-center">

                        <i class="bi bi-people text-3xl text-[#55624d]"></i>

                    </div>

                </div>

            </div>

            <!-- STOCK -->
            <div class="bg-white
                        rounded-[30px]
                        p-8
                        shadow-[0_10px_30px_rgba(0,0,0,0.06)]
                        border border-[#e1e5dd]">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[#7c8477] text-lg">
                            Total Stock
                        </p>

                        <h2 class="text-5xl font-light mt-4">
                            {{ $totalStock }}
                        </h2>

                    </div>

                    <div class="w-16 h-16
                                rounded-2xl
                                bg-[#edf1eb]
                                flex items-center justify-center">

                        <i class="bi bi-archive text-3xl text-[#55624d]"></i>

                    </div>

                </div>

            </div>

            <!-- CATEGORY -->
            <div class="bg-white
                        rounded-[30px]
                        p-8
                        shadow-[0_10px_30px_rgba(0,0,0,0.06)]
                        border border-[#e1e5dd]">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[#7c8477] text-lg">
                            Categories
                        </p>

                        <h2 class="text-5xl font-light mt-4">
                            {{ $totalCategory }}
                        </h2>

                    </div>

                    <div class="w-16 h-16
                                rounded-2xl
                                bg-[#edf1eb]
                                flex items-center justify-center">

                        <i class="bi bi-grid text-3xl text-[#55624d]"></i>

                    </div>

                </div>

            </div>

            <!-- SOLD -->
            <div class="bg-white
                        rounded-[30px]
                        p-8
                        shadow-[0_10px_30px_rgba(0,0,0,0.06)]
                        border border-[#e1e5dd]">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[#7c8477] text-lg">
                            Products Sold
                        </p>

                        <h2 class="text-5xl font-light mt-4">
                            {{ $totalSold }}
                        </h2>

                    </div>

                    <div class="w-16 h-16
                                rounded-2xl
                                bg-[#edf1eb]
                                flex items-center justify-center">

                        <i class="bi bi-bag-check text-3xl text-[#55624d]"></i>

                    </div>

                </div>

            </div>

            <!-- REVENUE -->
            <div class="bg-white
                        rounded-[30px]
                        p-8
                        shadow-[0_10px_30px_rgba(0,0,0,0.06)]
                        border border-[#e1e5dd]">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[#7c8477] text-lg">
                            Revenue
                        </p>

                        <h2 class="text-3xl md:text-4xl
                                   font-semibold
                                   text-[#55624d]
                                   mt-4">

                            Rp {{ number_format($totalRevenue) }}

                        </h2>

                    </div>

                    <div class="w-16 h-16
                                rounded-2xl
                                bg-[#edf1eb]
                                flex items-center justify-center">

                        <i class="bi bi-cash-stack text-3xl text-[#55624d]"></i>

                    </div>

                </div>

            </div>

        </div>

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