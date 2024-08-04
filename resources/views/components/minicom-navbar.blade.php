<header class="bg-white py-4 shadow">
    <div class="container mx-auto flex items-center justify-between px-6">
        <div class="text-2xl font-bold">TCARS</div>
        <div class="flex items-center">
            <nav class="flex space-x-4">
                <a href="/minicom"
                    class="flex breadcrumb-item {{ request()->is('minicom') ? 'text-orange-400' : 'text-gray-500' }}">
                    <span class="material-symbols-outlined">
                        dashboard
                    </span>
                    <span class="flex-1 ml-1 whitespace-nowrap">Home</span>
                </a>
                <a href="/minicom/documents"
                    class="flex breadcrumb-item {{ request()->is('minicom/documents') ? 'text-orange-400' : 'text-gray-500' }}">
                    <span class="material-symbols-outlined">
                        receipt_long
                    </span>
                    <span class="flex-1 ml-1 whitespace-nowrap">Documents</span>
                </a>
                <a href="/minicom/users"
                    class="flex breadcrumb-item {{ request()->is('minicom/users') || request()->is('minicom/users/sellers') ? 'text-orange-400' : 'text-gray-500' }}">
                    <span class="material-symbols-outlined">
                        group
                    </span>
                    <span class="flex-1 ml-1 whitespace-nowrap">Users</span>
                </a>
                <a href="/minicom/training"
                    class="flex breadcrumb-item {{ request()->is('minicom/training') ? 'text-orange-400' : 'text-gray-500' }}">
                    <span class="material-symbols-outlined">
                        videocam
                    </span>
                    <span class="flex-1 ml-1 whitespace-nowrap">Training</span>
                </a>
                <a href="/minicom/products"
                    class="flex breadcrumb-item {{ request()->is('minicom/products') || request()->is('minicom/products/reporting') || request()->is('minicom/products/declaration') ? 'text-orange-400' : 'text-gray-500' }}">
                    <span class="material-symbols-outlined">
                        package_2
                    </span>
                    <span class="flex-1 ml-1 whitespace-nowrap">Product</span>
                </a>
            </nav>
            <div class="ml-6 flex items-center space-x-4">
                <a href="/minicom/notifications">
                    <span class="material-symbols-outlined">
                        notifications
                    </span>
                </a>
                <div class="text-gray-500">{{Auth::user()->name}}</div>
                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </button>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">{{Auth::user()->name}}</span>
                        <span
                            class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{Auth::user()->email}}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="/minicom/settings"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <a href="/auth/logout'"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>