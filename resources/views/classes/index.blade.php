<x-app-layout>
    <x-slot name="title">
        {{ __('Class List') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-bread-crumb-navigation />

            <div class="bg-white rounded-2xl p-4">

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($classes as $class)
                        <div
                            class="relative overflow-hidden bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-lg transition-transform transform hover:scale-105">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-white">
                                    {{ $class->academicYearRoman }} - {{ strtoupper($class->department->dept_code) }} -
                                    {{ strtoupper($class->section) }}
                                </h2>
                                <div class="mt-4">
                                    <a href="{{ route('classes.show', $class->id) }}"
                                        class="inline-block px-4 py-2 text-sm font-medium text-blue-600 bg-white rounded-md shadow-md hover:bg-gray-100">
                                        View Details
                                    </a>
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
                <x-pagination :paginator="$classes" />
            </div>
        </div>
    </div>
</x-app-layout>
