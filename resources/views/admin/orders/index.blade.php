
@extends('layouts.admin')
@section('content')

<div class="max-w-7xl mx-auto py-10">

    <h1 class="text-4xl font-light mb-8 text-[#2f312e]">
        Orders Management
    </h1>

    <div class="space-y-8">

        @forelse($orders as $order)

            <div class="bg-white rounded-[30px] p-8 shadow border border-[#e1e5dd]">

                <!-- HEADER -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

                    <div>

                        <h2 class="text-2xl font-semibold text-[#55624d]">
                            {{ $order->customer_name }}
                        </h2>

                        <p class="text-gray-500 mt-1">
                            {{ $order->phone }}
                        </p>

                        <p class="text-gray-500">
                            {{ $order->address }}
                        </p>

                    </div>

                    <div class="text-right">

                        <p class="text-sm text-gray-500">
                            Total Item
                        </p>

                        <p class="text-2xl font-semibold text-[#55624d]">
                            {{ $order->total_item }}
                        </p>

                        <p class="mt-2 text-sm text-gray-500">
                            Total Price
                        </p>

                        <p class="text-3xl font-bold text-[#55624d]">
                            Rp {{ number_format($order->total_price) }}
                        </p>

                    </div>

                </div>

                <!-- PRODUCTS -->
                <div class="space-y-6">

                    @foreach($order->items as $item)

                        <div class="flex flex-col md:flex-row gap-6 border-t pt-6">

                            <!-- IMAGE -->
                            <div>

                                @if($item->product && $item->product->image)

                                    <img
                                        src="{{ asset('storage/' . $item->product->image) }}"
                                        class="w-32 h-32 object-cover rounded-2xl">

                                @else

                                    <div class="w-32 h-32 bg-gray-200 rounded-2xl"></div>

                                @endif

                            </div>

                            <!-- DETAIL -->
                            <div class="flex-1">

                                <h3 class="text-2xl font-semibold text-[#2f312e]">
                                    {{ $item->product->name ?? 'Product Deleted' }}
                                </h3>

                                <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">

                                    <div>
                                        <p class="text-sm text-gray-500">
                                            Size
                                        </p>

                                        <p class="font-semibold">
                                            {{ $item->size }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-sm text-gray-500">
                                            Color
                                        </p>

                                        <p class="font-semibold">
                                            {{ $item->color }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-sm text-gray-500">
                                            Quantity
                                        </p>

                                        <p class="font-semibold">
                                            {{ $item->quantity }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-sm text-gray-500">
                                            Price
                                        </p>

                                        <p class="font-semibold text-[#55624d]">
                                            Rp {{ number_format($item->price) }}
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                    <!-- STATUS ORDER -->
<div class="mt-8
            pt-6
            border-t
            flex flex-col md:flex-row
            md:items-center
            md:justify-between
            gap-5">

    <!-- STATUS -->
    <div>

        <p class="text-sm text-gray-500 mb-2">
            Status Pengiriman
        </p>

        @php

            $statusColor = match($order->status) {

                'pending' => 'bg-gray-200 text-gray-700',
                'paid' => 'bg-blue-100 text-blue-700',
                'packing' => 'bg-yellow-100 text-yellow-700',
                'shipped' => 'bg-purple-100 text-purple-700',
                'delivered' => 'bg-green-100 text-green-700',
                'cancelled' => 'bg-red-100 text-red-700',

                default => 'bg-gray-200 text-gray-700'

            };

        @endphp

        <span class="px-5 py-2 rounded-full font-semibold {{ $statusColor }}">

            {{ strtoupper($order->status) }}

        </span>

    </div>

    <!-- UPDATE STATUS -->
    <form
        action="{{ route('admin.orders.status', $order->id) }}"
        method="POST"
        class="flex gap-3 items-center">

        @csrf
        @method('PUT')

        <select
            name="status"
            class="rounded-2xl border-[#d7ddd2]">

            <option value="pending">Pending</option>

            <option value="paid">
                Paid
            </option>

            <option value="packing">
                Sedang Dikemas
            </option>

            <option value="shipped">
                Sudah Dikirim
            </option>

            <option value="delivered">
                Sudah Sampai
            </option>

            <option value="cancelled">
                Cancel
            </option>

        </select>

        <button
            type="submit"
            class="bg-[#55624d]
                   hover:bg-[#40483a]
                   text-white
                   px-6 py-3
                   rounded-2xl
                   font-semibold
                   transition">

            Update

        </button>

    </form>

</div>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-[30px] p-10 text-center shadow">

                <h2 class="text-2xl text-gray-500">
                    Belum ada pesanan
                </h2>

            </div>

        @endforelse

    </div>

</div>

@endsection