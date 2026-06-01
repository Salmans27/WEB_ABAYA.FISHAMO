@extends('layouts.store')

@section('title', 'Profile Settings — Abaya Fishamo')

@section('topbar_text', 'MANAGE YOUR PROFILE • ABAYA FISHAMO')

@section('content')

<div class="min-h-screen py-14 bg-[#edf1eb]">

    <div class="max-w-2xl mx-auto px-4 sm:px-6">

        {{-- TITLE --}}
        <div class="mb-10">
            <h1 class="text-4xl md:text-5xl font-light text-[#2f312e]">Profile Settings</h1>
            <p class="text-[#7c8477] mt-2 text-base">Update foto, nama, dan email akun kamu</p>
        </div>

        {{-- SUCCESS ALERT --}}
        @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200
                    text-green-700 px-5 py-4 rounded-2xl shadow-sm">
            <i class="bi bi-check-circle-fill text-xl"></i>
            <p>{{ session('success') }}</p>
        </div>
        @endif

        {{-- PROFILE CARD --}}
        <div class="bg-white rounded-[30px] shadow-xl p-8 md:p-10">

            <form method="POST"
                  action="{{ route('profile.update') }}"
                  enctype="multipart/form-data"
                  class="space-y-8">

                @csrf
                @method('patch')

                {{-- PHOTO SECTION --}}
                <div>

                    <label class="block text-lg font-semibold text-[#2f312e] mb-5">
                        Foto Profil
                    </label>

                    <div class="flex flex-col sm:flex-row items-center gap-6">

                        {{-- PHOTO PREVIEW --}}
                        <div class="flex-shrink-0">
                            @if(auth()->user()->photo)
                                <img id="photoPreview"
                                     src="{{ asset('storage/' . auth()->user()->photo) }}"
                                     alt="Foto Profil"
                                     class="w-32 h-32 rounded-full object-cover
                                            border-4 border-[#d7ddd2] shadow-lg"
                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=66725d&color=fff&size=128'">
                            @else
                                <img id="photoPreview"
                                     src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=66725d&color=fff&size=128"
                                     alt="Foto Profil"
                                     class="w-32 h-32 rounded-full object-cover
                                            border-4 border-[#d7ddd2] shadow-lg">
                            @endif
                        </div>

                        {{-- UPLOAD AREA --}}
                        <div class="flex-1 w-full">

                            <label for="photoInput"
                                   class="flex flex-col items-center justify-center
                                          w-full h-32 border-2 border-dashed border-[#b5bfae]
                                          rounded-2xl cursor-pointer bg-[#f8faf7]
                                          hover:border-[#55624d] hover:bg-[#eef2ea] transition">

                                <i class="bi bi-cloud-upload text-3xl text-[#7b8870]"></i>
                                <p class="mt-2 text-sm text-[#7b8870]">
                                    <span class="font-semibold text-[#55624d]">Klik untuk pilih foto</span>
                                    atau drag & drop
                                </p>
                                <p class="text-xs text-[#a0a89a] mt-1">JPG, JPEG, PNG — maks. 2MB</p>

                            </label>

                            <input id="photoInput"
                                   type="file"
                                   name="photo"
                                   accept="image/*"
                                   class="hidden">

                            {{-- File name indicator --}}
                            <p id="fileName" class="text-xs text-[#7b8870] mt-2 text-center hidden">
                                <i class="bi bi-check-circle text-green-500"></i>
                                <span id="fileNameText"></span>
                            </p>

                        </div>

                    </div>

                    @error('photo')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                </div>

                <hr class="border-[#e8ece4]">

                {{-- NAME --}}
                <div>
                    <label class="block text-base font-semibold text-[#2f312e] mb-2">
                        Nama Lengkap
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name', auth()->user()->name) }}"
                           required
                           class="w-full rounded-2xl border border-[#d7ddd2]
                                  bg-[#f8faf7] px-5 py-4 text-base
                                  focus:ring-2 focus:ring-[#55624d] focus:outline-none transition">
                    @error('name')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="block text-base font-semibold text-[#2f312e] mb-2">
                        Email
                    </label>
                    <input type="email"
                           name="email"
                           value="{{ old('email', auth()->user()->email) }}"
                           required
                           class="w-full rounded-2xl border border-[#d7ddd2]
                                  bg-[#f8faf7] px-5 py-4 text-base
                                  focus:ring-2 focus:ring-[#55624d] focus:outline-none transition">
                    @error('email')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- SAVE BUTTON --}}
                <div class="pt-2">
                    <button type="submit"
                            class="w-full sm:w-auto bg-[#55624d] hover:bg-[#40483a]
                                   text-white px-12 py-4 rounded-2xl text-base
                                   font-semibold shadow-lg transition hover:scale-105">
                        <i class="bi bi-check-lg mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>

        {{-- DELETE ACCOUNT --}}
        <div class="mt-6 bg-white rounded-[30px] shadow-xl p-8">

            <h2 class="text-lg font-semibold text-red-600 mb-2">Hapus Akun</h2>
            <p class="text-sm text-[#7c8477] mb-5">
                Setelah akun dihapus, semua data akan hilang permanen.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}"
                  onsubmit="return confirm('Yakin ingin menghapus akun? Tindakan ini tidak bisa dibatalkan.')">
                @csrf
                @method('delete')

                <input type="password"
                       name="password"
                       placeholder="Masukkan password untuk konfirmasi"
                       required
                       class="w-full rounded-2xl border border-red-200 bg-red-50
                              px-5 py-4 text-sm mb-4
                              focus:ring-2 focus:ring-red-400 focus:outline-none">

                @error('password', 'userDeletion')
                    <p class="mb-3 text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white
                               px-8 py-3 rounded-2xl text-sm font-semibold transition">
                    Hapus Akun Saya
                </button>
            </form>

        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
    const photoInput   = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photoPreview');
    const fileName     = document.getElementById('fileName');
    const fileNameText = document.getElementById('fileNameText');

    photoInput.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) return;

        // Show real-time preview
        const reader = new FileReader();

        reader.onload = function (e) {
            photoPreview.src = e.target.result;
        };

        reader.readAsDataURL(file);

        // Show filename
        fileNameText.textContent = file.name;
        fileName.classList.remove('hidden');

    });
</script>
@endsection