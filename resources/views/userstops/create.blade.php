<x-app-layout>
    <x-slot name="title">
        {{ __('Create Stop') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <form action="{{ route('userstops.store') }}" method="POST">
                    @csrf

                    <!-- User -->
                    <div class="mb-4">
                        <label for="user_id" class="block text-sm font-semibold text-gray-700">User</label>
                        <select name="user_id" id="user_id"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->roll_number ?? $user->ts_id }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Stop Details -->
                    <div class="mb-4">
                        <label for="stop_details" class="block text-sm font-semibold text-gray-700">Stop Details</label>
                        <select name="stop_details" id="stop_details"
                            class="w-full p-2 mt-1 transition duration-300 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            @foreach($stops as $stop)
                                <option value="{{ $stop->id }}">{{ $stop->stop_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                            Create Stop
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
