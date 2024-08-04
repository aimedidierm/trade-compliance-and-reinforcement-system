@extends('layout')

@section('content')
<x-minicom-navbar />
<main class="container mx-auto py-8 px-6">
    <div class="card">
        <h2 class="text-lg font-bold mb-4">Documents management</h2>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Business name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Telephone</th>
                    <th class="py-2 px-4 border-b">Business TIN</th>
                    <th class="py-2 px-4 border-b">Document Detail</th>
                    <th class="py-2 px-4 border-b">Document File</th>
                    <th class="py-2 px-4 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 4; $i++) <tr>
                    <td class="py-2 px-4 border-b">karigirwa Rachel ltd</td>
                    <td class="py-2 px-4 border-b">kari@gmail.com</td>
                    <td class="py-2 px-4 border-b">0787343456</td>
                    <td class="py-2 px-4 border-b">Certificate</td>
                    <td class="py-2 px-4 border-b">3001#</td>
                    <td class="py-2 px-4 border-b"><a href="#" class="text-blue-500 hover:underline">document.pdf</a>
                    </td>
                    <td class="py-2 px-4 border-b"><span class="status-active">● Active</span></td>
                    </tr>
                    @endfor
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