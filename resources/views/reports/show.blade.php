<x-app-layout>
    <x-slot name="title">
        Bus Attendance Report - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-bread-crumb-navigation />

            <div class="overflow-hidden bg-white rounded-lg shadow-xl p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold mb-4">Attendance Report - Bus {{ $bus->number }}</h2>
                    <a href="{{ route('reports.bus.pdf', $bus->id) }}"
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
                            <th class="px-6 py-4 border-b-2 border-gray-200">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        @foreach ($bus->students as $student)
                            @php
                                $busAttendance = $student->busAttendance ? $student->busAttendance->first() : null;
                                $status = $busAttendance ? $busAttendance->status : 'N/A';
                            @endphp
                            <tr class="border-b hover:bg-indigo-50">
                                <td class="px-6 py-4 border-b border-gray-200">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">{{ $student->user->name }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">
                                    {{ $busAttendance ? $busAttendance->check_in : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 border-b border-gray-200">
                                    {{ $status }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
