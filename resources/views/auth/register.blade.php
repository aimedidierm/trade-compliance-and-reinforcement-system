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
        <h1 class="text-3xl font-bold">LOGO</h1>
    </div>
    <div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-md w-full mx-auto">
        <h2 class="text-2xl font-bold mb-4">Create Account</h2>
        <p class="text-gray-500 mb-6">give business visibility, start now.</p>
        <form>
            <div class="mb-4">
                <input type="text" placeholder="Name of the business"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500">
            </div>
            <div class="mb-4">
                <input type="text" placeholder="Telephone number"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500">
            </div>
            <div class="mb-4">
                <input type="text" placeholder="User name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500">
            </div>
            <div class="mb-6">
                <input type="email" placeholder="Email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500">
            </div>
            <button
                class="bg-orange-500 text-white w-full py-2 rounded-lg hover:bg-orange-600 transition duration-300">Continue</button>
        </form>
        <p class="mt-6 text-gray-500">Already have an account? <a href="#" class="text-orange-500 hover:underline">Sign
                In</a></p>
    </div>
</body>

</html>