<header class="bg-white py-4 shadow">
    <div class="container mx-auto flex items-center justify-between px-6">
        <div class="text-2xl font-bold">TCARS</div>
        <div class="flex items-center">
            <nav class="flex space-x-4">
                {{-- <a href="/minicom"
                    class="flex breadcrumb-item {{ request()->is('minicom') ? 'text-orange-400' : 'text-gray-500' }}">
                    <span class="material-symbols-outlined">
                        dashboard
                    </span>
                    <span class="flex-1 ml-1 whitespace-nowrap">Home</span>
                </a> --}}
                <a href="/exporter/documents"
                    class="flex breadcrumb-item {{ request()->is('exporter/documents') ? 'text-orange-400' : 'text-gray-500' }}">
                    <span class="material-symbols-outlined">
                        receipt_long
                    </span>
                    <span class="flex-1 ml-1 whitespace-nowrap">Documents</span>
                </a>
                <a href="/exporter/training"
                    class="flex breadcrumb-item {{ request()->is('seller/training') ? 'text-orange-400' : 'text-gray-500' }}">
                    <span class="material-symbols-outlined">
                        videocam
                    </span>
                    <span class="flex-1 ml-1 whitespace-nowrap">Training</span>
                </a>
                <a href="/exporter/products"
                    class="flex breadcrumb-item {{ request()->is('exporter/products') || request()->is('exporter/products/reporting') || request()->is('exporter/products/declaration') ? 'text-orange-400' : 'text-gray-500' }}">
                    <span class="material-symbols-outlined">
                        package_2
                    </span>
                    <span class="flex-1 ml-1 whitespace-nowrap">Product</span>
                </a>
            </nav>
            <div class="ml-6 flex items-center space-x-4">
                <div id="notificationIcon" class="cursor-pointer p-2">
                    <span class="material-symbols-outlined">
                        notifications
                    </span>
                </div>
                <!-- Notification Panel -->
                <div id="notificationPanel"
                    class="hidden absolute right-0 mt-2 w-80 bg-white border rounded-lg shadow-lg z-50">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="flex justify-between items-center p-4 border-b">
                        <h3 class="text-lg font-semibold">Notifications</h3>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        <!-- Notification Items -->
                        <div class="p-4 border-b flex items-center">
                            <div class="text-sm">
                                <p class="font-semibold">Import & Export</p>
                                <p>God is God, all the time and we are here as children of God...</p>
                            </div>
                            <span class="text-xs text-gray-400 ml-auto">3min ago</span>
                        </div>
                        <!-- Repeat the above block for each notification -->
                    </div>
                </div>
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
                            <a href="/exporter/settings"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <a href="/auth/logout"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const notificationIcon = document.getElementById("notificationIcon");
        const notificationPanel = document.getElementById("notificationPanel");
        const notificationContainer = notificationPanel.querySelector(".max-h-96");
        
        // Function to format date as "YYYY-MM-DD HH:MM"
        function formatDateTime(dateString) {
            const date = new Date(dateString);
            const formatter = new Intl.DateTimeFormat('en-GB', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false // 24-hour format
            });
            const [{ value: day }, , { value: month }, , { value: year }] = formatter.formatToParts(date);
            const [{ value: hour }, , { value: minute }] = formatter.formatToParts(new Date(date.setMinutes(date.getMinutes() - date.getTimezoneOffset())));
            return `${year}-${month}-${day} ${hour}:${minute}`;
        }

        // Function to fetch notifications from an API endpoint
        async function fetchNotifications() {
            try {
                const response = await fetch("/notifications");
                if (!response.ok) {
                    throw new Error("Failed to fetch notifications");
                }
                const data = await response.json();
                
                // Clear existing notifications
                notificationContainer.innerHTML = '';
                
                // Populate notifications dynamically
                data.notifications.forEach(notification => {
                    const notificationItem = document.createElement("div");
                    notificationItem.classList.add("p-4", "border-b", "flex", "items-center");
                    
                    // Image or icon
                    const img = document.createElement("img");
                    img.src = "/images/message.png";
                    img.alt = "PDF";
                    img.classList.add("w-10", "h-10", "mr-3");
                    
                    // Notification content
                    const content = document.createElement("div");
                    content.classList.add("text-sm");
                    const title = document.createElement("p");
                    title.classList.add("font-semibold");
                    title.textContent = notification.title;
                    const message = document.createElement("p");
                    message.textContent = notification.message;
                    
                    // Time ago
                    const timeAgo = document.createElement("span");
                    timeAgo.classList.add("text-xs", "text-gray-400", "ml-auto");
                    timeAgo.textContent = formatDateTime(notification.created_at);
                    
                    content.appendChild(title);
                    content.appendChild(message);
                    notificationItem.appendChild(img);
                    notificationItem.appendChild(content);
                    notificationItem.appendChild(timeAgo);
                    
                    notificationContainer.appendChild(notificationItem);
                });
            } catch (error) {
                console.error("Error loading notifications:", error);
            }
        }
        
        // Show/hide the notification panel
        notificationIcon.addEventListener("click", async () => {
            if (notificationPanel.classList.contains("hidden")) {
                await fetchNotifications(); // Load notifications when opening the panel
                
                notificationPanel.classList.remove("hidden");
                notificationPanel.classList.add("opacity-0", "scale-95");
                
                setTimeout(() => {
                    notificationPanel.classList.remove("opacity-0", "scale-95");
                    notificationPanel.classList.add("opacity-100", "scale-100");
                }, 50);
            } else {
                notificationPanel.classList.add("opacity-0", "scale-95");
                
                setTimeout(() => {
                    notificationPanel.classList.add("hidden");
                    notificationPanel.classList.remove("opacity-100", "scale-100");
                }, 150);
            }
        });
        
        document.addEventListener("click", (event) => {
            if (!notificationIcon.contains(event.target) && !notificationPanel.contains(event.target)) {
                notificationPanel.classList.add("opacity-0", "scale-95");
                
                setTimeout(() => {
                    notificationPanel.classList.add("hidden");
                    notificationPanel.classList.remove("opacity-100", "scale-100");
                }, 150);
            }
        });
    });
</script>