<x-app-layout>
    <x-slot name="title">
        {{ __('Driver List') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            < x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('drivers.update', $driver->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-5">
                        <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ $driver->name }}"
                            class="w-full p-3 mt-2 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter Name" required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-5">
                        <label for="phone" class="block text-sm font-semibold text-gray-700">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ $driver->phone }}"
                            class="w-full p-3 mt-2 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter Phone" required>
                    </div>

                    <!-- License -->
                    <div class="mb-5">
                        <label for="license" class="block text-sm font-semibold text-gray-700">License</label>
                        <input type="text" name="license" id="license" value="{{ $driver->license }}"
                            class="w-full p-3 mt-2 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter License" required>
                    </div>

                    <!-- Status -->
                    <div class="mb-5">
                        <label for="status" class="block text-sm font-semibold text-gray-700">Status</label>
                        <select name="status" id="status"
                            class="w-full p-3 mt-2 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="active" {{ $driver->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $driver->status == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-5 py-3 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Edit Driver
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
