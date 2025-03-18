<x-app-layout>

    <x-slot name="title">
        {{ __('Student List') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
            < x-bread-crumb-navigation />


            <div class="overflow-hidden bg-white rounded-lg shadow-xl">
                <div class="p-6 overflow-x-autos">
                    <table class="min-w-full text-left border-collapse table-auto">
                        <thead>
                            <tr class="text-sm text-gray-600 bg-indigo-100">
                                <th class="px-6 py-4 border-b-2 border-gray-200">#</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Name</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Email</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Roll Number</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Department</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700">
                            @foreach ($students as $student)
                                <tr class="border-b hover:bg-indigo-50">
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $student->user->name }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $student->user->email }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $student->roll_no }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $student->class->department->dept_code }}</td>
                                    <x-action-buttons model="students" :id="$student->id" />
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <x-pagination :paginator="$students" />
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
