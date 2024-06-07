<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-white text-xl leading-tight flex justify-between items-center">
            {{ __('DASHBOARD') }}
            <div class="text-right text-sm">
                {{ __('FUTURE IS OURS') }}
            </div>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg min-h-[600px]">
                <div class="p-6 text-gray-600 font-bold text-lg text-center">
                    {{ __(" DASHBOARD PENGAJUAN BADGE") }}

                    <!-- Button for creating new file -->
                    <div class="flex justify-between">
                        @if (Auth::user()->role == 'admin')
                            {{-- <div class="mt-4  space-x-4">
                                <a href="{{ route('pengajuan') }}" class="px-4 py-2 bg-green text-white font-bold text-xs uppercase rounded hover:bg-orange transition duration-300 ease-in-out">
                                    + Pengajuan Baru
                                </a>
                            </div> --}}

                            <div class="button-icon mt-10">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="bevel"><path d="M20 11.08V8l-6-6H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h6"/>
                                        <path d="M14 3v5h5M18 21v-6M15 18h6"/>
                                    </svg>
                                </div>
                                    <a href="{{ route('pengajuan') }}" class="icon-link">
                                        <div class="cube">
                                            <span class="side front items-center" >
                                                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="bevel"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                                </svg> New File
                                            </span>
                                            <span class="side top">Pengajuan Badge</span>
                                        </div>
                                    </a>
                            </div>
                            
                              

                        @endif

                        <!-- toast -->
                        @if (session('sukses'))
                            {{-- <div class="w-1/2 bg-green flex flex-col items-center font-bold text-gray-200 rounded-md my-3 py-3 mx-auto">
                                {{ session('sukses') }}
                            </div> --}}
                            <div id="toast-success" class="ms-auto flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-white bg-green rounded-lg dark:bg-green-800 dark:text-green-200">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                    </svg>
                                    <span class="sr-only">Check icon</span>
                                </div>
                                <div class="ms-3 text-sm font-normal">{{ session('sukses') }}</div>
                                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                </button>
                            </div>
                        @elseif(session('errors'))
                            {{-- <div class="w-1/2 bg-red-500 flex flex-col items-center font-bold text-gray-200 rounded-md my-3 py-3 mx-auto">
                                {{ session('errors') }}
                            </div> --}}
                            <div id="toast-danger" class="ms-auto flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                                    </svg>
                                    <span class="sr-only">Error icon</span>
                                </div>
                                <div class="ms-3 text-sm font-normal">{{ session('errors') }}</div>
                                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>



                    <!-- Data Table -->
                    <div class="mt-4 overflow-x-auto">
                       @livewire('perusahaan-list')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
