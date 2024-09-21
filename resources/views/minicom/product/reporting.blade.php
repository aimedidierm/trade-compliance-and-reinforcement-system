@extends('layout')

@section('content')
<x-minicom-navbar />
<main class="container mx-auto py-8 px-6">
    <div class="flex justify-between items-center mb-4">
        <div class="text-xl font-semibold">Product Reporting</div>
    </div>
    <div class="flex gap-6 mb-8">

        <x-minicom-products-navbar />
    </div>
</main>
@stop