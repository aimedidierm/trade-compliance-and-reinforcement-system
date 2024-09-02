@extends('layout')

@section('content')

<x-exporter-navbar />


<main class="container mx-auto py-8 px-6">
    <div class="card">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold mb-4">Trainings</h2>
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Description</th>
                    <th class="py-2 px-4 border-b">Video</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trainings as $training)
                <tr>
                    <td class="py-2 px-4 border-b">{{$training->title}}</td>
                    <td class="py-2 px-4 border-b">{{$training->description}}</td>
                    <td class="py-2 px-4 border-b"><a href="/exporter/training-details/{{$training->id}}"
                            class="text-blue-500 hover:underline">click here</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-between items-center mt-4">
            @if ($trainings->onFirstPage())
            <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">← Previous</span>
            @else
            <a href="{{ $trainings->previousPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">←
                Previous</a>
            @endif

            <div class="flex space-x-2">
                @foreach ($trainings->links()->elements as $element)
                @if (is_string($element))
                <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $element }}</span>
                @endif

                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $trainings->currentPage())
                <span class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $page }}</span>
                @else
                <a href="{{ $url }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">{{ $page }}</a>
                @endif
                @endforeach
                @endif
                @endforeach
            </div>

            @if ($trainings->hasMorePages())
            <a href="{{ $trainings->nextPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded">Next →</a>
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