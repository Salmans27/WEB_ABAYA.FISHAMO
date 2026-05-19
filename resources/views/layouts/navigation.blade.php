<nav x-data="{ open: false }"
class="bg-gradient-to-r from-[#c8d1c8] to-[#e5ebe5]
border-b border-white/40 shadow-lg sticky top-0 z-50 backdrop-blur-md">

    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="flex justify-between h-20">

            <!-- LEFT -->
            <div class="flex items-center gap-10">

                <!-- LOGO -->
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3">

                    <img src="{{ asset('images/logo.png') }}"
                         class="h-14 w-auto drop-shadow-md">

                    <div class="hidden sm:flex sm:flex-col">

                        <span class="text-2xl font-bold text-gray-700">
                            Abaya Fishamo
                        </span>

                        <span class="text-gray-500 text-sm">

                            @if(auth()->user()->role == 'admin')

                                Admin Panel

                            @else

                                User Panel

                            @endif

                        </span>

                    </div>

                </a>

                <!-- MENU -->
                <div class="hidden sm:flex items-center gap-4">

                    <a href="{{ route('dashboard') }}"
                       class="px-5 py-2 rounded-xl text-gray-700
                              font-semibold hover:bg-white/60
                              transition duration-300">

                        Dashboard

                    </a>

                    @if(auth()->user()->role == 'admin')

                        <a href="/admin/products"
                           class="px-5 py-2 rounded-xl
                                  bg-white/60 backdrop-blur-md
                                  shadow-md text-gray-700
                                  font-semibold hover:bg-white
                                  transition duration-300">

                            Products

                        </a>

                    @endif

                </div>

            </div>

            <!-- RIGHT -->
            <div class="hidden sm:flex sm:items-center gap-4">

                <!-- CART -->
                <a href="/cart"
                   class="px-5 py-3 rounded-2xl bg-white/70
                          backdrop-blur-md shadow-md text-gray-700
                          font-semibold hover:bg-white
                          transition duration-300">

                    🛒 Cart

                </a>

                <!-- PROFILE DROPDOWN -->
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="inline-flex items-center gap-2
                                       px-4 py-2 rounded-2xl
                                       bg-white/70 backdrop-blur-md
                                       shadow-md text-gray-700
                                       font-semibold hover:bg-white
                                       transition duration-300">

                            <div class="flex items-center gap-3">

                                @if(Auth::user()->photo)

                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                         class="w-10 h-10 rounded-full object-cover">

                                @else

                                    <div class="w-10 h-10 rounded-full bg-gray-300"></div>

                                @endif

                                <span>
                                    {{ Auth::user()->name }}
                                </span>

                            </div>

                            <svg class="fill-current h-4 w-4"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">

                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd" />

                            </svg>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link href="/favorite">
    Favorite
</x-dropdown-link>

<x-dropdown-link :href="route('profile.edit')">
    Profile
</x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">

                                Log Out

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- MOBILE BUTTON -->
            <div class="flex items-center sm:hidden">

                <button @click="open = ! open"
                    class="p-2 rounded-md text-gray-700">

                    <svg class="h-6 w-6"
                         stroke="currentColor"
                         fill="none"
                         viewBox="0 0 24 24">

                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

</nav>