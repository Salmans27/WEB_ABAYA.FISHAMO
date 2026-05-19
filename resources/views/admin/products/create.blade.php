<x-app-layout>

    <!-- TOP BAR -->
    <div class="bg-gradient-to-r
                from-[#55624d]
                via-[#7b8870]
                to-[#55624d]
                text-white text-center
                py-3
                text-[10px] md:text-sm
                tracking-[4px]">

        ADMIN PANEL • ABAYA FISHAMO STORE

    </div>

    <!-- PAGE -->
    <div class="min-h-screen bg-[#edf1eb] py-12">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- HEADER -->
            <div class="mb-10">

                <p class="uppercase tracking-[4px]
                          text-[#7b8870]
                          text-sm">

                    Admin Dashboard

                </p>

                <h1 class="text-5xl md:text-6xl
                           font-light
                           text-[#2d312b]
                           mt-3">

                    Add New Product

                </h1>

                <p class="text-[#6e7569]
                          mt-4
                          text-lg">

                    Tambahkan produk baru ke Abaya Fishamo Store

                </p>

            </div>

            <!-- CARD -->
            <div class="bg-white
                        rounded-[40px]
                        shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                        border border-[#dbe2d6]
                        overflow-hidden">

                <div class="grid lg:grid-cols-2">

                    <!-- LEFT -->
                    <div class="bg-gradient-to-br
                                from-[#66725d]
                                via-[#7d8874]
                                to-[#55624d]
                                p-10
                                text-white
                                flex flex-col justify-between">

                        <div>

                            <p class="tracking-[5px]
                                      uppercase
                                      text-sm
                                      opacity-80">

                                Abaya Fishamo

                            </p>

                            <h2 class="text-4xl
                                       font-light
                                       leading-tight
                                       mt-6">

                                Upload
                                Product
                                Collection

                            </h2>

                            <p class="mt-6
                                      text-white/80
                                      leading-relaxed">

                                Tambahkan produk dengan detail lengkap
                                agar tampil premium di dashboard user.

                            </p>

                        </div>

                        <!-- LOGO -->
                        <div class="mt-12">

                            <img src="{{ asset('images/logo.png') }}"
                                 class="w-32 opacity-90">

                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="p-8 md:p-10">

                        <form action="/admin/products/store"
                              method="POST"
                              enctype="multipart/form-data"
                              class="space-y-7">

                            @csrf

                            <!-- NAME -->
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
                                              border border-[#d7ddd2]
                                              bg-[#f8faf7]
                                              rounded-2xl
                                              px-5 py-4
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
                                           border border-[#d7ddd2]
                                           bg-[#f8faf7]
                                           rounded-2xl
                                           px-5 py-4
                                           focus:outline-none
                                           focus:ring-2
                                           focus:ring-[#66725d]">{{ old('description') }}</textarea>

                            </div>

                            <!-- PRICE + STOCK -->
                            <div class="grid md:grid-cols-2 gap-5">

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
                                                  border border-[#d7ddd2]
                                                  bg-[#f8faf7]
                                                  rounded-2xl
                                                  px-5 py-4
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
                                           placeholder="50"
                                           class="w-full
                                                  border border-[#d7ddd2]
                                                  bg-[#f8faf7]
                                                  rounded-2xl
                                                  px-5 py-4
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
                                              border border-[#d7ddd2]
                                              bg-[#f8faf7]
                                              rounded-2xl
                                              px-5 py-4
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
                                              border border-[#d7ddd2]
                                              bg-[#f8faf7]
                                              rounded-2xl
                                              px-5 py-4
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
                                              border border-[#d7ddd2]
                                              bg-[#f8faf7]
                                              rounded-2xl
                                              px-5 py-4
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
                                              border border-dashed
                                              border-[#cfd7c8]
                                              bg-[#f8faf7]
                                              rounded-2xl
                                              px-5 py-4">

                            </div>

                            <!-- BUTTON -->
                            <div class="pt-4">

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

        </div>

    </div>

</x-app-layout>