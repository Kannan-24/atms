<x-app-layout>
    <x-slot name="title">
        Attendance Reports - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-bread-crumb-navigation />

            <div class="overflow-hidden bg-white rounded-lg shadow-xl p-6">
                <h2 class="text-xl font-semibold mb-4">Attendance Report</h2>

                <a href="{{ route('reports.pdf') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Download PDF
                </a>

                <table class="min-w-full mt-4 text-left border-collapse table-auto">
                    <thead>
                        <tr class="text-sm text-gray-600 bg-indigo-100">
                            <th class="px-6 py-4 border-b-2 border-gray-200">#</th>
                            <th class="px-6 py-4 border-b-2 border-gray-200">Student Name</th>
                            <th class="px-6 py-4 border-b-2 border-gray-200">Bus</th>
                            <th class="px-6 py-4 border-b-2 border-gray-200">Check-in</th>
                            <th class="px-6 py-4 border-b-2 border-gray-200">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        @foreach ($attendances as $attendance)
                            <tr class="border-b hover:bg-indigo-50">
                                <td class="px-6 py-4 border-b border-gray-200">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">{{ $attendance->studenta->user->name }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">{{ $attendance->bus->bus_number }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">{{ $attendance->check_in ?? 'N/A' }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">
                                    <span class="px-2 py-1 rounded 
                                        {{ $attendance->status === 'Present' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                        {{ $attendance->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
