<x-app-layout>
    <x-slot name="title">
        {{ __('Faculty Details') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            < x-bread-crumb-navigation />

            <!-- Faculty Details Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Name:</h3>
                    <p>{{ $faculty->name }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Email:</h3>
                    <p>{{ $faculty->user->email }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Employee ID:</h3>
                    <p>{{ $faculty->employee_id }}</p>
                </div>
                <div class="flex justify-end gap-4">
                    <a href="{{ route('faculty.edit', $faculty->id) }}">
                        <button class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700">Edit</button>
                    </a>
                    <form action="{{ route('faculty.destroy', $faculty->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
