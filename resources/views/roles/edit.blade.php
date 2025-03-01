<x-app-layout>
    <x-slot name="title">Edit Role</x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto">
            <x-bread-crumb-navigation />

            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">Edit Role</h2>

                <form action="{{ route('roles.update', $role->id) }}" method="POST" class="mb-4">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" value="{{ $role->name }}" class="border p-2 rounded w-full" required>
                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Update Role</button>
                </form>

                <hr class="my-4">

                <h3 class="text-lg font-semibold mb-2">Assign Permissions</h3>
                <form action="{{ route('roles.assignPermissions', $role->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($permissions as $permission)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" 
                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                <span>{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Update Permissions</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
