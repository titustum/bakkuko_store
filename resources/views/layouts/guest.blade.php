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
    <body class="font-sans antialiased text-gray-900">

        <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">

            <!-- Left Side: Description Section -->
            <div class="flex-col justify-center hidden p-12 text-white bg-indigo-900 lg:flex lg:w-1/2">
                <div>
                    <h1 class="mb-4 text-4xl font-bold">Welcome To Bakkuo Store!</h1>
                    <p class="mb-6 text-lg">
                        We are the number one store selling quality and genuine African fashion and footware.
                        With over 300 products and thousands of customers, we are beyond number but service.
                    </p>
                </div>
            </div>

            <!-- Right Side: Login/Register Forms -->
            <div class="flex flex-col items-center justify-center w-full p-8 lg:w-1/2 lg:p-16">
                <div class="w-full max-w-md p-6 mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <div class="mb-8 text-center">
                        <a href="/" class="text-orange-600">
                            <x-application-logo class="w-24 h-24 mx-auto text-gray-500 fill-current" />
                        </a>
                    </div>

                    <!-- Dynamic Form Content -->
                    {{ $slot }}

                </div>
            </div>
        </div>
    </body>
</html>
