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
                @if (Auth::user()->role == 'user')
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Nama Perusahaan</th>
                    <th scope="col" class="px-6 py-3">Unit Kerja</th>
                    <th scope="col" class="px-6 py-3">Area</th>
                    <th scope="col" class="px-6 py-3">No KTP</th>
                    <th scope="col" class="px-6 py-3">Berapa Lama Bekerja</th>
                    <th scope="col" class="px-6 py-3">Tanggal Mulai Bekerja</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
                @else
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Perusahaan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
    
                </tr>
                @endif
            </thead>
            <tbody>
                @if (Auth::user()->role == 'user')
                    @foreach ($pengajuans as $pengajuan)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pengajuan->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pengajuan->nama_perusahaan }}
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
                                {{ $pengajuan->status }}
                            </td>
                            <!-- modal progress -->
                           
                                <!-- Modal toggle -->
                                <td class="px-6 py-4 ">
                                    <button data-modal-target="dtail{{ $pengajuan->id }}" data-modal-toggle="dtail{{ $pengajuan->id }}" class="block text-blue-500 hover:text-blue-600   font-medium  text-sm text-center " type="button">
                                        Progress
                                    </button>
                                </td>
                                
                                <!-- modal progress -->
                                <div id="dtail{{ $pengajuan->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <span>
                                                        Pengajuan atas nama &nbsp;
                                                    </span>
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $pengajuan->nama }}
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="dtail{{ $pengajuan->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5">
                                                    @if ($pengajuan->approvals->count() != 0)
                                                        <ol class="relative border-s border-gray-200 dark:border-gray-600 ms-3.5 mb-4 md:mb-5">          
                                                            @foreach ($pengajuan->approvals as $approval) 
                                                                <li class="mb-10 ms-8">            
                                                                    <span class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -start-3.5 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                                        <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                                    </span>
                                                                    <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                                                        @if ($approval->approver_role == 'kabag')
                                                                            Kepala Bagian
                                                                        @elseif ($approval->approver_role == 'vp')
                                                                            VP
                                                                        @elseif ($approval->approver_role == 'avp')
                                                                            AVP
                                                                        @elseif ($approval->approver_role == 'svp_operation')
                                                                            SVP Operation
                                                                        @elseif ($approval->approver_role == 'vp_security')
                                                                            VP Security
                                                                        @endif
                                                                    </h3>
                                                                        @if ($approval->approval_status == 'approved')
                                                                            <h2 class="text-green">Approved</h2>
                                                                        @elseif ($approval->approval_status == 'rejected')
                                                                            <h2 class="text-red-500">Rejected</h2>
                                                                        @endif
                                                                        
                                                                
                                                                        <time class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">
                                                                            {{ \Carbon\Carbon::parse($approval->approval_date)->format('d F Y H:i:s') }}
                                                                        </time>
                                                                    
                                                                </li>
                                                            @endforeach
                                                        </ol>
                                                    @endif
                                                    @if ($pengajuan->approvals->count() == 0)
                                                        <h5 class="text-sm text-center">Belum ada Approval</h>
                                                    @endif
                                                
                                                </div>
                                            </div>
                                    </div>
                                </div> 
                            
                        </tr>
                    @endforeach
                @else
                @foreach ($pengajuans as $pengajuan)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                           {{ $pengajuan }}
                        </td>
                        <td class="px-6 py-4">
                            status
                        </td>
                        <td class="px-6 py-4">
                            button dtail
                        </td>
                    </tr>
                @endforeach
                @endif
    
            </tbody>
        </table>
    </div>
   
</div>

