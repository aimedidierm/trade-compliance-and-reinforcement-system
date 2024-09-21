@extends('layout')

@section('content')

<x-seller-navbar />

<main class="container mx-auto py-8 px-6">
    <div class="flex justify-between items-center mb-4">
        <div class="text-xl font-semibold">Shipment Management</div>
    </div>
    <div class="flex gap-6 mb-8">

        <x-seller-products-navbar />
        <div class="card">
            @if($errors->any())
            <span style="color: red;">{{$errors->first()}}</span>
            @endif
            @if (session('success'))
            <div id="alert-3"
                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            @endif
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Product</th>
                        <th class="py-2 px-4 border-b">Packaging Number</th>
                        <th class="py-2 px-4 border-b">Currier</th>
                        <th class="py-2 px-4 border-b">Ship Via</th>
                        <th class="py-2 px-4 border-b">Date</th>
                        <th class="py-2 px-4 border-b">Address</th>
                        <th class="py-2 px-4 border-b">Tracking</th>
                        <th class="py-2 px-4 border-b">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipments as $shipment)
                    <tr>
                        <td class="py-2 px-4 border-b">{{$shipment->sale->product->name}}</td>
                        <td class="py-2 px-4 border-b">{{$shipment->packaging_number}}</td>
                        <td class="py-2 px-4 border-b">{{$shipment->currier}}</td>
                        <td class="py-2 px-4 border-b">{{$shipment->ship_via}}</td>
                        <td class="py-2 px-4 border-b">{{$shipment->date}}</td>
                        <td class="py-2 px-4 border-b">{{$shipment->address}}</td>
                        <td class="py-2 px-4 border-b">{{$shipment->tracking_number}}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($shipment->status == \App\Enums\ShipmentStatus::PAYED->value)
                            <span class="status-active">Payed</span>
                            @else
                            <a type="button" href="/seller/products/shipment/{{$shipment->id}}"
                                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-2 py-1 text-center me-1 mb-1 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-red-900">Pay
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-between items-center mt-4">
                @if ($shipments->onFirstPage())
                <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">← Previous</span>
                @else
                <a href="{{ $shipments->previousPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">←
                    Previous</a>
                @endif

                <div class="flex space-x-2">
                    @foreach ($shipments->links()->elements as $element)
                    @if (is_string($element))
                    <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                    @foreach ($element as $page => $url)
                    @if ($page == $shipments->currentPage())
                    <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $page }}</span>
                    @else
                    <a href="{{ $url }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $page }}</a>
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                </div>

                @if ($shipments->hasMorePages())
                <a href="{{ $shipments->nextPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">Next →</a>
                @else
                <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">Next →</span>
                @endif
            </div>
        </div>
    </div>
</main>
@stop