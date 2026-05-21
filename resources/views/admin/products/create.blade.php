@extends('layouts.admin')

@section('content')

<!-- PAGE HEADER -->
<div class="mb-12">

    <p class="uppercase tracking-[5px]
              text-sm text-[#687264] mb-4">

        Admin Dashboard

    </p>

    <h1 class="text-5xl md:text-6xl
               font-light
               text-[#2d312b]">

        Add New
        <span class="font-semibold">
            Product
        </span>

    </h1>

    <p class="text-[#687264]
              text-lg
              mt-5">

        Tambahkan produk baru ke Abaya Fishamo Store

    </p>

</div>

<!-- CARD -->
<div class="bg-white
            rounded-[40px]
            border border-[#dde2d9]
            overflow-hidden
            shadow-[0_20px_60px_rgba(0,0,0,0.06)]">

    <div class="grid lg:grid-cols-2">

        <!-- LEFT SIDE -->
        <div class="bg-gradient-to-br
                    from-[#66725d]
                    via-[#7a8670]
                    to-[#55624d]
                    p-12
                    text-white
                    flex flex-col justify-between">

            <div>

                <p class="uppercase
                          tracking-[5px]
                          text-sm
                          opacity-80">

                    Abaya Fishamo

                </p>

                <h2 class="text-5xl
                           font-light
                           leading-tight
                           mt-8">

                    Upload
                    Premium
                    Product

                </h2>

                <p class="mt-8
                          text-white/80
                          leading-8
                          text-lg">

                    Tambahkan produk baru dengan detail lengkap
                    agar tampil premium di halaman user dan admin.

                </p>

            </div>

            <!-- LOGO -->
            <div class="mt-14">

                <img src="{{ asset('images/logo.png') }}"
                     class="w-40 opacity-90">

            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="p-10 md:p-14">

            <form action="{{ route('admin.products.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-8">

                @csrf

                <!-- PRODUCT NAME -->
                <div>

                    <label class="block
                                 text-sm
                                 font-semibold
                                 text-[#55624d]
                                 mb-3">

                        Nama Produk

                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Luxury Abaya"
                           class="w-full
                                  bg-[#f7f9f6]
                                  border border-[#d9dfd5]
                                  rounded-2xl
                                  px-6 py-5
                                  focus:outline-none
                                  focus:ring-2
                                  focus:ring-[#66725d]">

                </div>

                <!-- DESCRIPTION -->
                <div>

                    <label class="block
                                 text-sm
                                 font-semibold
                                 text-[#55624d]
                                 mb-3">

                        Deskripsi

                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        placeholder="Deskripsi produk..."
                        class="w-full
                               bg-[#f7f9f6]
                               border border-[#d9dfd5]
                               rounded-2xl
                               px-6 py-5
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#66725d]">{{ old('description') }}</textarea>

                </div>

                <!-- PRICE + STOCK -->
                <div class="grid md:grid-cols-2 gap-6">

                    <!-- PRICE -->
                    <div>

                        <label class="block
                                     text-sm
                                     font-semibold
                                     text-[#55624d]
                                     mb-3">

                            Harga

                        </label>

                        <input type="number"
                               name="price"
                               value="{{ old('price') }}"
                               placeholder="250000"
                               class="w-full
                                      bg-[#f7f9f6]
                                      border border-[#d9dfd5]
                                      rounded-2xl
                                      px-6 py-5
                                      focus:outline-none
                                      focus:ring-2
                                      focus:ring-[#66725d]">

                    </div>

                    <!-- STOCK -->
                    <div>

                        <label class="block
                                     text-sm
                                     font-semibold
                                     text-[#55624d]
                                     mb-3">

                            Stock

                        </label>

                        <input type="number"
                               name="stock"
                               value="{{ old('stock') }}"
                               placeholder="10"
                               class="w-full
                                      bg-[#f7f9f6]
                                      border border-[#d9dfd5]
                                      rounded-2xl
                                      px-6 py-5
                                      focus:outline-none
                                      focus:ring-2
                                      focus:ring-[#66725d]">

                    </div>

                </div>

                <!-- CATEGORY -->
                <div>

                    <label class="block
                                 text-sm
                                 font-semibold
                                 text-[#55624d]
                                 mb-3">

                        Kategori

                    </label>

                    <input type="text"
                           name="category"
                           value="{{ old('category') }}"
                           placeholder="Luxury / Casual / Premium"
                           class="w-full
                                  bg-[#f7f9f6]
                                  border border-[#d9dfd5]
                                  rounded-2xl
                                  px-6 py-5
                                  focus:outline-none
                                  focus:ring-2
                                  focus:ring-[#66725d]">

                </div>

                <!-- SIZE -->
                <div>

                    <label class="block
                                 text-sm
                                 font-semibold
                                 text-[#55624d]
                                 mb-3">

                        Size

                    </label>

                    <input type="text"
                           name="size"
                           value="{{ old('size') }}"
                           placeholder="S,M,L,XL"
                           class="w-full
                                  bg-[#f7f9f6]
                                  border border-[#d9dfd5]
                                  rounded-2xl
                                  px-6 py-5
                                  focus:outline-none
                                  focus:ring-2
                                  focus:ring-[#66725d]">

                </div>

                <!-- COLOR -->
                <div>

                    <label class="block
                                 text-sm
                                 font-semibold
                                 text-[#55624d]
                                 mb-3">

                        Color

                    </label>

                    <input type="text"
                           name="color"
                           value="{{ old('color') }}"
                           placeholder="Black, White, Nude"
                           class="w-full
                                  bg-[#f7f9f6]
                                  border border-[#d9dfd5]
                                  rounded-2xl
                                  px-6 py-5
                                  focus:outline-none
                                  focus:ring-2
                                  focus:ring-[#66725d]">

                </div>

                <!-- IMAGE -->
                <div>

                    <label class="block
                                 text-sm
                                 font-semibold
                                 text-[#55624d]
                                 mb-3">

                        Upload Gambar

                    </label>

                    <input type="file"
                           name="image"
                           class="w-full
                                  bg-[#f7f9f6]
                                  border border-dashed
                                  border-[#cfd6ca]
                                  rounded-2xl
                                  px-6 py-5">

                </div>

                <!-- BUTTON -->
                <div class="pt-5">

                    <button type="submit"
                            class="w-full
                                   bg-gradient-to-r
                                   from-[#66725d]
                                   to-[#55624d]
                                   hover:opacity-90
                                   text-white
                                   py-5
                                   rounded-2xl
                                   text-lg
                                   font-semibold
                                   shadow-xl
                                   transition">

                        Simpan Produk

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection