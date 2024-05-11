<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight flex justify-between items-center">
            {{ __('HOME') }}
            <div class="text-right text-sm">
                {{ __('FUTURE IS OURS') }}
            </div>
        </h2>
    </x-slot>

    <!-- Background image using inline style for better control -->
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div style="background-image: url('{{ asset('img/nastuh-abootalebi-ZtC4_rPCRXA-unsplash.jpg') }}');
                    background-size: cover;
                    background-position: center;
                    background-attachment: fixed;
                    min-height: 100vh;
                    width: 100%;"
                    id="background">


            <!-- Content of the page here -->
            <h2 id="floatingText" class="text-white text-4xl font-bold text-center"
                style="padding-top: 20vh; transition: transform 0.5s ease-in-out, opacity 0.2s linear;">    
                WELCOME TO  THE BADGE APPLICATION WEBSITE
            </h2>
        </div>
    </div>
    

    {{-- Footer --}}
    <footer class="bg-gray-800 text-white text-center p-4">
        <div class="container mx-auto">
            <p>&copy; {{ date('Y') }} - All rights reserved.</p>
            <p>Powered by | Cheat-Codes Teams</p>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const text = document.getElementById('floatingText');
            const scrollPosition = window.scrollY || document.documentElement.scrollTop;
            text.style.transform = 'translateY(' + scrollPosition * 0.5 + 'px)';
            text.style.opacity = 1 - scrollPosition / 400;
        });
    </script>

    <style>
        /* Responsiveness for smaller screens */
        @media screen and (max-width: 640px) {
            #background {
                background-attachment: scroll;
            }
        }
    </style>
</x-app-layout>
