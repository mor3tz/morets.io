<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white leading-tight">
            {{ __('Detail Pengajuan Badge') }}
        </h2>
    </x-slot>

    <!-- Main content container -->
    <div class="bg-gray-100 py-8 px-4 md:px-6 lg:px-10 pt-3">
        <div class="max-w-3xl mx-auto">

            <!-- Card for personal information -->
            <div class="bg-white rounded-lg overflow-hidden shadow-xl">
                <!-- Profile header -->

                <div class="bg-gray-800 px-4 py-5 sm:px-6">
                    <h3 class="text-bold leading-6 font-medium text-lg text-white text-center">
                        INFORMASI PEMOHON
                    </h3>
                </div>

                <div class="px-4 py-5 sm:p-6">
                    <!-- Personal information -->
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <tbody>
                                <tr>
                                    <td class="font-semibold px-4 py-2">Nama :</td>
                                    <td class="px-4 py-2">{{ $pengajuan->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold px-4 py-2">Unit Kerja :</td>
                                    <td class="px-4 py-2">{{ $pengajuan->unit_kerja }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold px-4 py-2">No. KTP :</td>
                                    <td class="px-4 py-2">{{ $pengajuan->no_ktp }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold px-4 py-2">Area :</td>
                                    <td class="px-4 py-2">{{ $pengajuan->area }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold px-4 py-2">Nama Perusahaan :</td>
                                    <td class="px-4 py-2">{{ $pengajuan->nama_perusahaan }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold px-4 py-2">Lama Bekerja :</td>
                                    <td class="px-4 py-2">{{ $pengajuan->lama_bekerja }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold px-4 py-2">Tanggal Mulai Bekerja :</td>
                                    <td class="px-4 py-2">{{ $pengajuan->tanggal_mulai }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold px-4 py-2">Status :</td>
                                    @if (isset($pengajuan->latest_status))
                                        <td class="font-semibold px-4 py-2">
                                            <span class="bg-{{ $pengajuan->latest_status_color }}-300 text-black px-2 py-1 rounded">
                                                {{ $pengajuan->latest_status }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="px-4 py-2">
                                            <span class="bg-yellow-300  px-2 py-1 rounded uppercase">{{ $pengajuan->status }}</span>
                                        </td>
                                    @endif
                                   
                                </tr>

                                @foreach ($pengajuan->approvals as $approval)
                                <tr>
                                    
                                        
                                    <td class="px-4 py-2">
                                        <span class="bg-yellow-300 text-yellow-800 px-2 py-1 rounded">{{ $approval->approver_role }}</span>
                                        <span class="bg-yellow-300 text-yellow-800 px-2 py-1 rounded">{{ $approval->approval_status }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Document photos card -->
            <div class="bg-white rounded-lg overflow-hidden shadow-xl mt-6">
                <!-- Document photos header -->
                <div class="bg-gray-800 px-4 py-5 sm:px-6">
                    <h3 class="text-bold leading-6 font-medium text-lg text-white text-center">
                        DOCUMENT
                    </h3>
                </div>

                <div class="px-4 py-5 sm:p-6 text-center">
                    <!-- Document photos -->
                    <div class="flex flex-col items-center space-y-4">
                        <div>
                            <p class="font-semibold">Foto KTP</p>
                            <img src="{{ asset('storage/foto_ktp/' . $pengajuan->foto_ktp) }}" alt="Foto KTP" class="max-w-xs h-auto mx-auto rounded-lg shadow">
                        </div>
                        <div>
                            <p class="font-semibold">Kartu Vaksin</p>
                            <img src="{{ asset('storage/kartu_vaksin/' . $pengajuan->kartu_vaksin) }}" alt="Kartu Vaksin" class="max-w-xs h-auto mx-auto rounded-lg shadow">
                        </div>
                    </div>
                </div>   
            </div>

            {{-- modal button --}}
            @if(Auth::user()->role != 'admin' &&  Auth::user()->role != 'user')
                @if (!$pengajuan->approvals->contains('approver_role', Auth::user()->role))
                    <div class="flex justify-end gap-3">
                        {{-- reject_button --}}
                        <button data-modal-target="reject_modal" data-modal-toggle="reject_modal" class="block mt-5 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button">
                            reject
                        </button>

                        {{-- approve_button --}}
                        <button data-modal-target="approve_modal" data-modal-toggle="approve_modal" class="block mt-5 text-white bg-lime-600 hover:bg-lime-700 focus:ring-4 focus:outline-none focus:ring-lime-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800" type="button">
                            Approve
                        </button>
                    </div>
                @endif
            @endif

            
            
        </div>
    </div>
    
    @if(Auth::user()->role != 'admin' &&  Auth::user()->role != 'user')
    {{-- approve modal --}}
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
                    <form action="{{ route('pengajuan.approve', $pengajuan->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="approval_status" value="approved">
                    
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to approve this aplicant</h3>
                        <button data-modal-hide="approve_modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Yes, I'm sure
                        </button>
                        <button data-modal-hide="approve_modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- reject modal --}}
    <div id="reject_modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="reject_modal">
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
                        <button data-modal-hide="reject_modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Yes, I'm sure
                        </button>
                        <button data-modal-hide="reject_modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center p-4 mt-8">
        <div class="container mx-auto">
            <p>&copy; {{ date('Y') }} - All rights reserved.</p>
            <p>Powered by | Cheat-Codes Teams</p>
        </div>
    </footer>
</x-app-layout>
