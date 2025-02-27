<x-app-layout>
    <x-slot name="title">
        {{ __('Student Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Student Details Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold">Student Details</h2>
                    <div class="flex justify-end gap-4">
    @if ($student->stop) 
        <!-- If a stop is assigned, show Edit Stop button -->
        <a href="{{ route('students.editStop', $student->id) }}">
            <button class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-700">
                Edit Stop
            </button>
        </a>
    @else 
        <!-- If no stop is assigned, show Assign Stop button -->
        <a href="{{ route('students.assignStops', $student->id) }}">
            <button class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                Assign Stop
            </button>
        </a>
    @endif

    <!-- Edit Student Button -->
    <a href="{{ route('students.edit', $student->id) }}">
        <button class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700">
            Edit
        </button>
    </a>

    <!-- Delete Student Form -->
    <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700">
            Delete
        </button>
    </form>
</div>

                </div>
                <hr class="my-4">
                <table class="w-2/4 text-left">
                    <tr>
                        <th class="text-lg font-semibold">Name</th>
                        <td>{{ $student->user->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Roll Number</th>
                        <td>{{ $student->roll_no }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Batch</th>
                        <td>{{ $student->batch->start_year }} - {{ $student->batch->end_year }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Department</th>
                        <td>{{ $student->class->department->dept_name }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Class</th>
                        <td>{{ $student->class->department->dept_code }} - {{ $student->class->section }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Email</th>
                        <td>{{ $student->user->email }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Phone Number</th>
                        <td>{{ $student->user->phone }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Date of Birth</th>
                        <td>{{ $student->dob }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Blood Group</th>
                        <td>{{ $student->blood_group }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Address</th>
                        <td>{{ $student->address }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Assigned Stop</th>
                        <td>
                            @if ($student->stop)
                                {{ $student->stop->stop_name }}
                            @else
                                <span class="text-gray-500">Not Assigned</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
