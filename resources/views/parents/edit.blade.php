<x-app-layout>
    <x-slot name="title">
        {{ __('Edit Parent') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('parents.update', $parent->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ $parent->user->name }}"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ $parent->user->email }}"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-semibold text-gray-700">Phone Number</label>
                        <input type="text" name="phone" id="phone" value="{{ $parent->user->phone }}"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <!-- Relationship -->
                    <div class="mb-4">
                        <label for="relation" class="block text-sm font-semibold text-gray-700">Relationship</label>
                        <select name="relation" id="relation"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="" disabled>Select Relationship</option>
                            <option value="mother" {{ $parent->relation == 'mother' ? 'selected' : '' }}>Mother</option>
                            <option value="father" {{ $parent->relation == 'father' ? 'selected' : '' }}>Father</option>
                            <option value="brother" {{ $parent->relation == 'brother' ? 'selected' : '' }}>Brother
                            </option>
                            <option value="sister" {{ $parent->relation == 'sister' ? 'selected' : '' }}>Sister</option>
                            <option value="guardian" {{ $parent->relation == 'guardian' ? 'selected' : '' }}>Guardian
                            </option>
                        </select>
                    </div>

                    <!-- Student ID -->
                    <div class="mb-4">
                        <label for="student_id" class="block text-sm font-semibold text-gray-700">Student ID</label>
                        <select name="student_id" id="student_id"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="" disabled>Select Student ID</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ $parent->student_id == $student->id ? 'selected' : '' }}>
                                    {{ $student->user->name }} - {{ $student->roll_no }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Edit Parent
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
