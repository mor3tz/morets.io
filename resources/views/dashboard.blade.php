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
        <div class="max-w-10-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg min-h-[600px]">
                <div class="p-6 text-gray-600">
                    {{ __(" Dashboard Pengajuan Badge") }}
                    @if (Auth::user()->role == 'admin')
                
                    <!-- Button for creating new file -->
                    <div class="mt-4 flex space-x-4">
                        <a href="{{ route('pengajuan') }}" class="px-4 py-2 bg-green text-white font-bold text-xs uppercase rounded hover:bg-orange transition duration-300 ease-in-out">
                            + New File
                        </a>    
                    </div>
                    @endif

                    

                    <!-- Data Table -->
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 text-gray-800 text-left text-xs font-semibold uppercase tracking-wider">
                                        No
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-gray-800 text-left text-xs font-semibold uppercase tracking-wider">
                                        Nama
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-gray-800 text-left text-xs font-semibold uppercase tracking-wider">
                                        Unit Kerja
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-gray-800 text-left text-xs font-semibold uppercase tracking-wider">
                                        Nama Perusahaan
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-gray-800 text-left text-xs font-semibold uppercase tracking-wider">
                                        Area
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-gray-800 text-left text-xs font-semibold uppercase tracking-wider">
                                        No KTP
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-gray-800 text-left text-xs font-semibold uppercase tracking-wider">
                                        Berapa Lama Bekerja
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-gray-800 text-left text-xs font-semibold uppercase tracking-wider">
                                        Tanggal Mulai Bekerja
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-gray-800 text-left text-xs font-semibold uppercase tracking-wider">
                                        Status
                                    </th>
                                    {{-- @if (Auth::user()->role != 'user') --}}
                                    <th class="px-6 py-3 border-b border-gray-200 text-gray-800 text-left text-xs font-semibold uppercase tracking-wider">
                                        Actions
                                    </th>
                                    {{-- @endif --}}
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                            
                                @foreach ($pengajuan as $pengajuan)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm whitespace-nowrap">
                                            {{ $pengajuan->nama }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm whitespace-nowrap">
                                            {{ $pengajuan->unit_kerja }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm whitespace-nowrap">
                                            {{ $pengajuan->nama_perusahaan }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm whitespace-nowrap">
                                            {{ $pengajuan->area }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm whitespace-nowrap">
                                            {{ $pengajuan->no_ktp }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm whitespace-nowrap">
                                            {{ $pengajuan->lama_bekerja }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm whitespace-nowrap">
                                            {{ $pengajuan->tanggal_mulai }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm whitespace-nowrap">
                                            <div class="flex items-center justify-start">
                                                <span class="bg-yellow-300 text-black px-2 py-1 rounded">
                                                    Pending
                                                </span>
                                            </div>
                                        </td>
                                        @if (Auth::user()->role != 'user')
                                        <td class="px-6 py-5 border-b border-gray-200 text-sm whitespace-nowrap">
                                            <div><a href="{{ route('pengajuan.show', ['id' => $pengajuan->id]) }}"
                                                class="text-blue-500 hover:text-blue-600"> Detail</a></div>
                                            @if (Auth::user()->role == 'admin')
                                            <div><a href="#" class="text-red-500 hover:text-red-600">Delete</a></div>
                                            @endif
                                        </td>
                                        @endif


                                        @if (Auth::user()->role == 'user')
                                            <!-- Modal toggle -->
                                            <td>
                                                <button data-modal-target="dtail{{ $pengajuan->id }}" data-modal-toggle="dtail{{ $pengajuan->id }}" class="block text-blue-500 hover:text-blue-600   font-medium  text-sm px-5 py-2.5 text-center " type="button">
                                                progress
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
                                                                                    @elseif ($approval->approver_role == 'svp_security')
                                                                                        SVP Security
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
                                        @endif
                                    </tr>
                                @endforeach
                                
                                <!-- Additional rows can be added here -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
