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
        h2 {
            font-family: 'Inter', sans-serif;
            font-size: 2.5em;
            font-weight: bold;
            color: black;
            animation: slide 5s linear infinite;
            margin-bottom: 10rem;
            margin-right: 19rem;
        }
        .bg-custom {
            background-image: url('{{ asset('img/matthew-henry-VviFtDJakYk-unsplash.jpg') }}');
            background-size: cover; /* Ensures the background image covers the entire area */
            background-position: center; /* Centers the background image */
        }

        @media (max-width: 1024px) {
            .bg-custom {
                background-size: cover;
                background-position: center;
            }
        }

        @media (max-width: 768px) {
            .bg-custom {
                background-size: cover;
                background-position: center;
            }
        }

        /* Styling  for slightly wider card */
        .half-width-card {
            width: 60%;
            max-width: 500px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            backdrop-filter: blur(5px);
            background-color: rgba(255,255,255,0.5);
            max-height: 80vh;
            overflow-y: hidden;
        }

    </style>
</head>
<body class="font-sans text-gray-900 antialiased overflow-hidden">
    <div class="flex items-center justify-center min-h-screen bg-cover bg-no-repeat bg-custom">
        <!-- Main content area that should be centered -->
            <div class="half-width-card p-6 space-y4 shadow-w-lg">

                <div class="w-full">
                    <img src="{{ asset('img/logodasarpkt.png') }}" alt="Logo" class="mx-auto">
                </div>
                
                <!-- Slot for additional content -->
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
