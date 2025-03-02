<x-app-layout>
    <x-slot name="title">
        {{ __('Import Students') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full mx-auto max-w-4xl sm:px-6 lg:px-8">
            <x-bread-crumb-navigation />

            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <h2 class="text-2xl font-bold mb-4 text-gray-700">📂 Import Students</h2>
                <p class="text-gray-600 mb-4">
                    Upload a CSV or Excel file to import students.
                    <a href="{{ asset('assets/samplecsv/sample-students.csv') }}"
                        class="text-blue-600 font-semibold hover:underline">
                        Download Sample File 📥
                    </a>
                </p>

                <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <!-- Select Batch -->
                    <div>
                        <label for="batch_id" class="block font-medium text-gray-700">Select Batch</label>
                        <select name="batch_id" id="batch_id" class="mt-2 block w-full p-2 border rounded-lg shadow-sm"
                            required>
                            <option value="">-- Select Batch --</option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->start_year }} - {{ $batch->end_year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Select Department -->
                    <div>
                        <label for="dept_id" class="block font-medium text-gray-700">Select Department</label>
                        <select name="dept_id" id="dept_id" class="mt-2 block w-full p-2 border rounded-lg shadow-sm"
                            required>
                            <option value="">-- Select Department --</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->dept_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Select Class -->
                    <div>
                        <label for="class_id" class="block font-medium text-gray-700">Select Class</label>
                        <select name="class_id" id="class_id" class="mt-2 block w-full p-2 border rounded-lg shadow-sm"
                            required>
                            <option value="">-- Select Class --</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->section }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label for="file" class="block font-medium text-gray-700">Choose CSV or Excel File</label>
                        <input type="file" name="file" id="file" accept=".csv, .xlsx"
                            class="mt-2 block w-full p-2 border rounded-lg shadow-sm" required>
                        <small class="text-gray-500">Supported formats: .csv, .xlsx</small>
                    </div>

                    <div class="flex space-x-3">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                            🚀 Import
                        </button>
                        <a href="{{ route('students.index') }}"
                            class="px-4 py-2 bg-gray-400 text-white rounded-lg shadow-md hover:bg-gray-500">
                            ❌ Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
