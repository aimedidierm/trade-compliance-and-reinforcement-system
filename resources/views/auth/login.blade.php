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
        <p class="mt-6 text-gray-500">Don’t have an account? <a href="#"
                class="text-orange-500 hover:underline">Register
            </a></p>
        <br>
        <a href="/" class="text-orange-500 hover:underline">Back Home
        </a>
    </div>
</body>

</html>