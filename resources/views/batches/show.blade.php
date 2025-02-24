<x-app-layout>
    <x-slot name="title">
        {{ __('Batch Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Batch Details Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Start Year:</h3>
                    <p>{{ $batch->start_year }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">End Year:</h3>
                    <p>{{ $batch->end_year }}</p>
                </div>
                <div class="flex justify-end gap-4">
                    <a href="{{ route('batches.edit', $batch->id) }}">
                        <button class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700">Edit</button>
                    </a>
                    <form action="{{ route('batches.destroy', $batch->id) }}" method="POST" class="inline">
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
