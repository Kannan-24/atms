<x-app-layout>
    <x-slot name="title">
        {{ __('Bus List') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <!-- Breadcrumb Navigation -->
            < x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('buses.update', $bus->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Bus Number -->
                    <div class="mb-5">
                        <label for="bus_number" class="block text-sm font-semibold text-gray-700">Bus Number</label>
                        <input type="text" name="bus_number" id="bus_number" value="{{ $bus->bus_number }}"
                            class="w-full transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter Bus Number" required>
                    </div>

                    <!-- Driver Selection -->
                    <div class="mb-5">
                        <label for="driver" class="block text-sm font-semibold text-gray-700">Select Driver</label>
                        <select name="driver" id="driver"
                            class="w-full transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">Select Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}" @if ($bus->driver->id == $driver->id) selected @endif>
                                    {{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Starting Point -->
                    <div class="mb-5">
                        <label for="starting_point" class="block text-sm font-semibold text-gray-700">Starting
                            Point</label>
                        <input type="text" name="starting_point" id="starting_point"
                            value="{{ $bus->starting_point }}"
                            class="w-full transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter Starting Point" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 mt-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                            Update Bus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
