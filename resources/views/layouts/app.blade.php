<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'ATMS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTqe75FO2hSi_RMgpZ5ULQ60-hKIGulio&libraries=places,marker&loading=async">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-[calc(100vh-80px)] mt-20 bg-blue-200">
        @if (Route::currentRouteName() !== 'welcome')
            @include('layouts.navigation')
        @endif

        <div id="message-alert"
            class="fixed inset-x-0 bottom-5 right-5 z-50 transition-all ease-in-out duration-300 message-alert">
            <!-- Message Alert -->
            @if (session()->has('response'))
                <?php
                $message = session()->get('response') ?? [];
                $status = $message['status'];
                switch ($status) {
                    case 'success':
                        $status = 'green';
                        break;
                    case 'error':
                        $status = 'red';
                        break;
                    case 'warning':
                        $status = 'yellow';
                        break;
                    case 'info':
                        $status = 'blue';
                        break;
                    default:
                        $status = 'gray';
                        break;
                }
                ?>

                <div class="bg-{{ $status }}-100 border border-{{ $status }}-400 text-{{ $status }}-700 px-3 py-2 rounded relative w-72 ms-auto my-1 flex items-center"
                    role="alert">
                    <span class="block sm:inline">{{ $message['message'] }}</span>
                </div>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded relative w-72 ms-auto my-1 flex items-center"
                        role="alert">
                        <span class="block sm:inline text-sm">{{ $error }}</span>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="flex items-center justify-between px-4 py-6 W-full sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
