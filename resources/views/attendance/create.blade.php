<x-app-layout>

    <x-slot name="title">
        {{ __('Attendance') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-6    ml-4 sm:ml-64">
        <div class="w-full max-w-4xl px-6 mx-auto">
            <x-bread-crumb-navigation />

            <!-- Form Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
                <div class="flex justify-start">
                    <button type="button" id="start-scanning"
                        class="px-4 py-2 text-lg font-semibold text-white transition duration-300 rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600">
                        Start Scanning
                    </button>
                </div>
            </div>

            <!-- Video Container -->
            <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg mt-4">
                <div id="camera">
                </div>

                <div id="barcode-result" class="mt-4 text-lg font-semibold text-center text-green-600"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@ericblade/quagga2/dist/quagga.min.js"></script>
    <script>
        const quaggaConf = {
            inputStream: {
                target: document.querySelector("#camera"),
                type: "LiveStream",
                constraints: {
                    width: {
                        min: 640
                    },
                    height: {
                        min: 480
                    },
                    facingMode: "environment",
                    aspectRatio: {
                        min: 1,
                        max: 2
                    }
                }
            },
            decoder: {
                readers: ['code_128_reader']
            },
        }

        Quagga.init(quaggaConf, function(err) {
            if (err) {
                return console.log(err);
            }
            Quagga.start();
        });

        Quagga.onDetected(function(result) {
            console.log(result.codeResult)
            alert("Detected barcode: " + result.codeResult.code);
        });
    </script>
</x-app-layout>
