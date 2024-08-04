@extends('layout')

@section('content')
<x-minicom-navbar />
<main class="container mx-auto py-8 px-6">
    <div class="flex gap-6 mb-8">
        <div class="card flex-1" style="flex: 0 0 30%;">
            <div class="sidebar flex flex-col bg-gray-100">
                <a href="/minicom/users">
                    <div
                        class="menu-item p-4 bg-white rounded shadow-md hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600">
                        <h2 class="text-lg font-bold">Exporters</h2>
                    </div>
                </a>
            </div>
            <div class="sidebar flex flex-col bg-gray-100">
                <a href="/minicom/users/sellers">
                    <div
                        class="menu-item p-4 bg-orange-400 rounded shadow-md hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600">
                        <h2 class="text-lg font-bold">Sellers</h2>
                    </div>
                </a>
            </div>
        </div>

        <div class="card flex-1" style="flex: 0 0 68%;">
            <h2 class="text-lg font-bold mb-4">Sellers management</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Names</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)<tr>
                        <td class="py-2 px-4 border-b">{{$user->name}}</td>
                        <td class="py-2 px-4 border-b">{{$user->email}}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($user->status == \App\Enums\UserStatus::APPROVED->value)
                            <span class="status-active">● Active</span>
                            @elseif($user->status == \App\Enums\UserStatus::PENDING->value)
                            <span class="text-yellow-400">● Pending</span>
                            @else
                            <span class="text-red-600">● Rejected</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">
                            <button type="button"
                                class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
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