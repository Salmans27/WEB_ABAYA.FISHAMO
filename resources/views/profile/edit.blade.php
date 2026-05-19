<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

                    <!-- CART -->
                    <a href="/cart"
                       class="px-5 py-3
                              rounded-2xl
                              bg-white
                              shadow-md
                              flex items-center gap-3
                              text-[#2f312e]
                              font-semibold">

                    <i class="bi bi-cart-plus-fill"></i>

                        Cart

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

        <div class="max-w-4xl mx-auto px-6">

            <!-- TITLE -->
            <div class="mb-10">

                <h1 class="text-5xl font-light text-[#2f312e]">
                    Profile Settings
                </h1>

                <p class="text-[#7c8477] mt-3 text-lg">
                    Update your account profile and photo
                </p>

            </div>

            <!-- CARD -->
            <div class="bg-white rounded-[35px] shadow-2xl p-10">

                <form id="send-verification"
                      method="post"
                      action="{{ route('verification.send') }}">

                    @csrf

                </form>

                <form method="post"
                      action="{{ route('profile.update') }}"
                      enctype="multipart/form-data"
                      class="space-y-10">

                    @csrf
                    @method('patch')

                    <!-- PHOTO -->
                    <div>

                        <label class="block
                                     text-xl
                                     font-semibold
                                     text-[#2f312e]
                                     mb-5">

                            Profile Photo

                        </label>

                        <div class="flex items-center gap-6 mb-6">

                            @if(auth()->user()->photo)

                                <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                                     class="w-36 h-36
                                            rounded-full
                                            object-cover
                                            border-4 border-[#d7ddd2]
                                            shadow-xl">

                            @else

                                <div class="w-36 h-36
                                            rounded-full
                                            bg-[#dfe4d8]
                                            flex items-center
                                            justify-center
                                            text-[#7c8477]
                                            shadow-xl">

                                    <i class="bi bi-person text-5xl"></i>

                                </div>

                            @endif

                            <div class="flex-1">

                                <input type="file"
                                       name="photo"
                                       class="w-full
                                              border border-[#d7ddd2]
                                              rounded-2xl
                                              p-4
                                              bg-[#f8faf7]
                                              focus:ring-2
                                              focus:ring-[#55624d]
                                              focus:outline-none">

                                <p class="text-[#8b9385] text-sm mt-3">
                                    Upload foto profile baru
                                </p>

                            </div>

                        </div>

                        <x-input-error class="mt-2"
                                       :messages="$errors->get('photo')" />

                    </div>

                    <!-- NAME -->
                    <div>

                        <label class="block
                                     text-xl
                                     font-semibold
                                     text-[#2f312e]
                                     mb-3">

                            Name

                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               required
                               class="w-full
                                      rounded-2xl
                                      border border-[#d7ddd2]
                                      bg-[#f8faf7]
                                      px-6 py-5
                                      text-lg
                                      focus:ring-2
                                      focus:ring-[#55624d]
                                      focus:outline-none">

                        <x-input-error class="mt-2"
                                       :messages="$errors->get('name')" />

                    </div>

                    <!-- EMAIL -->
                    <div>

                        <label class="block
                                     text-xl
                                     font-semibold
                                     text-[#2f312e]
                                     mb-3">

                            Email

                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email', auth()->user()->email) }}"
                               required
                               class="w-full
                                      rounded-2xl
                                      border border-[#d7ddd2]
                                      bg-[#f8faf7]
                                      px-6 py-5
                                      text-lg
                                      focus:ring-2
                                      focus:ring-[#55624d]
                                      focus:outline-none">

                        <x-input-error class="mt-2"
                                       :messages="$errors->get('email')" />

                    </div>

                    <!-- BUTTON -->
                    <div class="pt-4">

                        <button type="submit"
                                class="bg-[#55624d]
                                       hover:bg-[#40483a]
                                       text-white
                                       px-10 py-5
                                       rounded-2xl
                                       text-lg
                                       font-semibold
                                       shadow-xl
                                       transition">

                            Save Profile

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>