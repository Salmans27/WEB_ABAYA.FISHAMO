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

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-light text-[#2d312b]">

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
                  px-6 py-3 sm:px-8 sm:py-4
                  rounded-xl sm:rounded-2xl
                  text-sm sm:text-base
                  font-semibold
                  shadow-lg
                  transition">

            + Tambah Produk

        </a>

    </div>

</div>

<!-- PRODUCTS TABLE -->
<div class="bg-white
            rounded-2xl sm:rounded-[35px]
            overflow-x-auto
            border border-[#dfe4db]
            shadow-[0_10px_35px_rgba(0,0,0,0.05)]">
    
    <div class="min-w-[900px]">

    <!-- TABLE HEADER -->
    <div class="grid
                grid-cols-12
                bg-[#cfd5cd]
                text-[#2d312b]
                text-sm sm:text-base
                font-semibold
                px-4 sm:px-8 py-4 sm:py-6">

        <div class="col-span-4">
            Produk
        </div>

        <div class="col-span-2">
            Harga
        </div>

        <div class="col-span-2">
            Kategori
        </div>

        <div class="col-span-2">
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
                    px-4 sm:px-8 py-4 sm:py-8
                    border-t border-[#ecefea]">

            <!-- PRODUCT -->
            <div class="col-span-4 flex gap-6">

                <img src="{{ asset('storage/' . $product->image) }}"
                     class="w-20 h-28 sm:w-32 sm:h-40
                            object-cover
                            rounded-xl sm:rounded-2xl
                            shadow-md shrink-0">

                <div>

                    <h2 class="text-lg sm:text-xl md:text-3xl
                               font-semibold
                               text-[#2d312b] line-clamp-2">

                        {{ $product->name }}

                    </h2>

                    <p class="text-[#7a8276] mt-2">
                        #{{ $product->id }}
                    </p>

                    <p class="text-xs sm:text-sm text-[#6f776b]
                              mt-2 sm:mt-5
                              leading-relaxed sm:leading-9
                              max-w-xl line-clamp-2 sm:line-clamp-none">

                        {{ Str::limit($product->description, 150) }}

                    </p>

                </div>

            </div>

            <!-- PRICE -->
            <div class="col-span-2">

                <h3 class="text-base sm:text-lg md:text-2xl
                           font-semibold
                           text-emerald-600">

                    Rp {{ number_format($product->price) }}

                </h3>

            </div>

            <!-- CATEGORY -->
            <div class="col-span-2">

                <span class="bg-[#e7ebe4]
                             text-[#2f312e]
                             px-3 sm:px-5 py-1.5 sm:py-3
                             rounded-lg sm:rounded-2xl
                             text-xs sm:text-sm font-semibold">

                    {{ $product->category }}

                </span>

            </div>

            <!-- STOCK -->
            <div class="col-span-2 flex flex-col gap-1 items-start">
                
                @if($product->variants && $product->variants->count() > 0)
                    @foreach($product->variants as $variant)
                        <span class="bg-[#cdeccf] text-[#26733b] px-2 py-1 rounded-md text-[10px] sm:text-xs font-semibold whitespace-nowrap border border-[#26733b]/20">
                            {{ $variant->color }} - {{ $variant->size }}: {{ $variant->stock }}
                        </span>
                    @endforeach
                @else
                    <span class="bg-[#cdeccf]
                                 text-[#26733b]
                                 px-3 py-1.5
                                 rounded-lg
                                 text-xs font-semibold">

                        {{ $product->stock }} pcs

                    </span>
                @endif

            </div>

            <!-- ACTION -->
            <div class="col-span-2">

                <div class="flex justify-center gap-4">

                    <!-- EDIT -->
                    <a href="{{ route('admin.products.edit', $product->id) }}"
                       class="bg-[#facc15]
                              hover:bg-yellow-400
                              text-white
                              px-3 sm:px-6 py-2 sm:py-3
                              rounded-lg sm:rounded-2xl
                              text-xs sm:text-sm font-semibold
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
                                       px-3 sm:px-6 py-2 sm:py-3
                                       rounded-lg sm:rounded-2xl
                                       text-xs sm:text-sm font-semibold
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
</div>

@endsection