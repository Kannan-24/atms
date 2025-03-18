<x-app-layout>
    <x-slot name="title">
        {{ __('Create Stop') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('stops.store') }}" method="POST">
                    @csrf

                    <!-- Stop Name -->
                    <div class="mb-4">
                        <label for="stop_name" class="block text-sm font-semibold text-gray-700">Stop Name</label>
                        <input type="text" name="stop_name" id="stop_name"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Latitude -->
                    <div class="mb-4">
                        <label for="latitude" class="block text-sm font-semibold text-gray-700">Latitude</label>
                        <input type="text" name="latitude" id="latitude"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Longitude -->
                    <div class="mb-4">
                        <label for="longitude" class="block text-sm font-semibold text-gray-700">Longitude</label>
                        <input type="text" name="longitude" id="longitude"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-semibold text-gray-700">Status</label>
                        <select name="status" id="status"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Create Stop
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
