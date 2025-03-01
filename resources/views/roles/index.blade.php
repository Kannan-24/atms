<x-app-layout>
    <x-slot name="title">Manage Roles</x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto mt-8">
            <x-bread-crumb-navigation />

            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">Roles</h2>

                <!-- Create Role -->
                <form action="{{ route('roles.store') }}" method="POST" class="mb-4 flex gap-2">
                    @csrf
                    <input type="text" name="name" class="border p-2 rounded w-full" placeholder="Enter role name" required>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Create Role</button>
                </form>

                <table class="w-full mt-4 border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Role Name</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr class="border">
                                <td class="px-4 py-2">{{ $role->name }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('roles.edit', $role->id) }}" class="px-2 py-1 bg-green-500 text-white rounded">Edit</a>
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
