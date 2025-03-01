<x-app-layout>
    <x-slot name="title">
        {{ __('Bus Attendance') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">Bus Attendance Records</h2>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Bus Number</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Total Students</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buses as $bus)
                            <tr class="border border-gray-300">
                                <td class="border border-gray-300 px-4 py-2">{{ $bus->number }}</td>
                                {{-- <td class="border border-gray-300 px-4 py-2">{{ $bus->students->count() }}</td> --}}
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('attendance.show', $bus->id) }}"
                                       class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                                        View Attendance
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
