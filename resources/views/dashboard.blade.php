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
                    @if ($role == 'admin')
                       
                    <!-- Button for creating new file -->
                    <div class="mt-4 flex space-x-4">
                        <a href="{{ route('pengajuan') }}" class="px-4 py-2 bg-green text-white font-bold text-xs uppercase rounded hover:bg-orange transition duration-300 ease-in-out">
                            + New File
                        </a>    
                    </div>
                    @endif

                    

                    <!-- Data Table -->
                    <div class="mt-4">
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
                                    @if ($role == 'admin')
                                    <th class="px-6 py-3 border-b border-gray-200 text-gray-800 text-left text-xs font-semibold uppercase tracking-wider">
                                        Actions
                                    </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                            
                                @foreach ($pengajuan as $pengajuan)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm">
                                            {{ $pengajuan->nama }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm">
                                            {{ $pengajuan->unit_kerja }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm">
                                            {{ $pengajuan->nama_perusahaan }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm">
                                            {{ $pengajuan->area }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm">
                                            {{ $pengajuan->no_ktp }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm">
                                            {{ $pengajuan->lama_bekerja }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm">
                                            {{ $pengajuan->tanggal_mulai }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm">
                                            <div class="flex items-center justify-start">
                                                <span class="bg-yellow-300 text-black px-2 py-1 rounded">
                                                    Approved
                                                </span>
                                            </div>
                                        </td>
                                        @if ($role == 'admin')
                                        <td class="px-6 py-5 border-b border-gray-200 text-sm">
                                            <div><a href="{{ route('pengajuan.show', ['id' => $pengajuan->id]) }}"
                                                 class="text-blue-500 hover:text-blue-600"> Detail</a></div>
                                            <div><a href="#" class="text-red-500 hover:text-red-600">Delete</a></div>
                                        </td>
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
