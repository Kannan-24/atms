<x-app-layout>
    <x-slot name="title">
        Attendance Reports - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-bread-crumb-navigation />

            <div class="overflow-hidden bg-white rounded-lg shadow-xl p-6">
                <h2 class="text-xl font-semibold mb-4">Select a Bus to View Attendance Report</h2>

                <table class="min-w-full text-left border-collapse table-auto">
                    <thead>
                        <tr class="text-sm text-gray-600 bg-indigo-100">
                            <th class="px-6 py-4 border-b-2 border-gray-200">Bus Number</th>
                            <th class="px-6 py-4 border-b-2 border-gray-200">Route</th>
                            <th class="px-6 py-4 border-b-2 border-gray-200">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        @foreach ($buses as $bus)
                            <tr class="border-b hover:bg-indigo-50">
                                <td class="px-6 py-4 border-b border-gray-200">{{ $bus->number }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">{{ $bus->route->route_name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">
                                    <a href="{{ route('reports.bus.show', $bus->id) }}"
                                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                                        View Report
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
