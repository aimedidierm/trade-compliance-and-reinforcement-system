<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trade complience and reinforcement system</title>
    <style>
        body {
            background-color: #f6f5f4;
        }
    </style>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="absolute top-8 left-8">
        <a href="/">
            <h1 class="text-3xl font-bold">TCARS</h1>
        </a>
    </div>
    <div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-md w-full mx-auto">
        <h2 class="text-2xl font-bold mb-4">Welcome back</h2>
        <p class="text-gray-500 mb-6">Enter details to log in and share link</p>
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
        @php session()->flush() @endphp
        @endif
        <form method="POST" action="/auth/login">
            @csrf
            <div class="mb-6">
                <input type="email" placeholder="Email" name="email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500">
            </div>
            <div class="mb-4">
                <input type="password" placeholder="Password" name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500">
            </div>
            <button
                class="bg-orange-500 text-white w-full py-2 rounded-lg hover:bg-orange-600 transition duration-300">Continue</button>
        </form>
        <p class="mt-6 text-gray-500">Don’t have an account? <a href="/register"
                class="text-orange-500 hover:underline">Register
            </a></p>
        <br>
        <a href="/" class="text-orange-500 hover:underline">Back Home
        </a>
    </div>
</body>

</html>