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
                @foreach ($pengajuan as $pengajuan)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
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
            </tbody>
        </table>
    </div>
</div>
