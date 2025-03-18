<x-app-layout>
    <x-slot name="title">
        {{ __('Bus Attendance') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-bread-crumb-navigation />

            <div class="bg-white p-4 rounded-2xl">

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($buses as $bus)
                        <div
                            class="relative overflow-hidden bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-lg transition-transform transform hover:scale-105">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-white">Bus Number: {{ $bus->number }}</h2>
                                <p class="text-white">Total Students: {{ $bus->students ? $bus->students->count() : 0 }}
                                </p>
                                <div class="mt-4">
                                    <a href="{{ route('attendance.show', $bus->id) }}"
                                        class="inline-block px-4 py-2 text-sm font-medium text-blue-600 bg-white rounded-md shadow-md hover:bg-gray-100">
                                        View Attendance
                                    </a>
                                    {{-- <a href="{{ route('attendance.create', $bus) }}" 
                                    class="inline-block px-4 py-2 text-sm font-medium text-green-600 bg-white rounded-md shadow-md hover:bg-gray-100">
                                    Put Attendance
                                </a> --}}
                                </div>
                            </div>
                            <div class="absolute top-0 right-0 p-3">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-semibold text-white bg-black bg-opacity-30 rounded-full">
                                    {{ $loop->iteration }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <x-pagination :paginator="$buses" />
            </div>
        </div>
    </div>

</x-app-layout>
