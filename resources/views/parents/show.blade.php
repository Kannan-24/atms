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
                <table class="w-2/4 text-left">
                    <tr>
                        <th class="text-lg font-semibold">Name</th>
                        <td>{{ $parent->user->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Email</th>
                        <td>{{ $parent->user->email }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Phone Number</th>
                        <td>{{ $parent->user->phone }}</td>
                    </tr>
                    <tr>
                        <th class="text-lg font-semibold">Relationship</th>
                        <td>{{ $parent->relation }}</td>
                    </tr>
                </table>
                <hr class="my-4">
                <h4 class="text-lg font-semibold mb-4">Student Details</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">

                    <a href="{{ route('students.show', $parent->student->id) }}" class="block">
                        <div
                            class="relative overflow-hidden bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-lg transition-transform transform hover:scale-105">
                            <div class="p-6">
                                <p class="text-white opacity-90">{{ $parent->student->user->name }}</p>
                                <p class="text-white opacity-90">{{ $parent->student->roll_no }}</p>
                                <p class="text-white opacity-90">{{ $parent->student->department->dept_code }} -
                                    {{ $parent->student->class->section }}</p>
                            </div>`
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
