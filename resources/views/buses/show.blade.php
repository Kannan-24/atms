<x-app-layout>
    <x-slot name="title">
        {{ __('Bus Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64 ">
        <div class="w-full px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Bus Details Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold">Bus Details</h2>
                    <div class="flex justify-end gap-4">
                        @if (!$bus->facultyIncharge)
                            <a href="{{ route('buses.assignfacultyform', $bus->id) }}">
                                <button class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700">
                                    Assign Faculty
                                </button>
                            </a>
                        @else
                            <button class="px-4 py-2 text-gray-500 bg-gray-300 rounded cursor-not-allowed" disabled>
                                Faculty Assigned
                            </button>
                        @endif

                        @if ($bus->drivers->where('valid_to', null)->count() <= 0)
                            <a href="{{ route('buses.assigndriverform', $bus->id) }}">
                                <button class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                                    Assign Driver
                                </button>
                            </a>
                        @else
                            <button class="px-4 py-2 text-gray-500 bg-gray-300 rounded cursor-not-allowed" disabled>
                                Driver Assigned
                            </button>
                        @endif

                        @if (!$bus->route)
                            <a href="{{ route('buses.assignrouteform', $bus->id) }}">
                                <button class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-700">
                                    Assign Route
                                </button>
                            </a>
                        @else
                            <button class="px-4 py-2 text-gray-500 bg-gray-300 rounded cursor-not-allowed" disabled>
                                Route Assigned
                            </button>
                        @endif
                    </div>
                </div>
                <hr class="my-4">
                <table class="w-1/3 text-left mb-4">
                    <tr>
                        <th class="text-lg font-semibold">Bus Number</th>
                        <td>{{ $bus->number }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Number Plate</th>
                        <td>{{ $bus->number_plate }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Capacity</th>
                        <td>{{ $bus->no_of_seats }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Assigned Route</th>
                        <td>{{ $bus->route ? $bus->route->route_name : 'No route assigned' }}</td>
                    </tr>
                </table>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2">

                <!-- Bus Driver Details Container -->
                <div class="p-6 mt-6 bg-white border border-gray-200 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-semibold text-gray-800">Driver Details</h2>
                    <hr class="my-4">

                    <div class="bg-white rounded-2xl">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2">
                            @forelse ($bus->drivers ?? [] as $busDriver)
                                <div
                                    class="relative overflow-hidden bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-lg transition-transform transform hover:scale-105">
                                    <div class="p-6">
                                        <h3 class="text-lg font-semibold text-white">
                                            {{ $busDriver->driver->user->name }}
                                        </h3>
                                        <p class="text-sm text-gray-200"><strong>Phone:</strong>
                                            {{ $busDriver->driver->user->phone }}</p>
                                        <p class="text-sm text-gray-200"><strong>License:</strong>
                                            {{ $busDriver->driver->license }}</p>
                                        <p class="text-sm text-gray-200"><strong>Valid From:</strong>
                                            {{ $busDriver->valid_from }}</p>
                                        <p
                                            class="text-sm text-gray-200 {{ now() > $busDriver->valid_to ? 'text-red-400' : '' }}">
                                            <strong>Valid To:</strong> {{ $busDriver->valid_to }}
                                        </p>

                                        <div class="mt-4">
                                            @if ($busDriver->valid_to)
                                                <!-- Show Remove Driver Button -->
                                                <form action="{{ route('buses.removeDriver', $busDriver->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this driver?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full px-4 py-2 text-white bg-red-600 rounded-md shadow-md hover:bg-red-700 transition">
                                                        Remove
                                                    </button>
                                                </form>
                                            @else
                                                <!-- Show Update Validity Button -->
                                                <form action="{{ route('buses.updateDriverValidity', $busDriver->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="valid_to" value="{{ now() }}">
                                                    <button type="submit" class="w-full px-4 py-2 text-blue-600 bg-white rounded-md shadow-md hover:bg-gray-100 transition">
                                                        Update Validity
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="absolute top-0 right-0 p-3">
                                        <span
                                            class="inline-block px-3 py-1 text-xs font-semibold text-white bg-black bg-opacity-30 rounded-full">
                                            {{ $loop->iteration }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 bg-red-50 border border-red-200 rounded-lg shadow col-span-full">
                                    <p class="text-red-600 text-center">No driver assigned to this bus.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Faculty Incharge Details -->
                <div class="p-6 mt-6 bg-white border border-gray-200 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-semibold text-gray-800">Faculty Incharge</h2>
                    <hr class="my-4">

                    @if ($bus->facultyIncharge)
                        <div class="bg-white rounded-2xl">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-1">
                                <div
                                    class="relative overflow-hidden bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-lg transition-transform transform hover:scale-105">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-white">
                                            {{ $bus->facultyIncharge->faculty->user->name }}</h2>
                                        <p class="text-sm text-gray-200"><strong>Email:</strong>
                                            {{ $bus->facultyIncharge->faculty->user->email }}</p>
                                        <p class="text-sm text-gray-200"><strong>Phone:</strong>
                                            {{ $bus->facultyIncharge->faculty->user->phone }}</p>
                                        <p class="text-sm text-gray-200"><strong>TS ID:</strong>
                                            {{ $bus->facultyIncharge->faculty->ts_id }}</p>
                                        <p class="text-sm text-gray-200"><strong>Department:</strong>
                                            {{ $bus->facultyIncharge->faculty->department->dept_name }} -
                                            {{ $bus->facultyIncharge->faculty->department->dept_code }}</p>

                                        <!-- Remove Faculty Incharge Button -->
                                        <div class="mt-4">
                                            <form
                                                action="{{ route('buses.removeFacultyIncharge', $bus->facultyIncharge->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to remove this faculty incharge?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-50 px-4 py-2 text-white bg-red-600 rounded-md shadow-md hover:bg-red-700 transition">
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="absolute top-0 right-0 p-3">
                                        <span
                                            class="inline-block px-3 py-1 text-xs font-semibold text-white bg-black bg-opacity-30 rounded-full">
                                            1
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500">No faculty assigned to this bus yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
