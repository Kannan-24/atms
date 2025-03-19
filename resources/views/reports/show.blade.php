<x-app-layout>
    <x-slot name="title">
        Attendance Report - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="py-6 ml-4 sm:ml-64">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-bread-crumb-navigation />

            <div class="overflow-hidden bg-white rounded-lg shadow-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Attendance Report for Bus {{ $bus->number }} ({{ $date }})</h2>
                    <a href="{{ route('reports.bus.pdf', ['busId' => $bus->id, 'date' => $date, 'time_slot' => $timeSlot]) }}"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Download PDF
                    </a>
                </div>

                <table class="min-w-full mt-4 text-left border-collapse table-auto">
                    <thead>
                        <tr class="text-sm text-gray-600 bg-indigo-100">
                            <th class="px-6 py-4 border-b-2 border-gray-200">#</th>
                            <th class="px-6 py-4 border-b-2 border-gray-200">Student Name</th>
                            <th class="px-6 py-4 border-b-2 border-gray-200">Check-in</th>
                            <th class="px-6 py-4 border-b-2 border-gray-200">Check-out</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        @foreach ($attendanceRecords as $record)
                            <tr class="border-b hover:bg-indigo-50">
                                <td class="px-6 py-4 border-b border-gray-200">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">{{ $record->student->name }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">{{ $record->check_in ?? 'N/A' }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">{{ $record->check_out ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
