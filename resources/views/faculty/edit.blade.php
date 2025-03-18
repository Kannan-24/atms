<x-app-layout>
    <x-slot name="title">
        {{ __('Edit Faculty') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('faculty.update', $faculty->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ $faculty->user->name }}"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ $faculty->user->email }}"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Employee ID -->
                    <div class="mb-4">
                        <label for="ts_id" class="block text-sm font-semibold text-gray-700">Employee ID</label>
                        <input type="text" name="ts_id" id="employee_id" value="{{ $faculty->ts_id }}"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-semibold text-gray-700">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ $faculty->user->phone }}"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-4">
                        <label for="dob" class="block text-sm font-semibold text-gray-700">Date of Birth</label>
                        <input type="date" name="dob" id="dob" value="{{ $faculty->dob }}"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Blood Group -->
                    <div class="mb-4">
                        <label for="blood_group" class="block text-sm font-semibold text-gray-700">Blood Group</label>
                        <select name="blood_group" id="blood_group"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">Select Blood Group</option>
                            <option value="A+" {{ $faculty->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ $faculty->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ $faculty->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ $faculty->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="AB+" {{ $faculty->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ $faculty->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option value="O+" {{ $faculty->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ $faculty->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-semibold text-gray-700">Address</label>
                        <input type="text" name="address" id="address" value="{{ $faculty->address }}"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Department -->
                    <div class="mb-4">
                        <label for="dept_id" class="block text-sm font-semibold text-gray-700">Department</label>
                        <select name="dept_id" id="dept_id"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ $faculty->dept_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->dept_name }} - {{ $department->dept_code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Edit Faculty
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
