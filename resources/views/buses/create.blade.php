<x-app-layout>

    <x-slot name="title">
        {{ __('Create Bus') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('buses.store') }}" method="POST">
                    @csrf

                    <!-- Bus Number -->
                    <div class="mb-4">
                        <label for="number" class="block text-sm font-semibold text-gray-700">Bus Number</label>
                        <input type="text" name="number" id="number"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Number Plate -->
                    <div class="mb-4">
                        <label for="number_plate" class="block text-sm font-semibold text-gray-700">Number Plate</label>
                        <input type="text" name="number_plate" id="number_plate"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Number of Seats -->
                    <div class="mb-4">
                        <label for="no_of_seats" class="block text-sm font-semibold text-gray-700">Number of
                            Seats</label>
                        <input type="number" name="no_of_seats" id="no_of_seats"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Create Bus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
