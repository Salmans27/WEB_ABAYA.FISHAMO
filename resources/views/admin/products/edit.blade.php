<x-app-layout>

    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-700">
            Edit Product
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#edf1ed] py-10">

        <div class="max-w-3xl mx-auto bg-white p-8 rounded-3xl shadow-xl">

            <!-- ERROR -->
            @if ($errors->any())

                <div class="bg-red-100 text-red-700 p-5 rounded-2xl mb-6">

                    <ul class="list-disc pl-5">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <!-- FORM -->
            <form action="/admin/products/{{ $product->id }}/update"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <!-- NAME -->
                <div class="mb-5">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Product Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name', $product->name) }}"
                           class="w-full rounded-xl border-gray-300 focus:ring-gray-500">

                </div>

                <!-- DESCRIPTION -->
                <div class="mb-5">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Description
                    </label>

                    <textarea name="description"
                              rows="4"
                              class="w-full rounded-xl border-gray-300 focus:ring-gray-500">{{ old('description', $product->description) }}</textarea>

                </div>

                <!-- PRICE -->
                <div class="mb-5">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Price
                    </label>

                    <input type="number"
                           name="price"
                           value="{{ old('price', $product->price) }}"
                           class="w-full rounded-xl border-gray-300 focus:ring-gray-500">

                </div>

                <!-- CATEGORY -->
                <div class="mb-5">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Category
                    </label>

                    <input type="text"
                           name="category"
                           value="{{ old('category', $product->category) }}"
                           class="w-full rounded-xl border-gray-300 focus:ring-gray-500">

                </div>

                <!-- STOCK -->
                <div class="mb-5">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Stock
                    </label>

                    <input type="number"
                           name="stock"
                           value="{{ old('stock', $product->stock) }}"
                           class="w-full rounded-xl border-gray-300 focus:ring-gray-500">

                </div>

                <!-- SIZE -->
                <div class="mb-5">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Size
                    </label>

                    <input type="text"
                           name="size"
                           value="{{ old('size', $product->size) }}"
                           class="w-full rounded-xl border-gray-300 focus:ring-gray-500">

                </div>

                <!-- COLOR -->
                <div class="mb-5">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Color
                    </label>

                    <input type="text"
                           name="color"
                           value="{{ old('color', $product->color) }}"
                           class="w-full rounded-xl border-gray-300 focus:ring-gray-500">

                </div>

                <!-- CURRENT IMAGE -->
                <div class="mb-5">

                    <label class="block mb-2 font-semibold text-gray-700">
                        Current Image
                    </label>

                    @if($product->image)

                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="w-40 rounded-2xl shadow-md mb-4 border">

                    @else

                        <div class="w-40 h-40 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-400">
                            No Image
                        </div>

                    @endif

                </div>

                <!-- NEW IMAGE -->
                <div class="mb-6">

                    <label class="block mb-2 font-semibold text-gray-700">
                        New Image
                    </label>

                    <input type="file"
                           name="image"
                           class="w-full border rounded-xl p-3">

                </div>

                <!-- BUTTON -->
                <button type="submit"
                        class="bg-gray-700 hover:bg-black
                               text-white px-6 py-3
                               rounded-xl font-semibold transition">

                    Update Product

                </button>

            </form>

        </div>

    </div>

</x-app-layout>