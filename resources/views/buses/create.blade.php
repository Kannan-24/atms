<x-app-layout>
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Bus Registration Form -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('buses.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2 font-bold">Bus Number:</label>
                        <input type="text" name="bus_number" id="bus_number" class="w-full px-4 py-2 border rounded-lg"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-bold">Select Driver:</label>
                        <select name="driver" id="driver" class="w-full px-4 py-2 border rounded-lg" required>
                            <option value="">Select Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-bold">Starting Point:</label>
                        <input type="text" name="starting_point" id="starting_point"
                            class="w-full px-4 py-2 border rounded-lg" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                            Create Bus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
