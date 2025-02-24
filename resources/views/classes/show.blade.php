<x-app-layout>
    <x-slot name="title">
        {{ __('Class Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Class Details Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-800">Class Details</h2>

                <div class="mb-4 mt-4">
                    <h3 class="text-lg font-semibold">Batch:</h3>
                    <p>
                        @if ($class->batch)
                            {{ $class->batch->start_year }} - {{ $class->batch->end_year }}
                        @else
                            <span class="text-red-500">No Batch Assigned</span>
                        @endif
                    </p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Department:</h3>
                    <p>{{ $class->department->dept_name }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Department Code:</h3>
                    <p>{{ $class->department->dept_code }}</p>
                </div>
                
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Year:</h3>
                    <p>{{ $class->academicYearRoman }}</p>
                </div>
                
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Section:</h3>
                    <p>{{ $class->section }}</p>
                </div>
                
                <div class="flex justify-end gap-4">
                    <a href="{{ route('classes.edit', $class->id) }}">
                        <button class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700">Edit</button>
                    </a>
                    <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
