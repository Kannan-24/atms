<x-app-layout>
    <x-slot name="title">
        {{ __('Create Bus Route') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            < x-bread-crumb-navigation />
            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('busRoutes.store') }}" method="POST">
                    @csrf

                    <!-- Route Name -->
                    <div class="mb-5">
                        <label for="route_name" class="block text-sm font-semibold text-gray-700">Route Name</label>
                        <input type="text" name="route_name" id="route_name"
                            class="w-full transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Start Point -->
                    <div class="mb-5">
                        <label for="start_point" class="block text-sm font-semibold text-gray-700">Start Point</label>
                        <input type="text" name="start_point" id="start_point"
                            class="w-full transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- End Point -->
                    <div class="mb-5">
                        <label for="end_point" class="block text-sm font-semibold text-gray-700">End Point</label>
                        <input type="text" name="end_point" id="end_point"
                            class="w-full transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Bus Selection -->
                    <div class="mb-5">
                        <label for="bus_id" class="block text-sm font-semibold text-gray-700">Bus</label>
                        <select name="bus_id" id="bus_id"
                            class="w-full transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">Select Bus</option>
                            @foreach ($buses as $bus)
                                <option value="{{ $bus->id }}">{{ $bus->bus_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                            Create Bus Route
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
