<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-white text-xl leading-tight flex justify-between items-center">
            {{ __('DETAIL PENGAJUAN BADGE' ) }}
            <div class="text-right text-sm">
                {{ __('FUTURE IS OURS') }}
            </div>
        </h2>
    </x-slot>

    <div>
        {{ $pengajuan->nama }}
        {{ $pengajuan->unit_kerja }}
        {{ $pengajuan->no_ktp }}
        foto ktp:
        <img src="{{ asset('storage/foto_ktp/' . $pengajuan->foto_ktp) }}" alt="Foto KTP">
        kartu vaksin:
        <img src="{{ asset('storage/kartu_vaksin/' . $pengajuan->kartu_vaksin) }}" alt="Foto KTP">
        {{ $pengajuan->area}}
        {{ $pengajuan->nama_perusahaan}}
        {{ $pengajuan->lama_bekerja }}
        {{ $pengajuan->tanggal_mulai }}
        {{ $pengajuan->status }}
       
    </div>


  
 {{-- Footer --}}
 <footer class="bg-gray-800 text-white text-center p-4">
    <div class="container mx-auto">
        <p>&copy; {{ date('Y') }} - All rights reserved.</p>
        <p>Powered by | Cheat-Codes Teams</p>
    </div>
</footer>

</x-app-layout>
