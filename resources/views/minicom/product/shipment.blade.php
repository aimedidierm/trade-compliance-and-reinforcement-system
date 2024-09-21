@extends('layout')

@section('content')
<x-minicom-navbar />
<main class="container mx-auto py-8 px-6">
    <div class="flex justify-between items-center mb-4">
        <div class="text-xl font-semibold">Product Shipments</div>
    </div>
    <div class="flex gap-6 mb-8">

        <x-minicom-products-navbar />
        <div class="card">
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
                            <span class="text-red-600">Not Payed</span>
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