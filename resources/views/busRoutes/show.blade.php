<x-app-layout>
    <x-slot name="title">
        {{ __('Bus Route Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Bus Route Details Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold">Bus Route Details</h2>
                    <div class="flex justify-end gap-4">
                        <!-- Assign or Update Stops Button -->
                        <a href="{{ route('busroutes.assignStops', $busroute->id) }}">
                            <button
                                class="px-4 py-2 text-white rounded 
        {{ $busroute->stops->isEmpty() ? 'bg-blue-500 hover:bg-blue-700' : 'bg-yellow-500 hover:bg-yellow-700' }}">
                                {{ $busroute->stops->isEmpty() ? 'Assign Stops' : 'Update Stops' }}
                            </button>
                        </a>
                        <a href="{{ route('busroutes.edit', $busroute->id) }}">
                            <button class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700">Edit</button>
                        </a>
                        <form action="{{ route('busroutes.destroy', $busroute->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700">Delete</button>
                        </form>
                    </div>
                </div>
                <hr class="my-4">
                <table class="w-2/5 text-left">
                    <tr>
                        <th class="text-lg font-semibold">Route Name</th>
                        <td>{{ $busroute->route_name }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Start Location</th>
                        <td>{{ $busroute->start_location }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">End Location</th>
                        <td>{{ $busroute->end_location }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Total Distance (km)</th>
                        <td>{{ $busroute->total_distance }}</td>
                    </tr>
                </table>

                <!-- Assigned Stops Section -->
                <div class="mt-6">
                    <h3 class="text-xl font-semibold">Assigned Stops</h3>
                    <ol class="mt-2 list-decimal list-inside">
                        @forelse ($busroute->stops as $stop)
                            <li>{{ $stop->stop_name }}</li>
                        @empty
                            <li class="text-gray-500">No stops assigned yet.</li>
                        @endforelse
                    </ol>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
