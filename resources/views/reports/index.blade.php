<x-app-layout>
    <x-slot name="title">
        {{ __('Attendance Report') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Export Buttons -->
            <div class="flex justify-end mb-4">
                <a href="" class="px-4 py-2 mr-2 text-white bg-red-500 rounded hover:bg-red-600">
                    Export to PDF
                </a>
                <a href="" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">
                    Export to Excel
                </a>
            </div>

            <!-- Table Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border-collapse table-auto">
                        <thead>
                            <tr class="text-sm text-gray-600 bg-indigo-100">
                                <th class="px-6 py-4 border-b-2 border-gray-200">#</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Employee Name</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Date</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Status</th>
                                <th class="px-6 py-4 border-b-2 border-gray-200">Actions</th>
                            </tr>
                        </thead>
                        {{-- <tbody class="text-sm text-gray-700">
                            @foreach ($attendances as $attendance)
                                <tr class="border-b hover:bg-indigo-50">
                                    <td class="px-6 py-4 border-
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $stop->status }}</td>
                                    <x-action-buttons model="stops" :id="$stop->id" />
                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                    {{-- <x-pagination :paginator="$stops" /> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
