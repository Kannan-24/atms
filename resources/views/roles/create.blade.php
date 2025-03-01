<x-app-layout>
    <x-slot name="title">Create Role</x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto">
            <x-bread-crumb-navigation />

            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">Create Role</h2>

                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-700">Role Name:</label>
                        <input type="text" name="name" id="name"
                            class="w-full p-2 mt-1 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Create</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
