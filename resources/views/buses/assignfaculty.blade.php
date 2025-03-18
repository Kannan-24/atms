<x-app-layout>

    <x-slot name="title">
        {{ __('Assign Faculty') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('buses.assignFaculty', $bus->id) }}" method="POST">
                    @csrf

                    <!-- Faculty Selection -->
                    <div class="mb-4">
                        <label for="faculty_id" class="block text-sm font-semibold text-gray-700">Faculty</label>
                        <select name="faculty_id" id="faculty_id"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required onchange="fetchFacultyDetails(this.value)">
                            <option value="">Select a faculty</option>
                            @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id }}">{{ $faculty->user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Faculty Details -->
                    <div id="faculty-details"
                        class="p-6 mt-3 bg-gradient-to-r from-gray-100 to-gray-200 border border-gray-300 rounded-lg shadow-lg hidden">
                        <h3 class="text-xl font-bold text-indigo-600">Faculty Details</h3>
                        <div class="mt-2">
                            <p class="text-lg"><strong>Name:</strong> <span id="faculty-name"
                                    class="text-gray-700"></span></p>
                            <p class="text-lg"><strong>Email:</strong> <span id="faculty-email"
                                    class="text-gray-700"></span></p>
                            <p class="text-lg"><strong>Phone:</strong> <span id="faculty-phone"
                                    class="text-gray-700"></span></p>
                            <p class="text-lg"><strong>Department:</strong> <span id="faculty-department"
                                    class="text-gray-700"></span></p>
                            <p class="text-lg"><strong>Address:</strong> <span id="faculty-address"
                                    class="text-gray-700"></span></p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="px-4 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Assign Faculty
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function fetchFacultyDetails(facultyId) {
            if (!facultyId) {
                document.getElementById('faculty-details').classList.add('hidden');
                return;
            }

            fetch(`/faculties/assign/${facultyId}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Faculty Data:", data);

                    document.getElementById('faculty-name').textContent = data.user.name;
                    document.getElementById('faculty-email').textContent = data.user.email;
                    document.getElementById('faculty-phone').textContent = data.user.phone;
                    document.getElementById('faculty-department').textContent = data.department ?
                        data.department.name + ' (' + data.department.code + ')' :
                        'Not Assigned';
                    document.getElementById('faculty-address').textContent = data.address;

                    document.getElementById('faculty-details').classList.remove('hidden');
                })
                .catch(error => console.error('Error fetching faculty details:', error));
        }
    </script>

</x-app-layout>
