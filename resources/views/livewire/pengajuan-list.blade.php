<div>
    <div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <label for="table-search" class="sr-only">Search</label>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:model.live.debounce300ms="search" type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
            </div>
        </div>
        
        <!-- header -->
        <div class="bg-gray-100  p-10 rounded-lg">
            <header>
                <h3 class="text-semibold  leading-6 font-bold text-lg text-black text-center">
                    INFORMASI PEMOHON
                </h3>
                <div id="detail-content">
                    {{-- content detail --}}
                </div>   
                </header>
        </div>

     
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-14">
                    <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">               
                        <tr>
                            @if (Auth::user()->role != 'admin')
                                <th class="px-6 py-3 border-b border-gray-200 text-gray-800 text-left text-xs font-semibold uppercase tracking-wider">
                                </th>
                            @endif                   
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            
                            <th scope="col" class="px-6 py-3">No KTP</th>
                            <th scope="col" class="px-6 py-3">Tanggal Berkunjung</th>
                            <th scope="col" class="px-6 py-3">Kunjungan Terakhir</th>
                            
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">More</th>
                        </tr>               
                    </thead>
                    <tbody>
                        <!-- many approve 1st part -->
                        @if (Auth::user()->role != 'admin')
                            {{-- <form action="{{ route('pengajuan.manyApprove', ['perusahaan' => $perusahaan]) }}" method="POST">
                                @csrf --}}
                        @endif   
                                                   
                        @foreach ($pengajuan as $pengajuan)
                            <tr class="font-bold text-sm bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                @if (Auth::user()->role != 'admin')
                                    <td class="px-6 py-4 border-b border-gray-200 text-sm whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if ($pengajuan->approved || $pengajuan->rejected)
                                                <input id="" type="checkbox" name="pengajuans[]" value="" class="w-4 h-4 text-orange bg-gray-100 border-gray-300 rounded focus:ring-orange " disabled>
                                            @else
                                                <input id="{{ $pengajuan->id }}" type="checkbox" name="pengajuans[]" value="{{ $pengajuan->id }}" class="w-4 h-4 text-orange bg-gray-100 border-gray-300 rounded focus:ring-orange ">
                                            @endif
                                            <label for="{{ $pengajuan->id }}" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                @endif  
                                <td class="px-6 py-4 ">
                                {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 ">
                                {{ $pengajuan->nama }}
                                </td>
                                </td>
                                <td class="px-6 py-4">
                                {{ $pengajuan->no_ktp }}
                                </td>
                                <td class="px-6 py-4">{{ $pengajuan->tanggal_mulai }} - {{ $pengajuan->tanggal_selesai }}</td>
                                <td class="px-6 py-4">{{ $pengajuan->tanggal_selesai }}</td>
                                <td class="px-6 py-4">
                                    @if (Auth::user()->role == 'admin')
                                        @if (isset($pengajuan->latest_status))
                                            <span class="bg-{{ $pengajuan->latest_status_color }}-300 text-black px-2 py-1 rounded">
                                                {{ $pengajuan->latest_status }}
                                            </span>
                                        @else
                                            <span class="bg-yellow-300 text-black px-2 py-1 rounded">
                                                Pending
                                            </span>
                                        @endif
                                    @else
                                        @if ($pengajuan->approved)
                                            <span class="bg-lime-300 text-black px-2 py-1 rounded">
                                                Approved
                                            </span>
                                        @elseif ($pengajuan->rejected)
                                            <span class="bg-red-300 text-black px-2 py-1 rounded">
                                                Rejected
                                            </span>
                                        @else
                                            <span class="bg-yellow-300 text-black px-2 py-1 rounded">
                                                Pending
                                            </span>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-6 py-4 justify-between flex">
                                        {{-- <div class="inline-flex space-x-2">
                                            <a href="{{ route('pengajuan.show', ['id' => $pengajuan->id]) }}"
                                                class="px-3 py-2 tracking-wider bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-150 ease-in-out flex items-center justify-center">
                                                <i class="fa-regular fa-folder-open mr-2"></i>
                                                Detail
                                            </a> 
                                        </div> --}}

                                    <!-- Modal toggle -->
                                    <button data-modal-target="default-modal{{ $pengajuan->id }}" data-modal-toggle="default-modal{{ $pengajuan->id }}" class="block text-white px-3 py-2 
                                        tracking-wider bg-blue-500 text-white rounded
                                        hover:bg-blue-600 focus:outline-none focus:ring-2
                                        focus:ring-blue-400 focus:ring-opacity-75 transition
                                        duration-150 ease-in-out flex items-center justify-center" type="button">
                                        <i class="fa-solid fa-eye mr-2"></i>
                                            View
                                        </a>
                                    </button>
                                    
                                    <!-- Main modal -->
                                    <!-- Modal structure -->
                                    <div id="default-modal{{ $pengajuan->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-6xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-blue-500 rounded-lg shadow dark:bg-gray-800">
                                                <!-- Modal header -->
                                                
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl items-center font-semibold text-white dark:text-white text-center w-full">
                                                        Details Pengajuan User
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent  hover:text-white rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal{{ $pengajuan->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"/></svg>
                                                        
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="bg-gray-100 flex items-center justify-center max-h-screen">
                                                    <div class="text-base mb-5 font-semibold text-black mt-10">
                                                    <table>
                                                        <tr>
                                                            <td class="py-2 px-6 ">Nama Pengaju</td>
                                                            <td class="py-2 px-4 "> : {{ $pengajuan->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-6 ">No HandPhone</td>
                                                            <td class="py-2 px-4 "> : {{ $pengajuan->no_hp }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-6 ">Unit Kerja</td>
                                                            <td class="py-2 px-4 "> : {{ $pengajuan->unit_kerja }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-6">Area</td>
                                                            <td class="py-2 px-4"> : {{ $pengajuan->area }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-6 ">Nama Perusahaan/Instansi</td>
                                                            <td class="py-2 px-4 "> : {{ $pengajuan->nama_perusahaan }}</td>
                                                        </tr>
                                                        
                                                    </table>
                                                
                                                        <div class="text-center mt-5 text-lg border-t font-medium  rounded-lg px-4 py-2 text-black">
                                                            <span class="mt-10">
                                                                ATTACHMENT
                                                            </span>
                                                        </div>
                                                            <div class="px-4 py-5 sm:p-6 text-center">
                                                                <!-- Document photos -->
                                                                

                                                            <div class="sm:hidden">
                                                                <label for="tabs" class="sr-only">Document</label>
                                                                <select id="tabs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                    <option>Foto KTP</option>
                                                                    <option>Kartu Vaksin</option>
                                                                    <option>setting</option>
                                                                    <option>Invoioce</option>
                                                                </select>
                                                            </div>
                                                                <ul class="hidden flex text-sm  font-medium text-center text-gray-500 rounded-sm shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
                                                                    <li class="w-full sm:w-auto focus-within:z-10">
                                                                        <a href="{{ asset('storage/foto_ktp/' . $pengajuan->foto_ktp) }}" target="_blank" rel="noopener noreferrer" class="block w-full py-5 px-4 text-gray-900 bg-gray-100 hover:bg-gray-50 border-r border-gray-200 dark:border-gray-700 rounded-l-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none dark:bg-gray-700 dark:text-white" aria-current="page">Foto KTP</a>
                                                                    </li>
                                                                    <li class="w-full sm:w-auto focus-within:z-10">
                                                                        <a href="{{ asset('storage/kartu_vaksin/' . $pengajuan->kartu_vaksin) }}" target="_blank" rel="noopener noreferrer" class="block w-full py-5 px-4 text-gray-900  border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Kartu Vaksin</a>
                                                                    </li>
                                                                    <li class="w-full sm:w-auto focus-within:z-10">
                                                                        <a href="{{ asset('storage/skck/' . $pengajuan->skck) }}" target="_blank" rel="noopener noreferrer" class="block w-full py-5 px-4 text-gray-900  border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">SKCK</a>
                                                                    </li>
                                                                    <li class="w-full sm:w-auto focus-within:z-10">
                                                                        <a href="{{ asset('storage/bebas_narkoba/' . $pengajuan->bebas_narkoba) }}" target="_blank" rel="noopener noreferrer" class="block w-full py-5 px-6 text-gray-900  border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">SURAT BEBAS NARKOBA</a>
                                                                    </li>
                                                                    <li class="w-full sm:w-auto focus-within:z-10">
                                                                        <a href="{{ asset('storage/surat_kesehatan/' . $pengajuan->surat_kesehatan) }}" target="_blank" rel="noopener noreferrer" class="block w-full py-5 px-4 text-gray-900 bg-gray-100 border-gray-200 dark:border-gray-700 hover:bg-gray-50 rounded-r-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none dark:bg-gray-700 dark:text-white">SURAT KESEHATAN</a>
                                                                    </li>
                                                                    <li class="w-full sm:w-auto focus-within:z-10">
                                                                        <a href="{{ asset('storage/surat_keterangan_user/' . $pengajuan->surat_keterangan_user) }}" target="_blank" rel="noopener noreferrer" class="block w-full py-5 px-4 text-gray-900 bg-gray-100 border-gray-200 dark:border-gray-700 hover:bg-gray-50 rounded-r-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none dark:bg-gray-700 dark:text-white">SURAT KETERANGAN USER</a>
                                                                    </li>
                                                                </ul>
                                                                
                                                                <h3 class="mt-10 text-base font-semibold">DATA</h3>

                                                                <table class="w-full text-md font-semibold text-left rtl:text-right text-gray dark:text-gray-400 mt-10">
                                                                    <tr>
                                                                        <td class="px-2 py-3">Nama Tamu</td>
                                                                        <td class="px-2 py-3"> : {{ $pengajuan->nama }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="px-2 py-3">NIK</td>
                                                                        <td class="px-2 py-3"> : {{ $pengajuan->no_ktp }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="px-2 py-3">No HandPhone</td>
                                                                        <td class="px-2 py-3"> : {{ $pengajuan->no_hp}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="px-2 py-2">Keperluan</td>
                                                                        @if ($pengajuan->keperluan == "other")
                                                                            <td class="capitalize">  : {{ $pengajuan->keperluan_lainnya }}</td>
                                                                        @else
                                                                            <td class="capitalize">  : {{ $pengajuan->keperluan }}</td>
                                                                        @endif
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="px-2 py-2">Tujuan Berkunjung</td>
                                                                        @if ($pengajuan->tujuan == "other")
                                                                            <td class="capitalize">     : {{ $pengajuan->tujuan_lainnya }}</td>
                                                                        @else
                                                                            <td class="capitalize">     : {{ $pengajuan->tujuan }}</td>
                                                                        @endif
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="px-2 py-3">Tanggal Kunjungan</td>
                                                                        <td class="px-2 py-3"> : {{ $pengajuan->tanggal_mulai }} - {{ $pengajuan->tanggal_selesai }}</td>
                                                                    </tr>
                                                                </table>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="flex flex-col items-center justify-start p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                        <!-- Buttons container -->
                                                        <div class="flex justify-between  w-full space-x-4 mt-4">
                                                            {{-- button back --}}
                                                            <button data-modal-hide="default-modal{{ $pengajuan->id }}" type="button" class="btn"> 
                                                                <i class="fa-solid fa-arrow-left mr-2"></i>Back
                                                            </button>
                                                            {{-- button reject --}}
                                                            @if(Auth::user()->role != 'admin' && Auth::user()->role != 'user')
                                                                <button data-modal-target="reject_modal{{ $pengajuan->id }}" data-modal-toggle="reject_modal{{ $pengajuan->id }}" class="btn-4">
                                                                    <i class="fa-solid fa-user-xmark mr-2"></i>Reject
                                                                </button>
                                                            @endif
                                                            {{-- button delete --}}
                                                            @if (Auth::user()->role == 'admin')
                                                                <button data-modal-target="delete_modal{{ $pengajuan->id }}" data-modal-toggle="delete_modal{{ $pengajuan->id }}" class="btn-2">
                                                                    <i class="fa-solid fa-trash-can mr-2"></i>Delete
                                                                </button>
                                                            @endif
                                                            {{-- button accept --}}
                                                            @if (Auth::user()->role != 'admin' && Auth::user()->role != 'user')
                                                                <button data-modal-target="approve_modal{{ $pengajuan->id }}" data-modal-toggle="approve_modal{{ $pengajuan->id }}" class="btn-3">
                                                                    <i class="fa-solid fa-user-check mr-2"></i>Accept
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                            </div>   
                                            </div>
                                        </div>
                                    </div>
                                    @if(Auth::user()->role != 'admin' && Auth::user()->role != 'user')                                     
                                        {{-- approve modal --}}
                                        <div id="approve_modal{{ $pengajuan->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="approve_modal{{ $pengajuan->id }}">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="p-4 md:p-5 text-center">
                                                            <form action="{{ route('pengajuan.approve', $pengajuan->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                <input type="hidden" name="approval_status" value="approved">
                                                            
                                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                                </svg>
                                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to approve this aplicant</h3>
                                                                <button data-modal-hide="approve_modal{{ $pengajuan->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                    Yes, I'm sure
                                                                </button>
                                                                <button data-modal-hide="approve_modal{{ $pengajuan->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        {{-- reject modal --}}
                                        <div id="reject_modal{{ $pengajuan->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="reject_modal{{ $pengajuan->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <form action="{{ route('pengajuan.approve', $pengajuan->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            <input type="hidden" name="approval_status" value="rejected">
                                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                            </svg>
                                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to reject this aplicant</h3>
                                                            <button data-modal-hide="reject_modal{{ $pengajuan->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                Yes, I'm sure
                                                            </button>
                                                            <button data-modal-hide="reject_modal{{ $pengajuan->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if (Auth::user()->role == 'admin')
                                        <div id="delete_modal{{ $pengajuan->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete_modal{{ $pengajuan->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <form action="{{ route('pengajuan.delete', $pengajuan->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="approval_status" value="approved">
                                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                            </svg>
                                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this aplicant</h3>
                                                            <button data-modal-hide="delete_modal{{ $pengajuan->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                Yes, I'm sure
                                                            </button>
                                                            <button data-modal-hide="delete_modal{{ $pengajuan->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                   
                                </td>                                
                            </tr>
                        @endforeach
                        <!-- many approve 2nd part -->
                        @if (Auth::user()->role != 'admin')
                            <tr>
                                <td colspan="12">
                                    <button data-modal-target="approve_modal" data-modal-toggle="approve_modal" class="text-sm focus:ring-2 focus:ring-lime-200 focus:ring-opacity-80 transition duration-100 ease-in-out bg-lime-500 hover:bg-lime-400 text-white hover:text-black font-bold px-4 py-2 rounded mt-5" type="button">
                                        <i class="fas fa-check mr-2"></i>Approve
                                    </button>
                                </td>
                            </tr>
                                <div id="approve_modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="approve_modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to approve it</h3>
                                                <button id="submitBtn" data-modal-hide="approve_modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Yes, I'm sure
                                                </button>
                                                <button data-modal-hide="approve_modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- </form> --}}
                        @endif                
                    </tbody>
                </table>         
            </div>           
        </div>
    </div>


        <script>
        document.getElementById('submitBtn').addEventListener('click', function () {
            // Dapatkan semua checkbox yang dipilih
            let checkboxes = document.querySelectorAll('input[name="pengajuans[]"]:checked');
            let selectedIds = Array.from(checkboxes).map(cb => cb.value);

            // Dapatkan nilai perusahaan
            let perusahaan = "{{ $perusahaan }}";

            // Kirim data ke server
            fetch(`{{ route('pengajuan.manyApprove', ['perusahaan' => $perusahaan]) }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Jangan lupa untuk menambahkan token CSRF
                },
                body: JSON.stringify({ ids: selectedIds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Arahkan pengguna kembali ke halaman perusahaan jika perlu
                    window.location.href = `{{ route('perusahaan', ['perusahaan' => $perusahaan]) }}`;
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim data.');
            });
        });
    </script>