<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#edf1eb] text-[#2f312e]">

<div class="max-w-6xl mx-auto py-10 px-6">

    <h1 class="text-4xl font-light mb-10">
        Pesanan Saya
    </h1>

    @if($orders->count() > 0)

        @foreach($orders as $order)

            <div class="bg-white rounded-3xl shadow-lg p-8 mb-8">

                <div class="flex justify-between items-center mb-6">

                    <div>

                        <h2 class="text-2xl font-semibold">
                            Order #{{ $order->id }}
                        </h2>

                        <p class="text-gray-500">
                            {{ $order->created_at->format('d M Y H:i') }}
                        </p>

                    </div>

                    <div class="text-right">

                        <p class="text-sm text-gray-500">
                            Total
                        </p>

                        <p class="text-3xl font-bold text-[#55624d]">
                            Rp {{ number_format($order->total_price) }}
                        </p>

                    </div>

                </div>

                <div class="space-y-5">

                    @foreach($order->items as $item)

                        <div class="flex gap-5 items-center border-b pb-5">

                            <img
                                src="{{ asset('storage/' . $item->product->image) }}"
                                class="w-24 h-24 object-cover rounded-2xl">

                            <div class="flex-1">

                                <h3 class="text-xl font-semibold">
                                    {{ $item->product->name }}
                                </h3>

                                <p class="text-gray-500">
                                    {{ $item->color }} / {{ $item->size }}
                                </p>

                                <p class="text-gray-500">
                                    Qty: {{ $item->quantity }}
                                </p>

                            </div>

                            <div class="text-2xl font-bold text-[#55624d]">

                                Rp {{ number_format($item->price) }}

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endforeach

    @else

        <div class="bg-white rounded-3xl shadow-lg p-16 text-center">

            <h2 class="text-3xl text-gray-400">
                Belum ada pesanan
            </h2>

        </div>

    @endif

</div>

</body>
</html>