<x-app-layout>
    <x-slot name="title">
        {{ __('Bus Route Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Bus Route Details Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold"> Bus Route Details</h2>
                    <div class="flex justify-end gap-4">
                    <a href="{{ route('busroutes.edit', $busroute->id) }}">
                        <button class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700">Edit</button>
                    </a>
                    <form action="{{ route('busroutes.destroy', $busroute->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700">Delete</button>
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
            </div>
        </div>
    </div>
</x-app-layout>
