<x-app-layout>
    <x-slot name="title">
        {{ __('Dashboard') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="mt-20 ml-4 py-9 sm:ml-64 sm:me-4 lg:me-0">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="mb-6">
                <nav class="flex items-center justify-between p-4 bg-white rounded-lg shadow-md" aria-label="Breadcrumb">
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
                            <span class="font-semibold text-blue-900 capitalize">Track Bus</span>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                @foreach ($buses as $bus)
                    <div class="p-4 bg-white rounded-lg shadow-md cursor-pointer hover:bg-blue-100"
                        onclick="fetchBusLocations({{ $bus->id }})">
                        <h3 class="text-lg font-semibold text-blue-900">Bus {{ $bus->number }}</h3>
                        <p class="text-gray-600">Click to view location</p>
                    </div>
                @endforeach
            </div>

            <div class="p-6 mb-6 rounded-sm shadow-lg bg-white">
                <div id="map" class="w-full h-96 rounded-lg"></div>
            </div>
        </div>
    </div>

    <script>
        let map;
        let markers = [];

        async function initMap() {
            const { Map } = await google.maps.importLibrary("maps");
            map = new Map(document.getElementById("map"), {
                center: { lat: 11.313121581667131, lng: 77.5504970007397 },
                zoom: 14,
                mapId: "4504f8b37365c3d0",
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
            const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
            markers.forEach(marker => marker.setMap(null));
            markers = [];

            Object.values(buses).forEach(busLocations => {
                if (busLocations.length === 0) return;

                busLocations.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                const latestLocation = busLocations[0];

                // Update map center to latest bus location
                map.setCenter({ lat: latestLocation.latitude, lng: latestLocation.longitude });
                map.setZoom(16); // Zoom in for better view

                const latestMarker = new AdvancedMarkerElement({
                    position: new google.maps.LatLng(latestLocation.latitude, latestLocation.longitude),
                    map,
                    title: "Latest Position - Bus " + latestLocation.bus.number,
                });

                markers.push(latestMarker);
            });
        }

        window.onload = () => {
            initMap();
        };
    </script>
</x-app-layout>
