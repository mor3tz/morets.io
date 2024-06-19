<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight flex justify-between items-center">
            {{ __('HOME') }}
            <div class="text-right text-sm">
                <i class="fa-solid fa-hashtag"></i>
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
                SELAMAT DATANG DI APLIKASI WEBSITE PENGAJUAN BADGE
            </h2>
        

              
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'user')
            <div class="flex justify-center items-center mt-32 "> <!-- Parent container untuk tombol -->
                <button class="continue-application">
                    <div>
                        <div class="pencil"></div>
                        <div class="folder">
                            <div class="top">
                                <svg viewBox="0 0 24 27">
                                    <path d="M1,0 L23,0 C23.5522847,-1.01453063e-16 24,0.44771525 24,1 L24,8.17157288 C24,8.70200585 23.7892863,9.21071368 23.4142136,9.58578644 L20.5857864,12.4142136 C20.2107137,12.7892863 20,13.2979941 20,13.8284271 L20,26 C20,26.5522847 19.5522847,27 19,27 L1,27 C0.44771525,27 6.76353751e-17,26.5522847 0,26 L0,1 C-6.76353751e-17,0.44771525 0.44771525,1.01453063e-16 1,0 Z"></path>
                                </svg>
                            </div>
                            <div class="paper"></div>
                        </div>
                    </div>
                    <a href="{{ route('pengajuan') }}">
                       <span class="font-bold text-sm mr-2">Buat Badge Baru </span>
                    </a>
                </button>
            </div>            
            @endif
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
