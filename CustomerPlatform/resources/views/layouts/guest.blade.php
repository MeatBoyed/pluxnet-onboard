<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
         
    </head>
    <!-- <body class="font-sans text-gray-900 antialiased"> -->
<body class="bg-gradient-to-br from-pluxnet-navy to-pluxnet-pink min-h-screen  antialiased font-sans">
    <div class="min-h-screen flex flex-col gap-4 sm:justify-center items-center sm:pt-0 md:pb-6">
        <div class="pt-6">
            <a href="/" wire:navigate>
                <x-application-logo />
            </a>
        </div>

        <div class="w-full sm:max-w-lg mt-6 px-4 md:px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
