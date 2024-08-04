@extends('layout')

@section('content')
@if (Auth::user()->role == \App\Enums\UserRole::EXPORTER->value)
<x-exporter-navbar />
@elseif(Auth::user()->role == \App\Enums\UserRole::MINICOM->value)
<x-minicom-navbar />
@else
<x-seller-navbar />
@endif

<main class="flex">
    <div class="w-1/4 bg-gray-100 dark:bg-gray-800 p-4 space-y-4">
    </div>

    <div class="w-3/4 p-6">
        <section id="change-password" class="mb-8">
            <h2 class="text-lg font-bold mb-4">Change Password</h2>
            <form action="#" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="current_password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Password</label>
                    <input type="password" id="current_password" name="current_password"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                        required>
                </div>
                <div class="mb-4">
                    <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">New
                        Password</label>
                    <input type="password" id="new_password" name="new_password"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                        required>
                </div>
                <div class="mb-4">
                    <label for="new_password_confirmation"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm New Password</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                        required>
                </div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800">Update
                    Password</button>
            </form>
        </section>
    </div>
</main>
@stop