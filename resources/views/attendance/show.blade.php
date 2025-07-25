<x-app-layout>
    <x-slot name="title">
        {{ __('Attendance Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-bread-crumb-navigation />

            <div class="overflow-hidden bg-white rounded-lg shadow-xl">
                <div class="p-6 overflow-x-auto">
                    <form action="{{ route('attendance.show', $bus->id) }}" method="GET" id="filterForm">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-3">
                            <div class="flex flex-col md:flex-row md:items-center">
                                <label for="date" class="mr-2">Date:</label>
                                <input type="date" name="date" id="date" class="w-full md:w-48"
                                    value="{{ old('date', $date) ?? '' }}" onchange="document.getElementById('filterForm').submit();">
                            </div>
                            <div class="flex flex-col md:flex-row md:items-center">
                                <label for="towards_college" class="mr-2">Time:</label>
                                <select name="towards_college" id="towards_college" class="w-full md:w-48" onchange="document.getElementById('filterForm').submit();">
                                    <option value="1"
                                        {{ old('towards_college', $towards_college) == 1 ? 'selected' : '' }}>Morning
                                    </option>
                                    <option value="0"
                                        {{ old('towards_college', $towards_college) == 0 ? 'selected' : '' }}>Evening
                                    </option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <table class="min-w-full text-left border-collapse table-auto">
                        <thead>
                            <tr class="text-sm text-gray-600 bg-indigo-100">
                                <th class="px-6 py-4 border-b-2 border-gray-200">#</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Student Name</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Check-in</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Check-in Stop</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Check-out</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Check-out Stop</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700">
                            @foreach ($attendance as $student)
                                <tr class="border-b !important">
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $student->student->name }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $student->check_in }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $student->check_in_stop_id }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $student->check_out }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $student->check_out_stop_id }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $student->check_in != null || $student->check_out != null ? 'Present' : 'Absent' }}
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
