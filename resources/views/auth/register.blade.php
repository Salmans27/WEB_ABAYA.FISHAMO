<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Abaya Fishamo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-[#eef1ea] min-h-screen flex items-center justify-center px-6">

    <div class="w-full max-w-md">

        <!-- CARD -->
        <div class="bg-white rounded-[35px] px-10 py-8 shadow-2xl">

            <!-- LOGO -->
            <div class="flex justify-center mb-4">

                <img
                    src="{{ asset('images/logo.png') }}"
                    class="w-16 h-16 object-contain">

            </div>

            <!-- TITLE -->
            <div class="text-center mb-7">

                <h1 class="text-5xl font-serif text-[#5F6F52]">
                    Create Account
                </h1>

                <p class="text-gray-500 mt-2">
                    Register to Abaya Fishamo
                </p>

            </div>

            <!-- ERROR -->
            @if ($errors->any())

                <div class="mb-4 bg-red-100 text-red-600 p-3 rounded-2xl">

                    {{ $errors->first() }}

                </div>

            @endif

            <!-- FORM -->
            <form method="POST"
                  action="{{ route('register') }}">

                @csrf

                <!-- NAME -->
                <div class="mb-4">

                    <label class="block mb-2 text-gray-600">
                        Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        required
                        class="w-full
                               border border-gray-200
                               rounded-2xl
                               px-5 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#AEB7A2]"
                        placeholder="Enter your name">

                </div>

                <!-- EMAIL -->
                <div class="mb-4">

                    <label class="block mb-2 text-gray-600">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        required
                        class="w-full
                               border border-gray-200
                               rounded-2xl
                               px-5 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#AEB7A2]"
                        placeholder="Enter your email">

                </div>

                <!-- PASSWORD -->
                <div class="mb-4">

                    <label class="block mb-2 text-gray-600">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full
                               border border-gray-200
                               rounded-2xl
                               px-5 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#AEB7A2]"
                        placeholder="Enter your password">

                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="mb-6">

                    <label class="block mb-2 text-gray-600">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        class="w-full
                               border border-gray-200
                               rounded-2xl
                               px-5 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#AEB7A2]"
                        placeholder="Confirm your password">

                </div>

                <!-- FOOTER -->
                <div class="flex items-center justify-between gap-4">

                    <a href="{{ route('login') }}"
                       class="text-sm text-[#5F6F52] hover:underline">

                        Already registered?

                    </a>

                    <button
                        type="submit"
                        class="bg-[#5F6F52]
                               hover:bg-[#4f5f44]
                               text-white
                               px-7 py-3
                               rounded-2xl
                               font-semibold
                               transition">

                        REGISTER

                    </button>

                </div>

            </form>

        </div>

    </div>

</body>
</html>