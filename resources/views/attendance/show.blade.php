<x-app-layout>
    <x-slot name="title">
        {{ __('Attendance Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-bread-crumb-navigation />

            <div class="overflow-hidden bg-white rounded-lg shadow-xl">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full text-left border-collapse table-auto">
                        <thead>
                            <tr class="text-sm text-gray-600 bg-indigo-100">
                                <th class="px-6 py-4 border-b-2 border-gray-200">Student Name</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Check-in</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Check-out</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700">
                            @foreach ($bus->students as $student)
                                <tr class="border-b hover:bg-indigo-50">
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $student->user->name }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $student->busAttendance ? $student->busAttendance->first()->check_in : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $student->busAttendance ? $student->busAttendance->first()->check_out : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $student->busAttendance ? $student->busAttendance->first()->status : 'N/A' }}
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
