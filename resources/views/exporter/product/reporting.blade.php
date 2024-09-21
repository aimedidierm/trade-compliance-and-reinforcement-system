@extends('layout')

@section('content')

<x-exporter-navbar />

<main class="container mx-auto py-8 px-6">
    <div class="flex justify-between items-center mb-4">
        <div class="text-xl font-semibold">Reporting</div>
    </div>
    <div class="flex gap-6 mb-8">

        <x-exporter-products-navbar />
    </div>
</main>
@stop