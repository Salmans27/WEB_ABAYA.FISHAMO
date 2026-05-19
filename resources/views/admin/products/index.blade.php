<x-app-layout>

    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-700">
            Products Management
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#edf1ed] py-10">

        <div class="max-w-7xl mx-auto px-6">

            <!-- TOP BAR -->
            <div class="flex items-center justify-between mb-8">

                <div>

                    <h1 class="text-4xl font-bold text-gray-700">
                        All Products
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Kelola semua produk Abaya Fishamo Store.
                    </p>

                </div>

                <!-- BUTTON TAMBAH -->
                <a href="/admin/products/create"
                   class="bg-gray-700 hover:bg-black
                          text-white px-6 py-3
                          rounded-2xl font-semibold
                          shadow-lg transition">

                    + Tambah Produk

                </a>

            </div>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))

                <div class="bg-green-100 text-green-700
                            px-6 py-4 rounded-2xl mb-6">

                    {{ session('success') }}

                </div>

            @endif

            <!-- TABLE CARD -->
            <div class="bg-white rounded-3xl shadow-2xl
                        overflow-hidden border border-gray-100">

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <!-- TABLE HEADER -->
                        <thead class="bg-[#dfe5df]">

                            <tr>

                                <th class="px-6 py-5 text-left text-gray-700 font-bold">
                                    Produk
                                </th>

                                <th class="px-6 py-5 text-left text-gray-700 font-bold">
                                    Harga
                                </th>

                                <th class="px-6 py-5 text-left text-gray-700 font-bold">
                                    Kategori
                                </th>

                                <th class="px-6 py-5 text-left text-gray-700 font-bold">
                                    Stock
                                </th>

                                <th class="px-6 py-5 text-center text-gray-700 font-bold">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <!-- TABLE BODY -->
                        <tbody>

                            @forelse($products as $product)

                                <tr class="border-b hover:bg-[#f5f7f5]
                                           transition duration-200">

                                    <!-- PRODUCT -->
                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-4">

                                            <!-- IMAGE -->
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                 alt="{{ $product->name }}"
                                                 class="w-24 h-24 object-cover
                                                        rounded-2xl shadow-md
                                                        border">

                                            <!-- INFO -->
                                            <div>

                                                <h2 class="font-bold text-xl text-gray-700">
                                                    {{ $product->name }}
                                                </h2>

                                                <p class="text-sm text-gray-500 mt-1">
                                                    #{{ $product->id }}
                                                </p>

                                                <p class="text-sm text-gray-400 mt-2 max-w-xs">
                                                    {{ $product->description }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>

                                    <!-- PRICE -->
                                    <td class="px-6 py-5">

                                        <p class="font-bold text-lg text-green-600">

                                            Rp {{ number_format($product->price) }}

                                        </p>

                                    </td>

                                    <!-- CATEGORY -->
                                    <td class="px-6 py-5">

                                        <span class="bg-[#edf1ed]
                                                     text-gray-700
                                                     px-4 py-2
                                                     rounded-xl
                                                     text-sm font-semibold">

                                            {{ $product->category }}

                                        </span>

                                    </td>

                                    <!-- STOCK -->
                                    <td class="px-6 py-5">

                                        <span class="bg-green-100
                                                     text-green-700
                                                     px-4 py-2
                                                     rounded-xl
                                                     text-sm font-bold">

                                            {{ $product->stock }} pcs

                                        </span>

                                    </td>

                                    <!-- ACTION -->
                                    <td class="px-6 py-5">

                                        <div class="flex items-center
                                                    justify-center gap-3">

                                            <!-- EDIT -->
                                            <a href="/admin/products/{{ $product->id }}/edit"
                                               class="bg-yellow-400
                                                      hover:bg-yellow-500
                                                      text-white
                                                      px-5 py-2
                                                      rounded-xl
                                                      font-semibold
                                                      shadow transition">

                                                Edit

                                            </a>

                                            <!-- DELETE -->
                                            <form action="/admin/products/{{ $product->id }}/delete"
                                                  method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        onclick="return confirm('Yakin hapus produk ini?')"
                                                        class="bg-red-500
                                                               hover:bg-red-600
                                                               text-white
                                                               px-5 py-2
                                                               rounded-xl
                                                               font-semibold
                                                               shadow transition">

                                                    Delete

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <!-- EMPTY -->
                                <tr>

                                    <td colspan="5"
                                        class="text-center py-20">

                                        <div class="flex flex-col items-center">

                                            <p class="text-gray-400 text-2xl font-semibold">
                                                Belum ada produk
                                            </p>

                                            <p class="text-gray-300 mt-2">
                                                Tambahkan produk pertama kamu
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>