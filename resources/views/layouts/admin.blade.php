<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Abaya Fishamo — Admin Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        [x-cloak] { display: none !important; }
        
        /* Smooth transition for sidebar */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out, width 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-[#edf1eb] text-[#2f312e] font-sans antialiased overflow-x-hidden">

    <div class="flex min-h-screen">

        {{-- LEFT SIDEBAR --}}
        <aside id="sidebar" 
               class="fixed inset-y-0 left-0 z-40 w-64 bg-[#394434] text-white flex flex-col justify-between 
                      transform -translate-x-full lg:translate-x-0 sidebar-transition shadow-2xl border-r border-[#4c5847]/30">
            
            <div>
                {{-- SIDEBAR BRANDING --}}
                <div class="h-24 flex items-center justify-center px-6 border-b border-[#4c5847]/30">
                    <a href="{{ route('admin.dashboard') }}" class="text-center group">
                        <h2 class="text-2xl tracking-[6px] font-extralight text-white leading-none">
                            ABAYA
                        </h2>
                        <p class="text-[9px] tracking-[4px] text-[#bfc9bc] mt-1 font-semibold uppercase">
                            ADMIN PANEL
                        </p>
                    </a>
                </div>

                {{-- NAVIGATION LINKS --}}
                <nav class="mt-8 px-4 space-y-1.5">
                    
                    {{-- DASHBOARD --}}
                    <a href="/admin/dashboard"
                       class="flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm transition group
                              {{ request()->is('admin/dashboard*') 
                                 ? 'bg-[#55624d] text-white font-medium shadow-md shadow-[#2d3629]/20' 
                                 : 'text-[#bfc9bc] hover:bg-white/5 hover:text-white' }}">
                        <i class="bi bi-grid-1x2-fill text-lg"></i>
                        <span>Dashboard</span>
                    </a>

                    {{-- PRODUCTS --}}
                    <a href="/admin/products"
                       class="flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm transition group
                              {{ request()->is('admin/products*') 
                                 ? 'bg-[#55624d] text-white font-medium shadow-md shadow-[#2d3629]/20' 
                                 : 'text-[#bfc9bc] hover:bg-white/5 hover:text-white' }}">
                        <i class="bi bi-box-seam text-lg"></i>
                        <span>Manage Products</span>
                    </a>

                    {{-- ORDERS --}}
                    <a href="{{ route('admin.orders.index') }}"
                       class="flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm transition group
                              {{ request()->is('admin/orders*') 
                                 ? 'bg-[#55624d] text-white font-medium shadow-md shadow-[#2d3629]/20' 
                                 : 'text-[#bfc9bc] hover:bg-white/5 hover:text-white' }}">
                        <i class="bi bi-bag-check-fill text-lg"></i>
                        <span>Orders Activity</span>
                    </a>

                    <div class="h-[1px] bg-[#4c5847]/30 my-6"></div>

                    {{-- BACK TO SHOP --}}
                    <a href="/"
                       class="flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm transition text-[#bfc9bc] hover:bg-white/5 hover:text-white">
                        <i class="bi bi-arrow-left-circle-fill text-lg"></i>
                        <span>Back To Storefront</span>
                    </a>

                </nav>
            </div>

            {{-- ADMIN INFO / SIGNOUT --}}
            <div class="p-4 border-t border-[#4c5847]/30 bg-[#2f382a]/50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                             alt="Profile"
                             class="w-9 h-9 rounded-full object-cover border border-[#bfc9bc]/30"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=66725d&color=fff'">
                        <div class="text-left">
                            <p class="text-xs font-semibold text-white truncate max-w-[120px]">{{ auth()->user()->name }}</p>
                            <p class="text-[9px] text-[#bfc9bc]">Administrator</p>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-8 h-8 rounded-full bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white transition flex items-center justify-center"
                                title="Sign Out">
                            <i class="bi bi-power"></i>
                        </button>
                    </form>
                </div>
            </div>

        </aside>

        {{-- MAIN CONTENT WRAPPER --}}
        <div class="flex-1 flex flex-col min-w-0 lg:pl-64">
            
            {{-- TOPBAR PANEL --}}
            <header class="h-20 bg-white border-b border-[#d8ddd3] flex items-center justify-between px-6 md:px-8 sticky top-0 z-30 shadow-sm">
                
                {{-- MOBILE MENU BUTTON --}}
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()"
                            class="lg:hidden p-2 rounded-xl bg-[#edf1eb] text-[#394434] hover:bg-[#dfe6da] transition text-xl">
                        <i class="bi bi-list"></i>
                    </button>
                    
                    <div class="hidden sm:block">
                        <h1 class="text-sm font-semibold text-[#384232]">Abaya Fishamo Admin</h1>
                        <p class="text-[10px] text-[#7c8477]">Kelola toko dan pesanan secara efisien</p>
                    </div>
                </div>

                {{-- RIGHT HEADER ACTIONS --}}
                <div class="flex items-center gap-4">
                    
                    {{-- QUICK ADD PRODUCT BUTTON --}}
                    <a href="/admin/products/create"
                       class="flex items-center gap-2 bg-[#55624d] hover:bg-[#40483a] text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-md transition hover:scale-105">
                        <i class="bi bi-plus-lg"></i>
                        <span>Add Product</span>
                    </a>

                    {{-- QUICK NOTIFICATION --}}
                    <a href="{{ route('admin.orders.index') }}" 
                       class="w-10 h-10 rounded-xl bg-[#edf1eb] text-[#55624d] flex items-center justify-center hover:bg-[#dfe6da] transition relative"
                       title="Cek Pesanan Baru">
                        <i class="bi bi-bell-fill"></i>
                        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-orange-500 rounded-full border border-white"></span>
                    </a>

                </div>

            </header>

            {{-- CONTENT SECTION --}}
            <main class="flex-grow p-6 md:p-8">
                @yield('content')
            </main>

            {{-- SOFT FOOTER --}}
            <footer class="py-6 text-center text-xs text-[#7c8477] border-t border-[#d8ddd3]/40 bg-white/40">
                <p>© {{ date('Y') }} Abaya Fishamo Admin. Created with Premium UX/UI.</p>
            </footer>

        </div>

    </div>

    {{-- SIDEBAR OVERLAY FOR MOBILE --}}
    <div id="sidebar-overlay"
         onclick="toggleSidebar()"
         class="fixed inset-0 z-30 bg-black/40 hidden lg:hidden transition-opacity">
    </div>

    {{-- SCRIPT FOR SIDEBAR TOGGLE --}}
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>

</body>
</html>