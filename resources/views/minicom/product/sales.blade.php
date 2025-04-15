@extends('layout')

@section('content')
<x-minicom-navbar />
<main class="container mx-auto py-8 px-6">
    <div class="flex justify-between items-center mb-4">
        <div class="text-xl font-semibold">Products Sales</div>
        <button id="openFormBtn" class="px-4 py-2 bg-orange-500 hover:bg-orange-400 text-white rounded">Generate
            Report</button>
        <div id="formContainer"
            class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 z-50 transform translate-x-full opacity-0 transition-transform duration-300 ease-out pointer-events-none">
            <div class="bg-white p-6 rounded shadow-lg w-full max-w-md mx-auto">
                <h2 class="text-2xl font-semibold mb-4">Select report details</h2>
                <form method="POST" action="/minicom/products/report" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" class="mt-1 p-2 w-full border rounded"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date:</label>
                        <input type="date" id="end_date" name="end_date" class="mt-1 p-2 w-full border rounded"
                            required>
                    </div>

                    <div class="flex justify-between space-x-2">
                        <button type="button" id="closeFormBtn"
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-black hover:bg-gray-800 text-white rounded flex items-center">
                            Save
                            <span class="material-symbols-outlined">
                                arrow_forward
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="flex gap-6 mb-8">

        <x-minicom-products-navbar />
        <div class="w-full card">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Sale name</th>
                        <th class="py-2 px-4 border-b">Product</th>
                        <th class="py-2 px-4 border-b">Invoice</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                    <td class="py-2 px-4 border-b">{{$sale->name}}</td>
                    <td class="py-2 px-4 border-b">{{$sale->product->name}}</td>
                    <td class="py-2 px-4 border-b">{{$sale->product->invoice}}</td>
                    <td class="py-2 px-4 border-b">{{$sale->product->price}}</td>
                    <td class="py-2 px-4 border-b">
                        @if ($sale->status == \App\Enums\SaleStatus::DELIVERED->value)
                        <span class="status-active">● Delivered</span>
                        @elseif ($sale->status == \App\Enums\SaleStatus::SHIPPED->value)
                        <span class="text-yellow-400">● Shipped</span>
                        @else
                        <span class="text-red-600">● Pending</span>
                        @endif
                    </td>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-between items-center mt-4">
                @if ($sales->onFirstPage())
                <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">← Previous</span>
                @else
                <a href="{{ $sales->previousPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">←
                    Previous</a>
                @endif

                <div class="flex space-x-2">
                    @foreach ($sales->links()->elements as $element)
                    @if (is_string($element))
                    <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                    @foreach ($element as $page => $url)
                    @if ($page == $sales->currentPage())
                    <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $page }}</span>
                    @else
                    <a href="{{ $url }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $page }}</a>
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                </div>

                @if ($sales->hasMorePages())
                <a href="{{ $sales->nextPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">Next →</a>
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