@extends('layout')

@section('content')
<x-seller-navbar />
<br>
<h1 class="text-2xl font-semibold px-4">Rules & Regulations</h1>
<main class="flex">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold mb-4">Importing and Exporting</h1>
            <div class="space-y-4">
                {{-- <p class="font-bold">Find information on:</p>
                <ul class="list-disc list-inside space-y-1">
                    <li><a href="#" class="text-blue-500 underline">Electronic Single Window</a></li>
                    <li><a href="#" class="text-blue-500 underline">Import Procedures for Importation into Rwanda</a>
                    </li>
                    <li><a href="#" class="text-blue-500 underline">Customs clearance procedures
                            (http://rwanda.e-regulations.org/)</a></li>
                </ul> --}}

                <p class="font-bold">Procedures for importing goods into Rwanda include the following steps:</p>
                <ol class="list-decimal list-inside space-y-1">
                    <li>Obtain notice of arrival of the goods (“avis d’arrivée”)</li>
                    <li>Submit goods arrival notice for verification by Rwanda Standards Board</li>
                    <li>Obtain manifest</li>
                    <li>Submit import document to the clearing agent for tax calculation</li>
                    <li>Pay import tax</li>
                    <li>Obtain an invoice for warehouse handling fees</li>
                    <li>Pay warehouse fees for goods handling</li>
                    <li>Obtain goods exit note</li>
                </ol>

                {{-- <p>In addition to documented and physical verification at border posts, importing taxpayers may be
                    subject
                    to <a href="#" class="text-blue-500 underline">Post-Clearance Audits (PCA)</a>.</p> --}}
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md mt-8">
            <p class="font-bold">Importing and exporting goods:</p>
            <p class="mb-2">The buying and selling of goods across international borders.</p>

            <ul class="list-disc list-inside space-y-1">
                <li>Negotiating trade agreements: Diplomatic negotiations between countries to establish terms for
                    importing
                    and exporting goods.</li>
                <li>Customs clearance: Procedures required by governmental agencies to allow goods to enter or leave a
                    country.</li>
                <li>Logistics and transportation: Arranging the movement of goods from one location to another,
                    including
                    shipping, air freight, and trucking.</li>
                <li>Trade financing: Providing financing solutions to facilitate trade transactions, such as letters of
                    credit and trade finance loans.</li>
                <li>Tariff and duty management: Managing taxes and duties imposed on imported and exported goods.</li>
                <li>Trade compliance: Ensuring adherence to regulations and laws governing international trade,
                    including
                    export controls and sanctions.</li>
            </ul>
        </div>
    </div>
</main>
@stop