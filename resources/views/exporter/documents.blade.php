@extends('layout')

@section('content')

<x-exporter-navbar />

<main class="container mx-auto py-8 px-6">
    <div class="card">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold mb-4">Documents</h2>
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">User</th>
                    <th class="py-2 px-4 border-b">Type</th>
                    <th class="py-2 px-4 border-b">Open</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                <tr>
                    <td class="py-2 px-4 border-b">{{$document->name}}</td>
                    <td class="py-2 px-4 border-b">{{$document->user->name}}</td>
                    <td class="py-2 px-4 border-b">{{$document->type}}</td>
                    <td class="py-2 px-4 border-b"><a href="{{$document->src}}"
                            class="text-blue-500 hover:underline">click here</a>
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
@stop