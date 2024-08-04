<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risk Assessment Page Clone</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    @vite(['resources/css/app.css', 'resources/js/app.js']) <script src="https://cdn.jsdelivr.net/npm/chart.js">
    </script>
</head>

<body class="bg-gray-100 text-gray-800">
    <x-minicom-navbar />
    <main class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold">Risk assessment</h1><button
                class="bg-gray-200 p-2 rounded-full hover:bg-gray-300">Add new risk</button>
        </div>
        <p class="mt-2 text-gray-600">Based on the information gathered in this questionnaire and on the
            determined Investor Risk Profile score the client agrees to the following risk profile level for
            this assets held with the bank.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-8">
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-xl font-bold">Risk status</h2>
                <ul class="mt-4 space-y-2">
                    <li class="flex justify-between"><span>Overall</span><span>30</span></li>
                    <li class="flex justify-between"><span>Open</span><span>5</span></li>
                    <li class="flex justify-between"><span>In process</span><span>10</span></li>
                    <li class="flex justify-between"><span>Solved</span><span>15</span></li>
                </ul>
            </div>
            <div class="bg-white shadow rounded-lg p-4 col-span-2">
                <h2 class="text-xl font-bold">Total predictions last year</h2><canvas id="myChart"
                    class="mt-4"></canvas>
            </div>
        </div><br>
        <div class="card bg-white p-4">
            <div class="p-4">
                <h2 class="text-xl font-bold">Risks & prediction summary</h2>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Risk ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Risk category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Risk Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Risk Prediction</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Risk Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4">3001#</td>
                        <td class="px-6 py-4">OH&S</td>
                        <td class="px-6 py-4">Supporting</td>
                        <td class="px-6 py-4">Shoes primarily designed for sports or other forms of physical
                            exercise but which are also widely used for everyday casual wear</td>
                        <td class="px-6 py-4 text-green-600">Completed</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4">3001#</td>
                        <td class="px-6 py-4">OH&S</td>
                        <td class="px-6 py-4">Supporting</td>
                        <td class="px-6 py-4">Shoes primarily designed for sports or other forms of physical
                            exercise but which are also widely used for everyday casual wear</td>
                        <td class="px-6 py-4 text-yellow-600">Active risk</td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-between items-center mt-4"><button
                    class="px-4 py-2 text-gray-500 bg-gray-200 rounded">← Previous</button>
                <div class="flex space-x-2"><button
                        class="px-4 py-2 text-gray-500 bg-gray-200 rounded">1</button><button
                        class="px-4 py-2 text-gray-500 bg-gray-200 rounded">2</button><button
                        class="px-4 py-2 text-gray-500 bg-gray-200 rounded">3</button><button
                        class="px-4 py-2 text-gray-500 bg-gray-200 rounded">...</button><button
                        class="px-4 py-2 text-gray-500 bg-gray-200 rounded">10</button></div><button
                    class="px-4 py-2 text-gray-500 bg-gray-200 rounded">Next →</button>
            </div>
        </div>
    </main>
    <script>
        const ctx=document.getElementById('myChart').getContext('2d');

        const myChart=new Chart(ctx, {

            type: 'line',
            data: {

                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [ {
                    label: 'Total predictions',
                    data: [1000, 0, 2000, 1500, 2500, 2500, 3500, 2000, 4000, 4000, 3500, 3000],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.1
                }
                ]
            }
            ,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>