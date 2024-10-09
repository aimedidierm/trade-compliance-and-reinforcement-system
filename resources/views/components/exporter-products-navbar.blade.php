<div class="card flex-1" style="flex: 0 0 30%;">
    <div class="sidebar flex flex-col">
        <a href="/exporter/products">
            <div
                class="menu-item p-4 {{ request()->is('exporter/products') ? 'bg-orange-400' : 'bg-white' }} rounded shadow-md hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600">
                <h2 class="text-lg font-bold">Shipment</h2>
            </div>
        </a>
    </div>
    <div class="sidebar flex flex-col bg-gray-100">
        <a href="/exporter/products/declaration">
            <div
                class="menu-item p-4 {{ request()->is('exporter/products/declaration') ? 'bg-orange-400' : 'bg-white' }} rounded shadow-md hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600">
                <h2 class="text-lg font-bold">Declaration</h2>
            </div>
        </a>
    </div>
    {{-- <div class="sidebar flex flex-col bg-gray-100">
        <a href="/exporter/products/reporting">
            <div
                class="menu-item p-4 {{ request()->is('exporter/products/reporting') ? 'bg-orange-400' : 'bg-white' }} rounded shadow-md hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600">
                <h2 class="text-lg font-bold">Reporting</h2>
            </div>
        </a>
    </div> --}}
</div>