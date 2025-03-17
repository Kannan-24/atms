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
                    <form action="{{ route('attendance.show', $bus->id) }}" method="GET">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-3">
                            <div class="flex flex-col md:flex-row md:items-center">
                                <label for="date" class="mr-2">Date:</label>
                                <input type="date" name="date" id="date" class="w-full md:w-48"
                                    value="{{ old('date', $date) ?? '' }}">
                            </div>
                            <div class="flex flex-col md:flex-row md:items-center">
                                <button type="submit"
                                    class="px-4 py-2 mt-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600">
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>
                    <table class="min-w-full text-left border-collapse table-auto">
                        <thead>
                            <tr class="text-sm text-gray-600 bg-indigo-100">
                                <th class="px-6 py-4 border-b-2 border-gray-200">#</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Student Name</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Check-in</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700">
                            @foreach ($attendance as $student)
                                <tr class="border-b {{ $rowClass }} !important">
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $student->user->name }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
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
