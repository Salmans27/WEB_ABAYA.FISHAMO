<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Abaya Fishamo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-[#eef1ea] min-h-screen overflow-hidden">

<div class="min-h-screen flex items-center justify-center px-6">

    <div class="grid lg:grid-cols-2 gap-10 items-center max-w-6xl w-full">

        <!-- LEFT IMAGE -->
        <div class="hidden lg:flex justify-center">
            <img src="{{ asset('images/abaya-login.png') }}"
                 class="w-[450px] rounded-[40px] shadow-2xl object-cover">
        </div>

        <!-- LOGIN CARD -->
        <div class="flex justify-center">

            <div class="w-full max-w-md bg-white rounded-[35px] p-10 shadow-2xl">

                <!-- LOGO -->
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/logo.png') }}"
                         class="w-20 h-20 object-contain">
                </div>

                <!-- TITLE -->
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-serif text-[#5F6F52]">
                        Welcome Back
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Login to Abaya Fishamo
                    </p>
                </div>

                <!-- ERROR -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-600 p-3 rounded-xl">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- FORM -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- EMAIL -->
                    <div class="mb-5">
                        <label class="block mb-2 text-gray-600">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               required
                               class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-[#AEB7A2]"
                               placeholder="Enter your email">
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-5">
                        <label class="block mb-2 text-gray-600">
                            Password
                        </label>

                        <input type="password"
                               name="password"
                               required
                               class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-[#AEB7A2]"
                               placeholder="Enter your password">
                    </div>

                    <!-- REMEMBER -->
                    <div class="flex justify-between items-center mb-8">

                        <label class="flex items-center gap-2 text-sm text-gray-600">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>

                        <a href="#"
                           class="text-sm text-[#5F6F52] hover:underline">
                            Forgot Password?
                        </a>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                            class="w-full bg-[#5F6F52] hover:bg-[#4f5f44] text-white py-4 rounded-2xl font-semibold transition">
                        LOG IN
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>