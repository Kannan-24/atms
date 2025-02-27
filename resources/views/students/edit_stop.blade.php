<x-app-layout>
    <x-slot name="title">
        {{ __('Edit Assigned Stop') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4">Edit Assigned Stop</h2>

                <form action="{{ route('students.updateStop', $student->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="stop_id" class="block font-medium text-gray-700">Select New Stop</label>
                        <select name="stop_id" id="stop_id" class="w-full px-3 py-2 border rounded">
                            @foreach($stops as $stop)
                                <option value="{{ $stop->id }}" 
                                    {{ ($assignedStop && $assignedStop->stop_id == $stop->id) ? 'selected' : '' }}>
                                    {{ $stop->stop_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                        Update Stop
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
