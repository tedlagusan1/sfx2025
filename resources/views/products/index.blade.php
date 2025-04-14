@extends('auth_layout')

@section('main-content')
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl text-white">
                Products
            </h2>
            <a href="{{ route('products.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Add New Product
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $prod)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $prod->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $prod->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-green-600">${{ number_format($prod->price, 2) }}</span>
                            <span
                                class="px-3 py-1 rounded-full text-sm
                            @if ($prod->status == 0) bg-yellow-100 text-yellow-800
                            @elseif($prod->status == 1) bg-green-100 text-green-800
                            @elseif($prod->status == 2) bg-blue-100 text-blue-800
                            @else bg-red-100 text-red-800 @endif">
                                @if ($prod->status == 0)
                                    Pending
                                @elseif($prod->status == 1)
                                    Available
                                @elseif($prod->status == 2)
                                    Reserved
                                @else
                                    Sold
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
