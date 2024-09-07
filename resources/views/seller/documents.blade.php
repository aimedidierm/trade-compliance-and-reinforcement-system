@extends('layout')

@section('content')

<x-seller-navbar />

<main class="container mx-auto py-8 px-6">
    <div class="card">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold mb-4">Documents</h2>
            <div class="flex space-x-4">
                <button id="openFormBtn" class="px-4 py-2 bg-orange-500 hover:bg-orange-400 text-white rounded">Add
                    new</button>
            </div>
            <div id="formContainer"
                class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 z-50 transform translate-x-full opacity-0 transition-transform duration-300 ease-out pointer-events-none">
                <div class="bg-white p-6 rounded shadow-lg w-full max-w-md mx-auto">
                    <h2 class="text-2xl font-semibold mb-4">Add New Document</h2>
                    <form method="POST" action="/seller/documents" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <select name="type" id="type" class="mt-1 p-2 w-full border rounded">
                                <option value="certificate">Certificate</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">Upload
                                File</label>
                            <input type="file" name="file" id="file" class="mt-1 p-2 w-full border rounded">
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
        @if($errors->any())
        <span style="color: red;">{{$errors->first()}}</span>
        @endif
        @if (session('success'))
        <div id="alert-3"
            class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
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
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Type</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Open</th>
                    <th class="py-2 px-4 border-b"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                <tr>
                    <td class="py-2 px-4 border-b">{{$document->name}}</td>
                    <td class="py-2 px-4 border-b">{{$document->type}}</td>
                    <td class="py-2 px-4 border-b">{{$document->status}}</td>
                    <td class="py-2 px-4 border-b"><a href="{{$document->src}}"
                            class="text-blue-500 hover:underline">click here</a>
                    </td>
                    <td class="py-2 px-4 border-b">
                        <form action="{{ route('seller.documents.destroy', $document->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this document?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-lg">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-between items-center mt-4">
            @if ($documents->onFirstPage())
            <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">← Previous</span>
            @else
            <a href="{{ $documents->previousPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">←
                Previous</a>
            @endif

            <div class="flex space-x-2">
                @foreach ($documents->links()->elements as $element)
                @if (is_string($element))
                <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $element }}</span>
                @endif

                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $documents->currentPage())
                <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $page }}</span>
                @else
                <a href="{{ $url }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $page }}</a>
                @endif
                @endforeach
                @endif
                @endforeach
            </div>

            @if ($documents->hasMorePages())
            <a href="{{ $documents->nextPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">Next →</a>
            @else
            <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">Next →</span>
            @endif
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