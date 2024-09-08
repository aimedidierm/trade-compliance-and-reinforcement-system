@extends('layout')

@section('content')

<x-minicom-navbar />

<main class="container mx-auto py-8 px-6">
    <div class="card">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold mb-4">Documents</h2>
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
                    <th class="py-2 px-4 border-b">User</th>
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
                    <td class="py-2 px-4 border-b">{{$document->user->name}}</td>
                    <td class="py-2 px-4 border-b">{{$document->type}}</td>
                    <td class="py-2 px-4 border-b">
                        @if ($document->status == \App\Enums\DocumentStatus::APPROVED->value)
                        <span class="text-green-500">● Approved</span>
                        @elseif ($document->status == \App\Enums\DocumentStatus::REJECTED->value)
                        <span class="text-red-500">● Rejected</span>
                        @else
                        <span class="text-yellow-500">● Pending</span>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b"><a href="{{$document->src}}"
                            class="text-blue-500 hover:underline">click here</a>
                    </td>
                    @if ($document->status == \App\Enums\DocumentStatus::PENDING->value)
                    <td class="py-2 px-4 border-b">
                        <a type="button" href="/minicom/documents/approve/{{$document->id}}"
                            class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-2 py-1 text-center me-1 mb-1 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-red-900">Approve
                        </a>
                        <a type="button" href="/minicom/documents/reject/{{$document->id}}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-2 py-1 text-center me-1 mb-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">Reject
                        </a>
                    </td>
                    @endif
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
@stop