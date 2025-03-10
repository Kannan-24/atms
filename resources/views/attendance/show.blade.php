<x-app-layout>
    <x-slot name="title">
        {{ __('Attendance Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-bread-crumb-navigation />

            <div class="overflow-hidden bg-white rounded-lg shadow-xl">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full text-left border-collapse table-auto">
                        <thead>
                            <tr class="text-sm text-gray-600 bg-indigo-100">
                                <th class="px-6 py-4 border-b-2 border-gray-200">#</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Student Name</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Check-in (To College)</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Check-out (To College)</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Check-in (Back Home)</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Check-out (Back Home)</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700">
                            @foreach ($bus->students as $student)
                                @php
                                    $busAttendance = $student->busAttendance ? $student->busAttendance->first() : null;
                                    $status = $busAttendance ? $busAttendance->status : 'N/A';
                                    $rowClass = $status === 'Absent' ? 'bg-red-200 text-red-800' : ($status === 'Present' ? 'bg-green-200 text-green-800' : '');
                                @endphp
                                <tr class="border-b {{ $rowClass }}">
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $student->user->name }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $busAttendance ? $busAttendance->check_in_college : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $busAttendance ? $busAttendance->check_out_college : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $busAttendance ? $busAttendance->check_in_home : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $busAttendance ? $busAttendance->check_out_home : 'N/A' }}
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
    </div>
</x-app-layout>
