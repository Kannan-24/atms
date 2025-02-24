<x-app-layout>

    <x-slot name="title">
        {{ __('Create Student') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                        <input type="text" name="name" id="name"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Roll Number -->
                    <div class="mb-4">
                        <label for="roll_no" class="block text-sm font-semibold text-gray-700">Roll Number</label>
                        <input type="text" name="roll_no" id="roll_no"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-semibold text-gray-700">Phone</label>
                        <input type="text" name="phone" id="phone"
                        class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    </div>
                    
                    <!-- Date of Birth -->
                    <div class="mb-4">
                        <label for="dob" class="block text-sm font-semibold text-gray-700">Date of Birth</label>
                        <input type="date" name="dob" id="dob"
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
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-semibold text-gray-700">Address</label>
                        <input type="text" name="address" id="address"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>


                    <!-- Batch -->
                    <div class="mb-4">
                        <label for="batch_id" class="block text-sm font-semibold text-gray-700">Batch</label>
                        <select name="batch_id" id="batch_id"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">Select Batch</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->start_year }} - {{ $batch->end_year}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Department -->
                    <div class="mb-4">
                        <label for="dept_id" class="block text-sm font-semibold text-gray-700">Department</label>
                        <select name="dept_id" id="dept_id"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->dept_name }} - {{ $department->dept_code }}</option> 
                            @endforeach
                        </select>
                    </div>

                    <!-- Class -->
                    <div class="mb-4">
                        <label for="class_id" class="block text-sm font-semibold text-gray-700">Class</label>
                        <select name="class_id" id="class_id"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->department->dept_code }} - {{ $class->section }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Create Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
