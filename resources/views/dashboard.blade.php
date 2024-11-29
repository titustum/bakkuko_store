<x-app-layout>
    <div class="relative overflow-hidden bg-gradient-to-r from-indigo-900 to-purple-900">
        <div class="relative z-10 px-4 py-16 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl animate-fade-in">
                Admin Dashboard
            </h1>
            <p class="mt-4 text-xl text-indigo-200 animate-fade-in-delay">
                Manage your store's products, categories, and view analytics.
            </p>
        </div>
    </div>

    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 py-8">
        <!-- Analytics Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold text-indigo-600 mb-4">Items Per Category</h3>
                <div class="w-full h-72 sm:h-96">
                    <canvas id="itemsPerCategoryChart" class="w-full h-full"></canvas>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold text-indigo-600 mb-4">Best Selling Items</h3>
                <div class="w-full h-72 sm:h-96">
                    <canvas id="bestSellingItemsChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>

        <!-- Total Orders, Revenue, Products -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-xl font-semibold text-indigo-600">Total Orders</h4>
                <p class="text-3xl font-bold text-gray-800">{{ $totalOrders }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-xl font-semibold text-indigo-600">Total Revenue</h4>
                <p class="text-3xl font-bold text-gray-800">${{ number_format($totalRevenue, 2) }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h4 class="text-xl font-semibold text-indigo-600">Total Products</h4>
                <p class="text-3xl font-bold text-gray-800">{{ $totalProducts }}</p>
            </div>
        </div>

        <!-- Create New Product & Category -->
        <div class="mt-8">
            <h3 class="text-2xl font-semibold text-indigo-600 mb-4">Manage Products & Categories</h3>
            <div class="flex space-x-6">
                <!-- Link to create a new product -->
                <a href="{{ route('products.create') }}" class="inline-block bg-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-indigo-700 transition duration-200">
                    Create New Product
                </a>

                <!-- Link to create a new category -->
                <a href="{{ route('categories.create') }}" class="inline-block bg-purple-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-purple-700 transition duration-200">
                    Create New Category
                </a>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Function to generate random RGBA colors
        function generateRandomColors(numColors) {
            const colors = [];
            for (let i = 0; i < numColors; i++) {
                const randomColor = `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 0.6)`;
                colors.push(randomColor);
            }
            return colors;
        }

        // Items Per Category Pie Chart
        const itemsPerCategoryChart = document.getElementById('itemsPerCategoryChart').getContext('2d');
        const itemsPerCategoryData = {
            labels: @json($categoryLabels), // Category labels from controller
            datasets: [{
                label: 'Items Count',
                data: @json($categoryData), // Category data (item counts) from controller
                backgroundColor: generateRandomColors(@json($categoryData).length), // Random colors for each category
                borderColor: generateRandomColors(@json($categoryData).length), // Border colors
                borderWidth: 1,
            }]
        };

        new Chart(itemsPerCategoryChart, {
            type: 'pie',
            data: itemsPerCategoryData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' items';
                            }
                        }
                    }
                }
            }
        });

        // Best Selling Items Bar Chart
        const bestSellingItemsChart = document.getElementById('bestSellingItemsChart').getContext('2d');
        const bestSellingItemsData = {
            labels: @json($bestSellingItemsLabels), // Labels from controller (best-selling items)
            datasets: [{
                label: 'Units Sold',
                data: @json($bestSellingItemsData), // Data from controller (units sold)
                backgroundColor: generateRandomColors(@json($bestSellingItemsData).length), // Random colors for each bar
                borderColor: generateRandomColors(@json($bestSellingItemsData).length),
                borderWidth: 1,
            }]
        };

        new Chart(bestSellingItemsChart, {
            type: 'bar',
            data: bestSellingItemsData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' units sold';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
