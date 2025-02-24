<x-app-layout>
    <x-slot name="title">
        {{ __('Parent Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Parent Details Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold">Parent Details</h2>
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('parents.edit', $parent->id) }}">
                            <button class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700">Edit</button>
                        </a>
                        <form action="{{ route('parents.destroy', $parent->id) }}" method="POST" class="inline">
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
                    <p>{{ $parent->user->name }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Email:</h3>
                    <p>{{ $parent->user->email }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Phone Number:</h3>
                    <p>{{ $parent->user->phone}}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Relationship:</h3>
                    <p>{{ $parent->relation }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Student Details:</h3>
                    <p>Name: {{ $parent->student->user->name }}</p>
                    <p>Email: {{ $parent->student->user->email }}</p>
                    <p>Phone Number: {{ $parent->student->user->phone }}</p>
                    <p>Roll Number: {{ $parent->student->roll_no }}</p>
                    <p>Class: {{ $parent->student->department->dept_code }} - {{ $parent->student->class->section }}</p>
                </div>
                
                
            </div>
        </div>
    </div>
</x-app-layout>
