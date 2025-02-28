<x-app-layout>
    <x-slot name="title">
        {{ __('Assign Stops') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">Assign Stops to {{ $route->route_name }}</h2>

                <form action="{{ route('busroutes.storeAssignedStops', $route->id) }}" method="POST">
                    @csrf

                    <!-- Stops Selection with Checkboxes -->
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Select Stops:</label>

                        <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 max-h-60 overflow-y-auto">
                            @foreach ($stops as $stop)
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" name="stop_ids[]" value="{{ $stop->id }}"
                                        class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                        {{ $route->stops->contains($stop->id) ? 'checked' : '' }}>
                                    <span class="ml-3 text-gray-800">{{ $stop->stop_name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="px-6 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Assign Stops
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
