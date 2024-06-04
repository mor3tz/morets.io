<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:model.live.debounce300ms="search" type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">               
                <tr>
                    @if (Auth::user()->role != 'admin')
                        <th class="px-6 py-3 border-b border-gray-200 text-gray-800 text-left text-xs font-semibold uppercase tracking-wider">
                        </th>
                    @endif                   
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Unit Kerja</th>
                    <th scope="col" class="px-6 py-3">Area</th>
                    <th scope="col" class="px-6 py-3">No KTP</th>
                    <th scope="col" class="px-6 py-3">Berapa Lama Bekerja</th>
                    <th scope="col" class="px-6 py-3">Tanggal Mulai Bekerja</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>               
            </thead>
            <tbody>
                <!-- many approve 1st part -->
                @if (Auth::user()->role != 'admin')
                    <form action="{{ route('pengajuan.manyApprove', ['perusahaan' => $perusahaan]) }}" method="POST">
                        @csrf
                @endif                              
                @foreach ($pengajuan as $pengajuan)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
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
                        <td class="px-6 py-4">
                           {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                           {{ $pengajuan->nama }}
                        </td>
                        <td class="px-6 py-4">
                           {{ $pengajuan->unit_kerja }}
                        </td>
                        <td class="px-6 py-4">
                           {{ $pengajuan->area }}
                        </td>
                        <td class="px-6 py-4">
                           {{ $pengajuan->no_ktp }}
                        </td>
                        <td class="px-6 py-4">
                           {{ $pengajuan->lama_bekerja }}
                        </td>
                        <td class="px-6 py-4">
                           {{ $pengajuan->tanggal_mulai }}
                        </td>
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
                        <td class="px-6 py-4">
                            <div><a href="{{ route('pengajuan.show', ['id' => $pengajuan->id]) }}"
                                class="text-blue-500 hover:text-blue-600"> Detail</a></div>
                        </td>
                    </tr>
                @endforeach
                <!-- many approve 2nd part -->
                @if (Auth::user()->role != 'admin')
                    <tr>
                        <td colspan="12">
                            <button data-modal-target="approve_modal" data-modal-toggle="approve_modal" class="text-sm bg-orange text-white px-4 py-2 rounded mt-5" type="button">
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
                                    <button data-modal-hide="approve_modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Yes, I'm sure
                                    </button>
                                    <button data-modal-hide="approve_modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                @endif                
            </tbody>
        </table>
    </div>
</div>
