<x-app-layout>

    <x-slot name="title">
        {{ __('Assign Driver') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('buses.assignDriver', $bus->id) }}" method="POST">
                    @csrf

                    <!-- Driver Selection -->
                    <div class="mb-4">
                        <label for="driver_id" class="block text-sm font-semibold text-gray-700">Driver</label>
                        <select name="driver_id" id="driver_id"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required onchange="fetchDriverDetails(this.value)">
                            <option value="">Select a driver</option>
                            @foreach ($drivers as $driver)
                                @if ($driver->status === 'active')
                                    <option value="{{ $driver->id }}">{{ $driver->user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Driver Details -->
                    <div id="driver-details"
                        class="p-6 mt-3 bg-gradient-to-r from-gray-100 to-gray-200 border border-gray-300 rounded-lg shadow-lg hidden">
                        <h3 class="text-xl font-bold text-indigo-600">Driver Details</h3>
                        <div class="mt-2">
                            <p class="text-lg"><strong>Name:</strong> <span id="driver-name"
                                    class="text-gray-700"></span></p>
                            <p class="text-lg"><strong>Email:</strong> <span id="driver-email"
                                    class="text-gray-700"></span></p>
                            <p class="text-lg"><strong>Phone:</strong> <span id="driver-phone"
                                    class="text-gray-700"></span></p>
                            <p class="text-lg"><strong>License:</strong> <span id="driver-license"
                                    class="text-gray-700"></span></p>
                            <p class="text-lg"><strong>Address:</strong> <span id="driver-address"
                                    class="text-gray-700"></span></p>
                            <p class="text-lg"><strong>Status:</strong> <span id="driver-status"
                                    class="text-gray-700"></span></p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="px-4 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Assign Driver
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function fetchDriverDetails(driverId) {
            if (!driverId) {
                document.getElementById('driver-details').classList.add('hidden');
                return;
            }

            console.log("Fetching driver details for ID:", driverId); // Debugging Log

            fetch(`/drivers/assign/${driverId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Driver Data:", data); // Debugging Log

                    document.getElementById('driver-name').textContent = data.user.name;
                    document.getElementById('driver-email').textContent = data.user.email;
                    document.getElementById('driver-phone').textContent = data.user.phone;
                    document.getElementById('driver-license').textContent = data.license;
                    document.getElementById('driver-address').textContent = data.address;
                    document.getElementById('driver-status').textContent = data.status;

                    document.getElementById('driver-details').classList.remove('hidden');
                })
                .catch(error => console.error('Error fetching driver details:', error));
        }
    </script>


</x-app-layout>
