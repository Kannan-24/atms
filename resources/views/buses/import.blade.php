<x-app-layout>
    <x-slot name="title">
        {{ __('Import Buses') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full mx-auto max-w-4xl sm:px-6 lg:px-8">

            <x-bread-crumb-navigation />

            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <h2 class="text-2xl font-bold mb-4 text-gray-700">📂 Import Buses</h2>
                <p class="text-gray-600 mb-4">
                    Upload a CSV or Excel file to import buses.
                    <a href="{{ asset('sample-buses.csv') }}" class="text-blue-600 font-semibold hover:underline">
                        Download Sample File 📥
                    </a>
                </p>

                <!-- Import Form -->
                <form action="{{ route('buses.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label for="file" class="block font-medium text-gray-700">Choose CSV or Excel File</label>
                        <input type="file" name="file" id="file"
                            class="mt-2 block w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300"
                            required onchange="previewFile()">
                        <small class="text-gray-500">Supported formats: .csv, .xlsx</small>
                    </div>

                    <!-- File Preview -->
                    <div id="file-preview" class="hidden bg-gray-100 p-3 rounded-md text-gray-600"></div>

                    <div class="flex space-x-3">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                            🚀 Import
                        </button>
                        <a href="{{ route('buses.index') }}"
                            class="px-4 py-2 bg-gray-400 text-white rounded-lg shadow-md hover:bg-gray-500">
                            ❌ Cancel
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- JavaScript for File Preview -->
    <script>
        function previewFile() {
            let fileInput = document.getElementById("file");
            let preview = document.getElementById("file-preview");

            if (fileInput.files.length > 0) {
                preview.innerText = "📄 Selected File: " + fileInput.files[0].name;
                preview.classList.remove("hidden");
            } else {
                preview.classList.add("hidden");
            }
        }
    </script>
</x-app-layout>
