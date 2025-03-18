<x-app-layout>

    <x-slot name="title">
        {{ __('Assign Route') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('buses.assignRoute', $bus->id) }}" method="POST">
                    @csrf

                    <!-- Route Selection -->
                    <div class="mb-4">
                        <label for="route_id" class="block text-sm font-semibold text-gray-700">Route</label>
                        <select name="route_id" id="route_id"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">Select a route</option>
                            @foreach ($routes as $route)
                                <option value="{{ $route->id }}">{{ $route->route_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="px-4 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Assign Route
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
