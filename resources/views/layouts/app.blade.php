<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- CSS -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" >
        <!-- font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM6p4Dql1EkKK9ZRiHiqTtHcVjr2I6TKKpq37Sy" crossorigin="anonymous">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <style>
            [x-cloak] { display: none !important; }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
         <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="../path/to/flowbite/dist/datepicker.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    </head>
    <body class="font-sans antialiased">
        
        <div class="min-h-screen bg-custom-beige">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bgwhite shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
                
            </main>
            
        </div>
        <script src="js/script.js"></script>
        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    </body>
</html>
