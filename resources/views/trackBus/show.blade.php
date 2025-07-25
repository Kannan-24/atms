<x-app-layout>
    <x-slot name="title">
        {{ __('Track Bus') }} - {{ $bus->number }}
    </x-slot>

    <div class="   ml-4 py-9 sm:ml-64 sm:me-4 lg:me-0">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="mb-6">
                <nav class="flex items-center justify-between p-4 bg-white rounded-lg shadow-md">
                    <ol class="inline-flex items-center space-x-2">
                        <li><a href="{{ route('dashboard') }}"
                                class="font-medium text-blue-800 hover:text-blue-900">Dashboard</a></li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mx-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            <a href="{{ route('track-buses.index') }}"
                                class="font-medium text-blue-800 hover:text-blue-900">Track Bus</a>
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
                        @if ($bus->busDriver)
                            <tr>
                                <td class="py-2 px-4 text-gray-600">Driver Name:</td>
                                <td class="py-2 px-4 text-lg font-semibold text-blue-900">
                                    {{ $bus->busDriver->driver->user->name }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 text-gray-600">Driver Phone:</td>
                                <td class="py-2 px-4 text-lg font-semibold text-blue-900">
                                    {{ $bus->busDriver->driver->user->phone }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="2" class="py-2 px-4">
                                    <div class="p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded-lg"
                                        role="alert">
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
                        @if ($bus->facultyIncharge)
                            <tr>
                                <td class="py-2 px-4 text-gray-600">Incharge Name:</td>
                                <td class="py-2 px-4 text-lg font-semibold text-blue-900">
                                    {{ $bus->facultyIncharge->faculty->user->name }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 text-gray-600">Incharge Phone:</td>
                                <td class="py-2 px-4 text-lg font-semibold text-blue-900">
                                    {{ $bus->facultyIncharge->faculty->user->phone }}
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="2" class="py-2 px-4">
                                    <div class="p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded-lg"
                                        role="alert">
                                        <p class="font-bold">Notice</p>
                                        <p>Incharge is not assigned</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Live Bus Tracking -->
            <div class="p-6 mb-6 rounded-lg shadow-md bg-white">
                <h2 class="text-xl font-semibold text-blue-900 mb-4">Live Bus Location</h2>
                <div id="map" class="w-full h-96 rounded-lg"></div>
            </div>
        </div>
    </div>

    <script>
        let map, markers = [],
            busPath = null,
            latestMarker = null;
        let followBus = true; // Auto-focus on bus when moving

        async function initMap() {
            const {
                Map
            } = await google.maps.importLibrary("maps");
            map = new Map(document.getElementById("map"), {
                center: {
                    lat: 11.3131,
                    lng: 77.5504
                },
                zoom: 14,
                styles: [{
                        featureType: "road",
                        elementType: "geometry",
                        stylers: [{
                            lightness: 50
                        }]
                    },
                    {
                        featureType: "water",
                        elementType: "geometry",
                        stylers: [{
                            color: "#a0c5ff"
                        }]
                    },
                    {
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [{
                            visibility: "off"
                        }]
                    },
                    {
                        elementType: "geometry",
                        stylers: [{
                            color: "#ebe3cd"
                        }]
                    }
                ]
            });

            fetchBusLocations({{ $bus->id }});
            setInterval(() => fetchBusLocations({{ $bus->id }}), 10000);

            // Detect user panning & disable auto-follow
            map.addListener("dragstart", () => {
                followBus = false;
            });
        }

        async function fetchBusLocations(busId) {
            try {
                const response = await fetch(`/locations/${busId}`);
                const busLocations = await response.json();
                showBusLocations(busLocations);
            } catch (error) {
                console.error("Error fetching bus locations:", error);
            }
        }

        async function showBusLocations(buses) {
            if (!buses[{{ $bus->id }}] || buses[{{ $bus->id }}].length === 0) return;

            // Clear previous markers and path
            markers.forEach(marker => marker.setMap(null));
            markers = [];
            if (busPath) busPath.setMap(null);

            const busLocations = buses[{{ $bus->id }}].sort((a, b) => new Date(b.created_at) - new Date(a
                .created_at));
            const latestLocation = busLocations[0];

            // Auto-center on bus if followBus is enabled
            if (followBus) {
                map.panTo({
                    lat: latestLocation.latitude,
                    lng: latestLocation.longitude
                });
            }

            // Custom Bus Icon
            if (latestMarker) latestMarker.setMap(null);
            latestMarker = new google.maps.Marker({
                position: {
                    lat: latestLocation.latitude,
                    lng: latestLocation.longitude
                },
                map,
                title: "Current Location - Bus {{ $bus->number }}",
                icon: {
                    url: "https://maps.google.com/mapfiles/kml/shapes/bus.png",
                    scaledSize: new google.maps.Size(50, 50)
                },
                animation: google.maps.Animation.DROP // Smooth animation effect
            });

            markers.push(latestMarker);

            // Draw Route Path with Gradient Effect
            const routeCoordinates = busLocations.map(loc => ({
                lat: loc.latitude,
                lng: loc.longitude
            }));
            busPath = new google.maps.Polyline({
                path: routeCoordinates,
                geodesic: true,
                strokeColor: "#007bff",
                strokeOpacity: 0.9,
                strokeWeight: 5
            });
            busPath.setMap(map);

            // Add Previous Locations as Small Dots
            for (let i = 1; i < busLocations.length; i++) {
                const oldLocation = busLocations[i];
                const oldMarker = new google.maps.Marker({
                    position: {
                        lat: oldLocation.latitude,
                        lng: oldLocation.longitude
                    },
                    map,
                    title: "Previous Location - Bus {{ $bus->number }}",
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 6,
                        fillColor: "#888",
                        fillOpacity: 0.8,
                        strokeWeight: 0
                    }
                });

                markers.push(oldMarker);
            }
        }

        window.onload = () => {
            initMap();
        };
    </script>
</x-app-layout>
