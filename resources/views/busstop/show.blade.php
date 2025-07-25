<x-app-layout>
    <x-slot name="title">
        {{ __('Bus Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <!-- Breadcrumb Navigation -->
            < x-bread-crumb-navigation />


            <!-- Bus Details Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Bus Number:</h3>
                    <p>{{ $bus->bus_number }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Driver Name:</h3>
                    <p>{{ $bus->driver ? $bus->driver->name : '' }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Driver Phone:</h3>
                    <p>{{ $bus->driver ? $bus->driver->phone : '' }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Starting Point:</h3>
                    <p>{{ $bus->starting_point }}</p>
                </div>
                <div class="flex justify-end gap-4">
                    <a href="{{ route('buses.edit', $bus->id) }}">
                        <button class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700">Edit</button>
                    </a>
                    <form action="{{ route('buses.destroy', $bus->id) }}" method="POST" class="inline">
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
