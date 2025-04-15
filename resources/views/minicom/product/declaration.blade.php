@extends('layout')

@section('content')
<x-minicom-navbar />
<main class="container mx-auto py-8 px-6">
    <div class="flex justify-between items-center mb-4">
        <div class="text-xl font-semibold">Product Declarations</div>
        <button id="openFormBtn" class="px-4 py-2 bg-orange-500 hover:bg-orange-400 text-white rounded">Generate
            Report</button>
        <div id="formContainer"
            class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 z-50 transform translate-x-full opacity-0 transition-transform duration-300 ease-out pointer-events-none">
            <div class="bg-white p-6 rounded shadow-lg w-full max-w-md mx-auto">
                <h2 class="text-2xl font-semibold mb-4">Select report details</h2>
                <form method="POST" action="/minicom/products/declaration/report" enctype="multipart/form-data">
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