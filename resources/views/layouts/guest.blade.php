<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('img/logo.svg') }}" type="image/gif" sizes="16x16">

        <title>{{ config('app.name', 'Recipes') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="bg-gray-100 font-sans">
        <!-- Page Navigation -->
        <header class="flex flex-row bg-white p-2 shadow bg-gray-50">
            @include('layouts.navigation')
        </header>

        <!-- Page Content -->
        <div class="text-gray-900 antialiased mt-8">
            {{-- Show alerts on page --}}
            @if (session('alert'))
                {{-- TODO: Extract this to a component --}}
                @php
                $styling = [
                    "info" => "bg-blue-100 border-blue-500 text-blue-700",
                    "success" => "bg-green-100 border-green-500 text-green-700",
                    "warning" => "bg-yellow-100 border-yellow-500 text-yellow-700",
                    "danger" => "bg-red-100 border-red-500 text-red-700"
                ];
                @endphp

                <div class="{{ $styling[session('alert')['type']] }} w-5/6  max-w-6xl my-4 rounded mx-auto mx-auto text-center p-4 border-b-2" role="alert">
                    <p>{{ session('alert')['message'] }}</p>
                </div>
            @endif

            {{ $slot }}
        </div>
    </body>
</html>
