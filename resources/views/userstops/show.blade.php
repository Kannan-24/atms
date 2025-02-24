<x-app-layout>
    <x-slot name="title">
        {{ __('Stop Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Stop Details Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold">Stop Details</h2>
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('stops.edit', $stop->id) }}">
                            <button class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700">Edit</button>
                        </a>
                        <form action="{{ route('stops.destroy', $stop->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                            class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700">Delete</button>
                        </form>
                    </div>
                </div>
                <hr class="my-4">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Stop Name:</h3>
                    <p>{{ $stop->stop_name }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Latitude:</h3>
                    <p>{{ $stop->latitude }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Longitude:</h3>
                    <p>{{ $stop->longitude }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Status:</h3>
                    <p>{{ $stop->status }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
