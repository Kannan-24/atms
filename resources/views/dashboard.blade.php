<x-app-layout>
    <x-slot name="title">
        {{ __('Dashboard') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="mt-20 ml-4 py-9 sm:ml-64 sm:me-4 lg:me-0">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">

            <!-- Welcome Section -->
            <div
                class="p-6 mb-6 text-center text-white rounded-lg shadow-lg bg-gradient-to-r from-blue-500 to-indigo-600">
                <h1 class="text-3xl font-bold">Welcome Back! 👋</h1>
                <p class="mt-2 text-lg">Hello, Admin! Here’s what’s happening in your system today.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Students Card -->
                <a href="{{ route('students.index') }}"
                    class="block h-full transition-all duration-200 bg-white border border-gray-200 rounded group hover:shadow-lg hover:border-blue-500 hover:ring-1 hover:ring-blue-500/20">
                    <div class="flex items-center p-6">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-16 h-16 transition-colors duration-200 rounded bg-blue-50 group-hover:bg-blue-100">
                            <span class="text-4xl" role="img" aria-label="Students">🎓</span>
                        </div>

                        <div class="flex-grow ml-6">
                            <h3
                                class="text-lg font-semibold text-gray-900 transition-colors duration-200 line-clamp-1 group-hover:text-blue-600">
                                Students
                            </h3>
                            <div class="inline-flex items-center mt-1">
                                <span class="text-gray-600 rounded">{{ $studentCount }} enrolled</span>
                            </div>
                        </div>

                        <div class="flex-shrink-0 ml-4">
                            <svg class="w-5 h-5 text-gray-400 transition-colors duration-200 group-hover:text-blue-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Faculty Card -->
                <a href="{{ route('faculty.index') }}"
                    class="block h-full transition-all duration-200 bg-white border border-gray-200 rounded group hover:shadow-lg hover:border-green-500 hover:ring-1 hover:ring-green-500/20">
                    <div class="flex items-center p-6">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-16 h-16 transition-colors duration-200 rounded bg-green-50 group-hover:bg-green-100">
                            <span class="text-4xl" role="img" aria-label="Faculty">🧑‍🏫</span>
                        </div>

                        <div class="flex-grow ml-6">
                            <h3
                                class="text-lg font-semibold text-gray-900 transition-colors duration-200 line-clamp-1 group-hover:text-green-600">
                                Faculty
                            </h3>
                            <div class="inline-flex items-center mt-1">
                                <span class="text-gray-600 rounded">{{ $facultyCount }} members</span>
                            </div>
                        </div>

                        <div class="flex-shrink-0 ml-4">
                            <svg class="w-5 h-5 text-gray-400 transition-colors duration-200 group-hover:text-green-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Buses Card -->
                <a href="{{ route('buses.index') }}"
                    class="block h-full transition-all duration-200 bg-white border border-gray-200 rounded group hover:shadow-lg hover:border-yellow-500 hover:ring-1 hover:ring-yellow-500/20">
                    <div class="flex items-center p-6">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-16 h-16 transition-colors duration-200 rounded bg-yellow-50 group-hover:bg-yellow-100">
                            <span class="text-4xl" role="img" aria-label="Buses">🚌</span>
                        </div>

                        <div class="flex-grow ml-6">
                            <h3
                                class="text-lg font-semibold text-gray-900 transition-colors duration-200 line-clamp-1 group-hover:text-yellow-600">
                                Buses
                            </h3>
                            <div class="inline-flex items-center mt-1">
                                <span class="text-gray-600 rounded">{{ $busCount }} available</span>
                            </div>
                        </div>

                        <div class="flex-shrink-0 ml-4">
                            <svg class="w-5 h-5 text-gray-400 transition-colors duration-200 group-hover:text-yellow-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Drivers Card -->
                <a href="{{ route('drivers.index') }}"
                    class="block h-full transition-all duration-200 bg-white border border-gray-200 rounded group hover:shadow-lg hover:border-red-500 hover:ring-1 hover:ring-red-500/20">
                    <div class="flex items-center p-6">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-16 h-16 transition-colors duration-200 rounded bg-red-50 group-hover:bg-red-100">
                            <span class="text-4xl" role="img" aria-label="Drivers">👨‍✈️</span>
                        </div>

                        <div class="flex-grow ml-6">
                            <h3
                                class="text-lg font-semibold text-gray-900 transition-colors duration-200 line-clamp-1 group-hover:text-red-600">
                                Drivers
                            </h3>
                            <div class="inline-flex items-center mt-1">
                                <span class="text-gray-600 rounded">{{ $driverCount }} on duty</span>
                            </div>
                        </div>

                        <div class="flex-shrink-0 ml-4">
                            <svg class="w-5 h-5 text-gray-400 transition-colors duration-200 group-hover:text-red-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>



            <!-- Graph Section -->
            <div class="p-6 mt-8 bg-white rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold text-gray-800">Statistics Overview 📊</h2>
                <div id="chart" class="mt-4"></div>
            </div>
        </div>
    </div>

    <!-- Include ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                series: [{
                    name: 'Count',
                    data: [
                        {{ json_decode($chartData)->students }},
                        {{ json_decode($chartData)->faculty }},
                        {{ json_decode($chartData)->buses }},
                        {{ json_decode($chartData)->drivers }}
                    ]
                }],
                xaxis: {
                    categories: ['Students', 'Faculty', 'Buses', 'Drivers']
                },
                colors: ['#1E40AF', '#10B981', '#F59E0B', '#EF4444']
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
</x-app-layout>
