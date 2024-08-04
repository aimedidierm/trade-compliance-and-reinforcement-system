@extends('layout')

@section('content')
@if (Auth::user()->role == \App\Enums\UserRole::EXPORTER->value)
<x-exporter-navbar />
@elseif(Auth::user()->role == \App\Enums\UserRole::MINICOM->value)
<x-minicom-navbar />
@else
<x-seller-navbar />
@endif


<main class="container mx-auto py-8 px-6">
    <div class="card">
        <h2 class="text-lg font-bold mb-4">Trainings</h2>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Subtitle</th>
                    <th class="py-2 px-4 border-b">Video</th>
                    <th class="py-2 px-4 border-b"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 px-4 border-b">Submit declaration</td>
                    <td class="py-2 px-4 border-b">This video show basics about declation</td>
                    <td class="py-2 px-4 border-b"><a href="#" class="text-blue-500 hover:underline">click here</a></td>
                    <td class="py-2 px-4 border-b">
                        <button type="button"
                            class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-between items-center mt-4">
            <button class="px-4 py-2 text-gray-500 bg-gray-200 rounded">← Previous</button>
            <div class="flex space-x-2">
                <button class="px-4 py-2 text-gray-500 bg-gray-200 rounded">1</button>
                <button class="px-4 py-2 text-gray-500 bg-gray-200 rounded">2</button>
                <button class="px-4 py-2 text-gray-500 bg-gray-200 rounded">3</button>
                <button class="px-4 py-2 text-gray-500 bg-gray-200 rounded">...</button>
                <button class="px-4 py-2 text-gray-500 bg-gray-200 rounded">10</button>
            </div>
            <button class="px-4 py-2 text-gray-500 bg-gray-200 rounded">Next →</button>
        </div>
    </div>
</main>

@stop