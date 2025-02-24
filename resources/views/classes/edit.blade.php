<x-app-layout>

    <x-slot name="title">
        {{ __('Edit Class') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('classes.update', $class->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Department ID -->
                    <div class="mb-4">
                        <label for="dept_id" class="block text-sm font-semibold text-gray-700">Department ID</label>
                        <select name="dept_id" id="dept_id"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ $class->dept_id == $department->id ? 'selected' : '' }}>{{ $department->dept_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Batch ID -->
                    <div class="mb-4">
                        <label for="batch_id" class="block text-sm font-semibold text-gray-700">Batch ID</label>
                        <select name="batch_id" id="batch_id"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">Select Batch</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}" {{ $class->batch_id == $batch->id ? 'selected' : '' }}>{{ $batch->start_year }} - {{ $batch->end_year }}</option>
                            @endforeach
                        </select>
                    </div>
                        
                    <!-- Section -->
                    <div class="mb-4">
                        <label for="section" class="block text-sm font-semibold text-gray-700">Section</label>
                        <select name="section" id="section"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="A" {{ old('section', $class->section) == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('section', $class->section) == 'B' ? 'selected' : '' }}>B</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Edit Class
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
