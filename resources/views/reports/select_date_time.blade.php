<x-app-layout>
    <x-slot name="title">
        Select Date & Time for Report - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="py-6 ml-4 sm:ml-64">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-bread-crumb-navigation />

            <div class="overflow-hidden bg-white rounded-lg shadow-xl p-6">
                <h2 class="text-xl font-semibold mb-4">Generate Report for Bus {{ $bus->number }}</h2>

                <form action="{{ route('reports.bus.generate', $bus->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="date" class="block text-gray-700 font-medium">Select Date:</label>
                        <input type="date" name="date" id="date" required class="border rounded p-2 w-full">
                    </div>

                    <div class="mb-4">
                        <label for="time_slot" class="block text-gray-700 font-medium">Select Time Slot:</label>
                        <select name="time_slot" id="time_slot" required class="border rounded p-2 w-full">
                            <option value="1">Morning</option>
                            <option value="0">Evening</option>
                            <option value="2">Both Morning & Evening</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Generate Report
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
