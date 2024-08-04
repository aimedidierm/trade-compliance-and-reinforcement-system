@extends('layout')

@section('content')
<x-minicom-navbar />
<main class="container mx-auto py-8 px-6">
    <div class="flex justify-between items-center mb-4">
        <div class="text-xl font-semibold">Product Management</div>
        <div class="flex space-x-4">
            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded">Add new</button>
            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded">Download</button>
        </div>
    </div>
    <div class="flex gap-6 mb-8">

        <x-minicom-products-navbar />
        <div class="card">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Product name</th>
                        <th class="py-2 px-4 border-b">Product description</th>
                        <th class="py-2 px-4 border-b">Invoice</th>
                        <th class="py-2 px-4 border-b">Date</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Approved S-mark</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example row -->
                    <tr>
                        <td class="py-2 px-4 border-b">Nike shoes</td>
                        <td class="py-2 px-4 border-b">Shoes primarily designed for sports or other forms of physical
                            exercise but which are also widely used for everyday casual wear</td>
                        <td class="py-2 px-4 border-b">3001#</td>
                        <td class="py-2 px-4 border-b">10/3/2023</td>
                        <td class="py-2 px-4 border-b">10/3/2023</td>
                        <td class="py-2 px-4 border-b"><span class="text-green-500">✓ Applied</span></td>
                        <td class="py-2 px-4 border-b"><a href="#" class="text-blue-500 hover:underline">Image</a></td>
                    </tr>
                    <!-- Repeat as necessary -->
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
    </div>
</main>
@stop