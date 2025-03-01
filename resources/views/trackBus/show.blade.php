<x-app-layout>
    <x-slot name="title">
        {{ __('Track Bus') }} - {{ $bus->number }}
    </x-slot>

    <div class="mt-20 ml-4 py-9 sm:ml-64 sm:me-4 lg:me-0">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="mb-6">
                <nav class="flex items-center justify-between p-4 bg-white rounded-lg shadow-md">
                    <ol class="inline-flex items-center space-x-2">
                        <li>
                            <a href="{{ route('dashboard') }}" class="font-medium text-blue-800 hover:text-blue-900">
                                Dashboard
                            </a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mx-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            <a href="{{ route('track-buses.index') }}" class="font-medium text-blue-800 hover:text-blue-900">
                                Track Bus
                            </a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mx-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            <span class="font-semibold text-blue-900 capitalize">Bus {{ $bus->number }}</span>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Bus Details Section -->
            <div class="p-6 mb-6 rounded-lg shadow-md bg-white">
                <h2 class="text-xl font-semibold text-blue-900 ">Bus Details</h2>
                <table class="w-1/3 text-left">
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 text-gray-600">Bus Number:</td>
                            <td class="py-2 px-4 text-lg font-semibold text-blue-900">{{ $bus->number }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 text-gray-600">Plate Number:</td>
                            <td class="py-2 px-4 text-lg font-semibold text-blue-900">{{ $bus->number_plate }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 text-gray-600">Capacity:</td>
                            <td class="py-2 px-4 text-lg font-semibold text-blue-900">{{ $bus->no_of_seats }}</td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="text-xl font-semibold text-blue-900 mt-2 ">Driver Details</h2>
                <table class="w-1/3 text-left">
                    <tbody>
                        @if($bus->busDriver)
                            <tr>
                                <td class="py-2 px-4 text-gray-600">Driver Name:</td>
                                <td class="py-2 px-4 text-lg font-semibold text-blue-900">{{ $bus->busDriver->driver->user->name }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 text-gray-600">Driver Phone:</td>
                                <td class="py-2 px-4 text-lg font-semibold text-blue-900">{{ $bus->busDriver->driver->user->phone }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="2" class="py-2 px-4">
                                    <div class="p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded-lg" role="alert">
                                        <p class="font-bold">Notice</p>
                                        <p>Driver is not assigned</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <h2 class="text-xl font-semibold text-blue-900 mt-2">Bus Incharge Details</h2>
                <table class="w-1/3 text-left">
                    <tbody>
                        @if($bus->busIncharge)
                            @foreach($bus->busIncharge as $incharge)
                                <tr>
                                    <td class="py-2 px-4 text-gray-600">Incharge Name:</td>
                                    <td class="py-2 px-4 text-lg font-semibold text-blue-900">{{ $incharge->user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 text-gray-600">Incharge Phone:</td>
                                    <td class="py-2 px-4 text-lg font-semibold text-blue-900">{{ $incharge->user->phone }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="py-2 px-4">
                                    <div class="p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded-lg" role="alert">
                                        <p class="font-bold">Notice</p>
                                        <p>Incharge is not assigned</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Map Section -->
            <div class="p-6 mb-6 rounded-lg shadow-md bg-white">
                <h2 class="text-xl font-semibold text-blue-900 mb-4">Live Bus Location</h2>
                <div id="map" class="w-full h-96 rounded-lg"></div>
            </div>

        </div>
    </div>

    <script>
        let map;
        let marker;

        async function initMap() {
            const { Map } = await google.maps.importLibrary("maps");
            map = new Map(document.getElementById("map"), {
                center: { lat: 11.313121581667131, lng: 77.5504970007397 },
                zoom: 14,
                mapId: "4504f8b37365c3d0",
            });

            fetchBusLocation();
        }

        async function fetchBusLocation() {
            try {
                const response = await fetch(`/locations/{{ $bus->id }}`);
                const busLocations = await response.json();
                showBusLocation(busLocations);
            } catch (error) {
                console.error("Error fetching bus location:", error);
            }
        }

        async function showBusLocation(buses) {
            const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

            if (!buses[{{ $bus->id }}] || buses[{{ $bus->id }}].length === 0) return;

            const latestLocation = buses[{{ $bus->id }}][0];

            map.setCenter({ lat: latestLocation.latitude, lng: latestLocation.longitude });
            map.setZoom(16);

            if (marker) marker.setMap(null);

            marker = new AdvancedMarkerElement({
                position: new google.maps.LatLng(latestLocation.latitude, latestLocation.longitude),
                map,
                title: "Latest Position - Bus {{ $bus->number }}",
            });
        }

        window.onload = () => {
            initMap();
        };
    </script>
</x-app-layout>
