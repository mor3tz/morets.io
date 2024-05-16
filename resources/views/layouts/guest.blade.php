<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anta&family=Jersey+10&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mochiy+Pop+One&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])



    
    

<style>
    @keyframes slide {
        0% { transform: translateX(0%); }
        50% { transform: translateY(50%); }
    }

    h2 {
        font-style: "Jersey 10";
        font-size: 2.5em;
        font-weight: bold;
        color: black;
        animation: slide 5s linear infinite;
        margin-bottom: 10rem;
        margin-right: 19rem;
        text-shadow: 0 4px 6px rgb(56, 56, 56);
        
    }
</style>


</head>
<body class="font-sans text-gray-900 antialiased overflow-hidden"> <!-- Tambahkan overflow-hidden di sini -->
    <div class="flex items-center justify-end min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('img/matthew-henry-VviFtDJakYk-unsplash.jpg') }}');">
        <h2>WELCOME WORKERS</h2>

        <!-- Main content area that should be centered -->
        <div class="w-2/5 h-auto p-6 space-y-4 shadow-lg" style="backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0);">
            <div class="w-full">
                <img src="{{ asset('img/logodasarpkt.png') }}" alt="Logo" class="mx-auto">
            </div>
            
            <!-- Slot for additional content -->
            {{ $slot }}
        </div>
    </div>

</body>
</html>
