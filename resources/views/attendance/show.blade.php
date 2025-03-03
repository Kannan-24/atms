<x-app-layout>
    <x-slot name="title">
        {{ __('Attendance Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">Attendance for Bus {{ $bus->bus_number }}</h2>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Student Name</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Check-in</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Check-out</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bus->students as $student)
                            <tr class="border border-gray-300">
                                <td class="border border-gray-300 px-4 py-2">{{ $student->user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $student->attendance ? $student->attendance->first()->check_in : 'N/A' }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $student->attendance ? $student->attendance->first()->check_out : 'N/A' }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $student->attendance ? $student->attendance->first()->status : 'N/A' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
