<x-app-layout>

    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-700">
            Edit Product
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#edf1ed] py-6 sm:py-10 px-4 sm:px-6">

        <div class="max-w-3xl mx-auto bg-white p-5 sm:p-8 rounded-2xl sm:rounded-3xl shadow-xl">

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

                <!-- VARIANTS (COLOR, SIZE & STOCK) -->
                <div class="mb-5">
                    <label class="block mb-2 font-semibold text-gray-700">
                        Varian Warna, Ukuran & Stok
                    </label>
                    <p class="text-xs text-gray-500 mb-4">Tambahkan kombinasi warna dan ukuran beserta stok masing-masing. Stok total akan dihitung otomatis.</p>
                    
                    <div id="variants-container" class="space-y-3">
                        @if($product->variants && $product->variants->count() > 0)
                            @foreach($product->variants as $index => $variant)
                                <div class="flex gap-2 sm:gap-4 items-center variant-row">
                                    <input type="text" name="variants[{{ $index }}][color]" value="{{ $variant->color }}" placeholder="Warna (Merah/Hitam)" required
                                           class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#55624d] text-sm">
                                    <input type="text" name="variants[{{ $index }}][size]" value="{{ $variant->size }}" placeholder="Ukuran (S/M/L)" required
                                           class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#55624d] text-sm">
                                    <input type="number" name="variants[{{ $index }}][stock]" value="{{ $variant->stock }}" placeholder="Stok" required min="0"
                                           class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#55624d] text-sm">
                                    <button type="button" class="remove-variant-btn text-red-500 font-bold px-3 py-2 hover:bg-red-50 rounded-lg transition" onclick="removeVariant(this)">&times;</button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex gap-2 sm:gap-4 items-center variant-row">
                                <input type="text" name="variants[0][color]" placeholder="Warna (Merah/Hitam)" required
                                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#55624d] text-sm">
                                <input type="text" name="variants[0][size]" placeholder="Ukuran (S/M/L)" required
                                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#55624d] text-sm">
                                <input type="number" name="variants[0][stock]" placeholder="Stok" required min="0"
                                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#55624d] text-sm">
                                <button type="button" class="remove-variant-btn text-red-500 font-bold px-3 py-2 hover:bg-red-50 rounded-lg transition" onclick="removeVariant(this)">&times;</button>
                            </div>
                        @endif
                    </div>

                    <button type="button" id="add-variant-btn" onclick="addVariant()" class="mt-4 px-4 py-2 bg-gray-100 border border-gray-300 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-200 transition">
                        + Tambah Varian
                    </button>
                </div>

                <script>
                    let variantCount = {{ $product->variants ? $product->variants->count() : 1 }};
                    function addVariant() {
                        const container = document.getElementById('variants-container');
                        const row = document.createElement('div');
                        row.className = 'flex gap-2 sm:gap-4 items-center variant-row';
                        row.innerHTML = `
                            <input type="text" name="variants[${variantCount}][color]" placeholder="Warna (Merah/Hitam)" required
                                   class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#55624d] text-sm">
                            <input type="text" name="variants[${variantCount}][size]" placeholder="Ukuran (S/M/L)" required
                                   class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#55624d] text-sm">
                            <input type="number" name="variants[${variantCount}][stock]" placeholder="Stok" required min="0"
                                   class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#55624d] text-sm">
                            <button type="button" class="remove-variant-btn text-red-500 font-bold px-3 py-2 hover:bg-red-50 rounded-lg transition" onclick="removeVariant(this)">&times;</button>
                        `;
                        container.appendChild(row);
                        variantCount++;
                    }

                    function removeVariant(button) {
                        const container = document.getElementById('variants-container');
                        if (container.children.length > 1) {
                            button.parentElement.remove();
                        } else {
                            alert("Harus ada minimal 1 varian!");
                        }
                    }
                </script>




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