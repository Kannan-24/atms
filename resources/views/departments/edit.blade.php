<x-app-layout>

    <x-slot name="title">
        {{ __('Edit Department') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('departments.update', $department->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Department Name -->
                    <div class="mb-5">
                        <label for="dept_name" class="block text-sm font-semibold text-gray-700">Department Name</label>
                        <input type="text" name="dept_name" id="dept_name" value="{{ $department->dept_name }}"
                            class="w-full transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Degree -->
                    <div class="mb-5">
                        <label for="degree" class="block text-sm font-semibold text-gray-700">Degree</label>
                        <input type="text" name="degree" id="degree" value="{{ $department->degree }}"
                            class="w-full transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-5 py-2 ml-4 text-sm text-white duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Edit Department
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
