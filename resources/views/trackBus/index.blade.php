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

            <div class="p-6 mb-6 rounded-sm shadow-lg bg-white flex items-center justify-between">
                <select name="bus" id="bus"
                    class="w-1/3 p-2 border border-gray-300 rounded-lg focus:outline-none">
                    <option value="">Select Bus</option>
                    @foreach ($buses as $bus)
                        <option value="{{ $bus->id }}">{{ $bus->number }}</option>
                    @endforeach
                </select>
            </div>

            <div class="p-6 mb-6 rounded-sm shadow-lg bg-white">
                {{-- Show Maps --}}
                <div id="map" class="w-full h-96 rounded-lg">

                </div>

                {{-- Generate different random color for each bus --}}
                <div class="mt-4">
                    <div class="flex items-center space-x-4">
                        @foreach ($buses as $bus)
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 rounded-full"
                                    style="background-color: {{ '#' . substr(md5(rand()), 0, 6) }}"></div>
                                <span>{{ $bus->number }}</span>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        let map;

        async function initMap() {
            const {
                Map
            } = await google.maps.importLibrary("maps");
            const {
                AdvancedMarkerElement
            } = await google.maps.importLibrary("marker");

            map = new Map(document.getElementById("map"), {
                center: {
                    lat: 11.313121581667131,
                    lng: 77.5504970007397
                },
                zoom: 14,
                mapId: "4504f8b37365c3d0",
            });
        }

        // Store markers globally to clear old ones
        let markers = [];

        // Show bus locations on the map with custom markers
        async function showBusLocations(buses) {
            const {
                AdvancedMarkerElement
            } = await google.maps.importLibrary("marker");

            // Clear previous markers
            markers.forEach(marker => marker.setMap(null));
            markers = [];

            // Iterate through each bus and process locations
            Object.values(buses).forEach(busLocations => {
                if (busLocations.length === 0) return; // Skip if no data

                // Sort locations by `created_at` (latest first)
                busLocations.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                // Get the latest location
                const latestLocation = busLocations[0];

                // Add a custom marker for the latest location
                const latestMarker = new AdvancedMarkerElement({
                    position: new google.maps.LatLng(latestLocation.latitude, latestLocation.longitude),
                    map,
                    title: "Latest Position - Bus " + latestLocation.bus.number,
                    content: busTracker(latestLocation.bus.number),
                });

                markers.push(latestMarker);

                for (let i = 1; i < busLocations.length; i++) {
                    const oldLocation = busLocations[i];

                    const oldMarker = new google.maps.Marker({
                        position: new google.maps.LatLng(oldLocation.latitude, oldLocation.longitude),
                        map,
                        title: "Previous Location - Bus " + oldLocation.bus.number,
                        icon: {
                            path: google.maps.SymbolPath.CIRCLE,
                            scale: 6, // Size of the circle dot
                            fillColor: "#888",
                            fillOpacity: 0.8,
                            strokeWeight: 0,
                        },
                    });

                    markers.push(oldMarker);
                }
            });
        }

        // Custom marker content for the latest location
        function busTracker(busNumber) {
            var div = document.createElement("div");
            div.className = "bus-marker";
            div.innerHTML = '<span class="bus-marker__number">' + busNumber + "</span>";
            return div;
        }

        // Fetch bus locations from the server
        async function fetchBusLocations(busId) {
            try {
                const response = await fetch(`/locations/${busId}`);
                const busLocations = await response.json();
                showBusLocations(busLocations);
            } catch (error) {
                console.error("Error fetching bus locations:", error);
            }
        }

        // Fetch bus locations when the bus is selected
        document.getElementById("bus").addEventListener("change", (event) => {
            fetchBusLocations(event.target.value);
        });

        window.onload = () => {
            initMap();
        }
    </script>
</x-app-layout>
