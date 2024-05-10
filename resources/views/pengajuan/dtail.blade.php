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
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div class="flex items-center">
                            <span class="font-semibold mr-2">Nama :</span>
                            <span>{{ $pengajuan->nama }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-semibold mr-2">Unit Kerja :</span>
                            <span>{{ $pengajuan->unit_kerja }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-semibold mr-2">No. KTP :</span>
                            <span>{{ $pengajuan->no_ktp }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-semibold mr-2">Area :</span>
                            <span>{{ $pengajuan->area }}</span>
                        </div>
                        <div class="col-span-2 flex items-center">
                            <span class="font-semibold mr-2">Nama Perusahaan :</span>
                            <span>{{ $pengajuan->nama_perusahaan }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-semibold mr-2">Lama Bekerja :</span>
                            <span>{{ $pengajuan->lama_bekerja }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-semibold mr-2">Tanggal Mulai Bekerja :</span>
                            <span>{{ $pengajuan->tanggal_mulai }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-semibold mr-2">Status :</span>
                            <span class="bg-yellow-300 text-yellow-800 px-2 py-1 rounded">{{ $pengajuan->status }}</span>
                        </div>
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

                <div class="px-4 py-5 sm:p-6">
                    <!-- Document photos -->
                    <div class="flex justify-center space-x-10">
                        <div class="text-center">
                            <p class="font-semibold">Foto KTP</p>
                            <img src="{{ asset('storage/foto_ktp/' . $pengajuan->foto_ktp) }}" alt="Foto KTP" class="w-32 h-32 rounded-lg shadow">
                        </div>
                        <div class="text-center">
                            <p class="font-semibold">Kartu Vaksin</p>
                            <img src="{{ asset('storage/kartu_vaksin/' . $pengajuan->kartu_vaksin) }}" alt="Kartu Vaksin" class="w-32 h-32 rounded-lg shadow">
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
