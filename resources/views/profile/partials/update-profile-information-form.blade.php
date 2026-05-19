<section>
    <header>
        <h2 class="text-2xl font-bold text-gray-800">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm text-gray-500">
            {{ __("Update your account profile and photo.") }}
        </p>
    </header>

    <!-- Verification -->
    <form id="send-verification"
          method="post"
          action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Update Profile -->
    <form method="post"
          action="{{ route('profile.update') }}"
          enctype="multipart/form-data"
          class="mt-8 space-y-6">

        @csrf
        @method('patch')

        <!-- FOTO PROFILE -->
        <div>

            <x-input-label for="photo" :value="__('Profile Photo')" />

            <div class="mt-4 mb-4">

                @if(auth()->user()->photo)

                    <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                         class="w-28 h-28 rounded-full object-cover border-4 border-[#cfd6cf] shadow-xl">

                @else

                    <div class="w-28 h-28 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                        No Photo
                    </div>

                @endif

            </div>

            <input type="file"
                   name="photo"
                   class="w-full rounded-2xl border-gray-300 shadow-sm">

            <x-input-error class="mt-2"
                           :messages="$errors->get('photo')" />

        </div>

        <!-- NAME -->
        <div>

            <x-input-label for="name" :value="__('Name')" />

            <x-text-input id="name"
                          name="name"
                          type="text"
                          class="mt-1 block w-full rounded-2xl"
                          :value="old('name', auth()->user()->name)"
                          required
                          autofocus
                          autocomplete="name" />

            <x-input-error class="mt-2"
                           :messages="$errors->get('name')" />

        </div>

        <!-- EMAIL -->
        <div>

            <x-input-label for="email" :value="__('Email')" />

            <x-text-input id="email"
                          name="email"
                          type="email"
                          class="mt-1 block w-full rounded-2xl"
                          :value="old('email', auth()->user()->email)"
                          required
                          autocomplete="username" />

            <x-input-error class="mt-2"
                           :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail
                && ! auth()->user()->hasVerifiedEmail())

                <div>

                    <p class="text-sm mt-2 text-gray-600">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                                class="underline text-sm text-[#6b7b6b] hover:text-black">

                            {{ __('Click here to re-send the verification email.') }}

                        </button>

                    </p>

                    @if (session('status') === 'verification-link-sent')

                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Verification link sent.') }}
                        </p>

                    @endif

                </div>

            @endif

        </div>

        <!-- BUTTON -->
        <div class="flex items-center gap-4">

            <button type="submit"
                    class="bg-[#7d8b7d] hover:bg-[#5f6d5f]
                           text-white px-6 py-3 rounded-2xl
                           font-semibold shadow-lg transition">

                Save Profile

            </button>

            @if (session('status') === 'profile-updated')

                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-green-600">

                    Saved Successfully ✅

                </p>

            @endif

        </div>

    </form>
</section>