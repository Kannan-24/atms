<x-app-layout>

    <x-slot name="title">
        {{ __('Create Batch') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('batches.store') }}" method="POST">
                    @csrf

                    <!-- Start Year -->
                    <div class="mb-4">
                        <label for="start_year" class="block text-sm font-semibold text-gray-700">Start Year</label>
                        <input type="number" name="start_year" id="start_year"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- End Year -->
                    <div class="mb-4">
                        <label for="end_year" class="block text-sm font-semibold text-gray-700">End Year</label>
                        <input type="number" name="end_year" id="end_year"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Create Batch
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
