<x-app-layout>
    <x-slot name="title">
        {{ __('Edit Bus Route') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />
            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('busroutes.update', $busroute->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Route Name -->
                    <div class="mb-5">
                        <label for="route_name" class="block text-sm font-semibold text-gray-700">Route Name</label>
                        <input type="text" name="route_name" id="route_name" value="{{ $busroute->route_name }}"
                            class="w-full transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Start Location -->
                    <div class="mb-5">
                        <label for="start_location" class="block text-sm font-semibold text-gray-700">Start Location</label>
                        <input type="text" name="start_location" id="start_location" value="{{ $busroute->start_location }}"
                            class="w-full transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- End Location -->
                    <div class="mb-5">
                        <label for="end_location" class="block text-sm font-semibold text-gray-700">End Location</label>
                        <input type="text" name="end_location" id="end_location" value="{{ $busroute->end_location }}"
                            class="w-full transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Total Distance -->
                    <div class="mb-5">
                        <label for="total_distance" class="block text-sm font-semibold text-gray-700">Total Distance (km)</label>
                        <input type="number" name="total_distance" id="total_distance" value="{{ $busroute->total_distance }}"
                            class="w-full transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-between">
                        <a href="{{ route('busroutes.index') }}" class="px-4 py-2 text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600">
                            Update Bus Route
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>