@extends('layout')

@section('content')
<x-minicom-navbar />
<main class="container mx-auto py-8 px-6">
    <div class="flex justify-between items-center mb-4">
        <div class="text-xl font-semibold">Product Declarations</div>
    </div>
    <div class="flex gap-6 mb-8">

        <x-minicom-products-navbar />
        <div class="w-full card">
            <table class="w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Address</th>
                        <th class="py-2 px-4 border-b">Quantity</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Weight</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($declarations as $declaration)
                    <tr>
                        <td class="py-2 px-4 border-b">{{$declaration->address}}</td>
                        <td class="py-2 px-4 border-b">{{$declaration->quantity}}</td>
                        <td class="py-2 px-4 border-b">{{$declaration->price}} Rwf</td>
                        <td class="py-2 px-4 border-b">{{$declaration->weight}} Kg</td>
                        <td class="py-2 px-4 border-b">{{$declaration->status}}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($declaration->status == \App\Enums\DeclarationStatus::PENDING->value)
                            <a type="button" href="/exporter/products/declaration/ship/{{$declaration->id}}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-2 py-1 text-center me-1 mb-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">Shipped
                            </a>
                            @elseif($declaration->status == \App\Enums\DeclarationStatus::SHIPPED->value)
                            <a type="button" href="/exporter/products/declaration/delivered/{{$declaration->id}}"
                                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-2 py-1 text-center me-1 mb-1 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">Delivered
                            </a>
                            @else
                            <span class="text-green-400">● Delivered</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-between items-center mt-4">
                @if ($declarations->onFirstPage())
                <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">← Previous</span>
                @else
                <a href="{{ $declarations->previousPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">←
                    Previous</a>
                @endif

                <div class="flex space-x-2">
                    @foreach ($declarations->links()->elements as $element)
                    @if (is_string($element))
                    <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                    @foreach ($element as $page => $url)
                    @if ($page == $declarations->currentPage())
                    <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $page }}</span>
                    @else
                    <a href="{{ $url }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $page }}</a>
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                </div>

                @if ($declarations->hasMorePages())
                <a href="{{ $declarations->nextPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">Next
                    →</a>
                @else
                <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">Next →</span>
                @endif
            </div>
        </div>
    </div>
</main>
@stop