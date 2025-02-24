<x-app-layout>
    <x-slot name="title">
        {{ __('Student Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            < x-bread-crumb-navigation />

            <!-- Student Details Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold">Student Details</h2>
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('students.edit', $student->id) }}">
                            <button class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700">Edit</button>
                        </a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                            class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700">Delete</button>
                        </form>
                    </div>
                </div>
                <hr class="my-4">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Name:</h3>
                    <p>{{ $student->user->name }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Email:</h3>
                    <p>{{ $student->user->email }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Roll Number:</h3>
                    <p>{{ $student->roll_no }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Phone Number:</h3>
                    <p>{{ $student->user->phone }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Address:</h3>
                    <p>{{ $student->address }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Date of Birth:</h3>
                    <p>{{ $student->dob }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Class:</h3>
                    <p>{{ $student->class->department->dept_code }} - {{ $student->class->section }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Blood Group:</h3>
                    <p>{{ $student->blood_group }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
