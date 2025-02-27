<x-app-layout>
    <x-slot name="title">
        {{ __('Faculty Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Faculty Details Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold">Faculty Details</h2>
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('faculty.edit', $faculty->id) }}">
                            <button class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700">Edit</button>
                        </a>
                        <form action="{{ route('faculty.destroy', $faculty->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700">Delete</button>
                        </form>
                    </div>
                </div>
                <hr class="my-4">

                <table class="w-2/4 text-left">
                    <tr>
                        <th class="text-lg font-semibold">Name</th>
                        <td>{{ $faculty->user->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Email</th>
                        <td>{{ $faculty->user->email }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Faculty ID</th>
                        <td>{{ $faculty->ts_id }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Phone</th>
                        <td>{{ $faculty->user->phone }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Date of Birth</th>
                        <td>{{ $faculty->dob }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Blood Group</th>
                        <td>{{ $faculty->blood_group }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Address</th>
                        <td class="w-3/5">{{ $faculty->address }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Department</th>
                        <td>{{ $faculty->department->dept_name }} - {{ $faculty->department->dept_code }}</td>
                    </tr>
                </table>

                <!-- Bus Details Section -->
                @if (!empty($faculty->busIncharge) && $faculty->busIncharge->isNotEmpty())
                    <hr class="my-4">
                    <h3 class="text-2xl font-semibold text-gray-800">Other Details</h3>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2 mt-4">
                        @foreach ($faculty->busIncharge as $incharge)
                            <!-- Bus Details Card -->
                            <a href="{{ route('buses.show', $incharge->bus->id) }}">
                                <div
                                    class="relative overflow-hidden bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-lg transition-transform transform hover:scale-105">
                                    <div class="p-6">
                                        <p class="text-lg font-semibold text-white">Bus Number:
                                            {{ $incharge->bus->number }}</p>
                                        <p class="text-sm text-gray-200"><strong>Number Plate:</strong>
                                            {{ $incharge->bus->number_plate }}</p>
                                        <p class="text-sm text-gray-200"><strong>Capacity:</strong>
                                            {{ $incharge->bus->no_of_seats }} Seats</p>
                                    </div>
                                    <div class="absolute top-0 right-0 p-3">
                                        <span
                                            class="inline-block px-3 py-1 text-xs font-semibold text-white bg-black bg-opacity-30 rounded-full">
                                            Bus
                                        </span>
                                    </div>
                                </div>
                            </a>

                            <!-- Bus Driver Details Card -->
                            @if (!empty($incharge->bus->busDriver) && !empty($incharge->bus->busDriver->driver))
                                <a href="{{ route('drivers.show', $incharge->bus->busDriver->driver->id) }}">
                                    <div
                                        class="relative overflow-hidden bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-lg transition-transform transform hover:scale-105">
                                        <div class="p-6">
                                            <p class="text-lg font-semibold text-white">Name:
                                                {{ $incharge->bus->busDriver->driver->user->name }}</p>
                                            <p class="text-sm text-gray-200"><strong>Phone:</strong>
                                                {{ $incharge->bus->busDriver->driver->user->phone }}</p>
                                            <p class="text-sm text-gray-200"><strong>License Number:</strong>
                                                {{ $incharge->bus->busDriver->driver->license }}</p>
                                        </div>
                                        <div class="absolute top-0 right-0 p-3">
                                            <span
                                                class="inline-block px-3 py-1 text-xs font-semibold text-white bg-black bg-opacity-30 rounded-full">
                                                Driver
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <div class=" align-center bg-red-200 border border-gray-200 rounded-lg shadow-lg p-4">
                                    <p class="text-center p-7">No driver assigned for this bus.</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif


            </div>

        </div>
    </div>
</x-app-layout>
