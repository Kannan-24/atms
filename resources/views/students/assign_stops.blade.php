<x-app-layout>
    <x-slot name="title">
        Assign Stop - {{ $student->user->name }}
    </x-slot>

    <div class="py-6 mt-20 ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4">Assign Stop to {{ $student->user->name }}</h2>

                <form action="{{ route('students.assignStops.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label for="stop_id" class="block font-medium text-gray-700">Select Stop</label>
                    <select name="stop_id" id="stop_id" class="w-full p-2 border border-gray-300 rounded-lg mt-2">
                        <option value="">-- Select Stop --</option>
                        @foreach ($stops as $stop)
                            <option value="{{ $stop->id }}" {{ $student->stop_id == $stop->id ? 'selected' : '' }}>
                                {{ $stop->stop_name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="mt-4 px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                        Assign Stop
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
