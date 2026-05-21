@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<div class="mb-10">

    <div class="flex items-center justify-between flex-wrap gap-5">

        <div>

            <p class="uppercase tracking-[4px]
                      text-sm text-[#6c7567] mb-3">

                Admin Products

            </p>

            <h1 class="text-5xl font-light text-[#2d312b]">

                Products
                <span class="font-semibold">
                    Management
                </span>

            </h1>

            <p class="text-[#6b7368] text-lg mt-4">

                Kelola seluruh produk Abaya Fishamo Store.

            </p>

        </div>

        <a href="{{ route('admin.products.create') }}"
           class="bg-[#55624d]
                  hover:bg-[#40483a]
                  text-white
                  px-8 py-4
                  rounded-2xl
                  font-semibold
                  shadow-lg
                  transition">

            + Tambah Produk

        </a>

    </div>

</div>

<!-- PRODUCTS TABLE -->
<div class="bg-white
            rounded-[35px]
            overflow-hidden
            border border-[#dfe4db]
            shadow-[0_10px_35px_rgba(0,0,0,0.05)]">

    <!-- TABLE HEADER -->
    <div class="grid
                grid-cols-12
                bg-[#cfd5cd]
                text-[#2d312b]
                font-semibold
                px-8 py-6">

        <div class="col-span-5">
            Produk
        </div>

        <div class="col-span-2">
            Harga
        </div>

        <div class="col-span-2">
            Kategori
        </div>

        <div class="col-span-1">
            Stock
        </div>

        <div class="col-span-2 text-center">
            Action
        </div>

    </div>

    <!-- PRODUCTS -->
    @forelse($products as $product)

        <div class="grid
                    grid-cols-12
                    items-center
                    px-8 py-8
                    border-t border-[#ecefea]">

            <!-- PRODUCT -->
            <div class="col-span-5 flex gap-6">

                <img src="{{ asset('storage/' . $product->image) }}"
                     class="w-32 h-40
                            object-cover
                            rounded-2xl
                            shadow-md">

                <div>

                    <h2 class="text-3xl
                               font-semibold
                               text-[#2d312b]">

                        {{ $product->name }}

                    </h2>

                    <p class="text-[#7a8276] mt-2">
                        #{{ $product->id }}
                    </p>

                    <p class="text-[#6f776b]
                              mt-5
                              leading-9
                              max-w-xl">

                        {{ Str::limit($product->description, 150) }}

                    </p>

                </div>

            </div>

            <!-- PRICE -->
            <div class="col-span-2">

                <h3 class="text-4xl
                           font-semibold
                           text-[#1fa34a]">

                    Rp {{ number_format($product->price) }}

                </h3>

            </div>

            <!-- CATEGORY -->
            <div class="col-span-2">

                <span class="bg-[#e7ebe4]
                             text-[#2f312e]
                             px-5 py-3
                             rounded-2xl
                             font-semibold">

                    {{ $product->category }}

                </span>

            </div>

            <!-- STOCK -->
            <div class="col-span-1">

                <span class="bg-[#cdeccf]
                             text-[#26733b]
                             px-5 py-3
                             rounded-2xl
                             font-semibold">

                    {{ $product->stock }} pcs

                </span>

            </div>

            <!-- ACTION -->
            <div class="col-span-2">

                <div class="flex justify-center gap-4">

                    <!-- EDIT -->
                    <a href="{{ route('admin.products.edit', $product->id) }}"
                       class="bg-[#facc15]
                              hover:bg-yellow-400
                              text-white
                              px-6 py-3
                              rounded-2xl
                              font-semibold
                              shadow">

                        Edit

                    </a>

                    <!-- DELETE -->
                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                onclick="return confirm('Yakin hapus produk?')"
                                class="bg-[#ef4444]
                                       hover:bg-red-500
                                       text-white
                                       px-6 py-3
                                       rounded-2xl
                                       font-semibold
                                       shadow">

                            Delete

                        </button>

                    </form>

                </div>

            </div>

        </div>

    @empty

        <div class="p-16 text-center">

            <h2 class="text-3xl text-[#5f685b]">

                Belum ada produk

            </h2>

        </div>

    @endforelse

</div>

@endsection