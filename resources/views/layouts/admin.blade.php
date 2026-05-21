<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>Abaya Fishamo Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-[#edf1eb] text-[#2f312e]">

    <div class="min-h-screen">

        <!-- TOPBAR -->
        <div class="bg-[#55624d]
                    text-white
                    text-center
                    py-3
                    tracking-[4px]
                    text-sm">

            ABAYA FISHAMO ADMIN PANEL

        </div>

        <!-- NAVBAR -->
        <nav class="bg-white border-b shadow-sm">

            <div class="max-w-7xl mx-auto px-6">

                <div class="flex items-center justify-between h-20">

                    <!-- LEFT -->
                    <div class="flex items-center gap-8">

                        <a href="{{ route('admin.dashboard') }}"
                           class="font-semibold text-[#55624d]">

                            Dashboard

                        </a>

                        <a href="{{ route('admin.products.index') }}"
                           class="font-semibold text-[#55624d]">

                            Products

                        </a>

                        <a href="{{ route('admin.orders.index') }}"
                           class="font-semibold text-[#55624d]">

                            Orders

                        </a>

                    </div>

                    <!-- RIGHT -->
                    <div class="flex items-center gap-4">

                        <a href="{{ route('admin.products.create') }}"
                           class="bg-[#55624d]
                                  text-white
                                  px-5 py-3
                                  rounded-2xl">

                            Add Product

                        </a>

                        <form method="POST"
                              action="{{ route('logout') }}">

                            @csrf

                            <button type="submit"
                                    class="text-red-500 font-semibold">

                                Logout

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </nav>

        <!-- CONTENT -->
        <main class="max-w-7xl mx-auto px-6 py-10">

            @yield('content')

        </main>

    </div>

</body>
</html>