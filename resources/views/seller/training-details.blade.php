<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">
    <div class="w-full max-w-2xl bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Video Container -->
        <div class="relative pb-[56.25%]">
            <!-- 16:9 Aspect Ratio -->
            <video class="absolute inset-0 w-full h-full object-cover" controls>
                <source src="{{$src}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <!-- Video Description -->
        <div class="p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-2">Sample Video Title</h1>
            <p class="text-gray-600">
                This is a description of the video. It provides additional information about the
                content of the video to give viewers a better idea of what they are about to watch.
            </p>
        </div>
    </div>
</body>

</html>