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

                <div class="bg-gradient-to-r from-blue-500 to-blue-700 px-4 py-5 sm:px-6">
                    <h3 class="text-bold leading-6 font-medium text-lg text-black text-center">
                        Informasi Pemohon
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
                                    <td class="px-4 py-2">
                                        <span class="bg-yellow-300 text-yellow-800 px-2 py-1 rounded">{{ $pengajuan->status }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Document photos card -->
            <div class="bg-white rounded-lg overflow-hidden shadow-xl mt-6">
                <!-- Document photos header -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-700 px-4 py-5 sm:px-6">
                    <h3 class="text-bold leading-6 font-medium text-lg text-black text-center">
                        Document
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
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center p-4 mt-8">
        <div class="container mx-auto">
            <p>&copy; {{ date('Y') }} - All rights reserved.</p>
            <p>Powered by | Cheat-Codes Teams</p>
        </div>
    </footer>
</x-app-layout>
