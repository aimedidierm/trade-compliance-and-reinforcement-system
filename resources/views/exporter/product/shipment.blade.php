@extends('layout')

@section('content')

<x-exporter-navbar />

<main class="container mx-auto py-8 px-6">
    <div class="flex justify-between items-center mb-4">
        <div class="text-xl font-semibold">Product Management</div>
        <div class="flex space-x-4">
            <button id="openFormBtn" class="px-4 py-2 bg-orange-500 hover:bg-orange-400 text-white rounded">Add
                new</button>
        </div>
        <div id="formContainer"
            class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 z-50 transform translate-x-full opacity-0 transition-transform duration-300 ease-out pointer-events-none">
            <div class="bg-white p-6 rounded shadow-lg w-full max-w-md mx-auto">
                <h2 class="text-2xl font-semibold mb-4">Add New Shipment</h2>
                <form method="POST" action="/exporter/products" enctype="multipart/form-data">
                    @csrf
                    <div class="flex-1 gap-2 mb-4">
                        <label for="sale" class="block text-sm font-medium text-gray-700">Sale</label>
                        <select name="sale" id="sale" class="mt-1 p-2 w-full border rounded">
                            @foreach ($sales as $sale)
                            <option value="{{ $sale->id }}">{{ $sale->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-wrap gap-4 mb-4">
                        <div class="flex-1">
                            <label for="packaging_number" class="block text-sm font-medium text-gray-700">Packaging
                            </label>
                            <input type="text" id="packaging_number" name="packaging_number"
                                class="mt-1 p-2 w-full border rounded" placeholder="Enter packaging number" required>
                        </div>
                        <div class="flex-1">
                            <label for="courier" class="block text-sm font-medium text-gray-700">Courier</label>
                            <input type="text" id="courier" name="courier" class="mt-1 p-2 w-full border rounded"
                                placeholder="Enter courier" required>
                        </div>
                        <div class="flex-1">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" id="address" name="address" class="mt-1 p-2 w-full border rounded"
                                placeholder="Enter address" required>
                        </div>
                        <div class="flex-1">
                            <label for="tracking" class="block text-sm font-medium text-gray-700">Tracking</label>
                            <input type="text" id="tracking" name="tracking" class="mt-1 p-2 w-full border rounded"
                                placeholder="Enter tracking number" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <div class="flex-1">
                            <label for="ship_via" class="block text-sm font-medium text-gray-700">Ship Via</label>
                            <input type="text" id="ship_via" name="ship_via" class="mt-1 p-2 w-full border rounded"
                                placeholder="Enter ship via" required>
                        </div>
                        <div class="flex-1">
                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" id="date" name="date" class="mt-1 p-2 w-full border rounded" required>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-2">
                        <button type="button" id="closeFormBtn"
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-black hover:bg-gray-800 text-white rounded flex items-center">
                            Save
                            <span class="material-symbols-outlined ml-2">
                                arrow_forward
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="flex gap-6 mb-8">

        <x-exporter-products-navbar />
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
<script>
    document.getElementById('openFormBtn').addEventListener('click', function() {
        const formContainer = document.getElementById('formContainer');
        formContainer.classList.remove('translate-x-full', 'opacity-0', 'pointer-events-none');
        formContainer.classList.add('translate-x-0', 'opacity-100', 'pointer-events-auto');
    });

    document.getElementById('closeFormBtn').addEventListener('click', function() {
        const formContainer = document.getElementById('formContainer');
        formContainer.classList.remove('translate-x-0', 'opacity-100', 'pointer-events-auto');
        formContainer.classList.add('translate-x-full', 'opacity-0', 'pointer-events-none');
    });

    // Optional: Close form when clicking outside the form content
    document.addEventListener('click', function(event) {
        const formContainer = document.getElementById('formContainer');
        const formContent = formContainer.querySelector('div');

        if (!formContent.contains(event.target) && !event.target.closest('#openFormBtn')) {
            formContainer.classList.remove('translate-x-0', 'opacity-100', 'pointer-events-auto');
            formContainer.classList.add('translate-x-full', 'opacity-0', 'pointer-events-none');
        }
    });
</script>
@stop