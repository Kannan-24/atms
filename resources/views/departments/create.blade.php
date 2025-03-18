<x-app-layout>

    <x-slot name="title">
        {{ __('Create Department') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('departments.store') }}" method="POST">
                    @csrf

                    <!-- Department Name -->
                    <div class="mb-4">
                        <label for="dept_name" class="block text-sm font-semibold text-gray-700">Department Name</label>
                        <input type="text" name="dept_name" id="dept_name"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required placeholder="Eg: Computer Science and Engineering">
                    </div>

                    <!-- Department Code -->
                    <div class="mb-4">
                        <label for="dept_code" class="block text-sm font-semibold text-gray-700">Department Code</label>
                        <input type="text" name="dept_code" id="dept_code"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required placeholder="Eg: CSE">
                    </div>

                    <!-- Degree -->
                    <div class="mb-4">
                        <label for="degree" class="block text-sm font-semibold text-gray-700">Degree</label>
                        <select name="degree" id="degree"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="" disabled selected>Select Degree</option>
                            <option value="BE">B.E.</option>
                            <option value="BTech">B.Tech.</option>
                            <option value="ME">M.E.</option>
                            <option value="MTech">M.Tech.</option>
                            <option value="MS">M.S.</option>
                            <option value="PhD">Ph.D.</option>
                        </select>
                    </div>


                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Create Department
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
