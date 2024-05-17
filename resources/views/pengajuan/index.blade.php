<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-white text-xl leading-tight flex justify-between items-center">
            {{ __('PENGAJUAN BADGE') }}
            <div class="text-right text-sm">
                {{ __('FUTURE IS OURS') }}
            </div>
        </h2>
    </x-slot>


    <div class="container mx-auto px-4 sm:px-6 lg:px-10 bg-white-custom">
      <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="max-w-3xl mx-auto">
          @csrf
          <div class="border-b border-gray-900/10 pb-12 py-10">
              <h2 class="text-base font-semibold leading-7 text-gray-900 text-center">PERSONAL INFORMATION</h2>
              <p class="mt-1 text-sm leading-6 text-gray-600 text-center">Silahkan Melengkapi Data Diri Anda.</p>
          
              <div class="mt-10 grid grid-cols-1 gap-y-8 sm:grid-cols-1 sm:gap-x-6">
                  <div>
                      <label for="first-name" class="block text-bold font-medium leading-6 text-gray-900 mt-3">Nama</label>
                      <input required type="text" name="nama" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-gray-300 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                  </div>
                  <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                  <div>
                      <label for="no_ktp" class="block text-bold font-medium leading-6 text-gray-900 mt-3">No. KTP</label>
                      <input required type="text" name="no_ktp" id="no_ktp" autocomplete="family-name" class="block w-full rounded-md border-gray-300 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                  </div>
                  <x-input-error :messages="$errors->get('no_ktp')" class="mt-2" />
              </div>
            
              <div class="mt-8 sm:col-span-2">
                <label for="foto_ktp" class="block text-bold font-medium leading-6 text-gray-900">Fotocopy KTP</label>
                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                    <label for="foto_ktp" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-600 hover:text-indigo-500">
                        <span id="upload-text-ktp">Upload a file</span>
                        <input required id="foto_ktp" name="foto_ktp" type="file" class="sr-only" onchange="showUploadFileName('ktp')">
                    </label>
                </div>
                <x-input-error :messages="$errors->get('foto_ktp')" class="mt-2" />
                <p id="file-name-ktp" class="mt-2 text-sm text-gray-600"></p>
            </div>
            
            <div class="mt-8 sm:col-span-2">
                <label for="kartu_vaksin" class="block text-bold font-medium leading-6 text-gray-900">Kartu Vaksin Booster</label>
                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                    <label for="kartu_vaksin" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-600 hover:text-indigo-500">
                        <span id="upload-text-vaksin">Upload a file</span>
                        <input required id="kartu_vaksin" name="kartu_vaksin" type="file" class="sr-only" onchange="showUploadFileName('vaksin')">
                    </label>
                </div>
                <x-input-error :messages="$errors->get('kartu_vaksin')" class="mt-2" />
                <p id="file-name-vaksin" class="mt-2 text-sm text-gray-600"></p>
            </div>
            
  
              <!-- Area field -->
              <div>
                  <label for="country" class="block text-bold font-medium leading-6 text-gray-900 mt-8">Area</label>
                  <select id="country" name="area" autocomplete="country-name" class="block w-full rounded-md border-gray-300 py-2 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                      <option>Kantor</option>
                      <option>Pabrik</option>
                  </select>
                  <x-input-error :messages="$errors->get('area')" class="mt-2" />
              </div>
  
              <!-- Unit Kerja field -->
              <div>
                  <label for="first-name" class="block text-bold font-medium leading-6 text-gray-900 mt-8">Unit Kerja</label>
                  <input required type="text" name="unit_kerja" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-gray-300 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                  <x-input-error :messages="$errors->get('unit_kerja')" class="mt-2" />
                </div>
  
              <!-- Nama Perusahaan field -->
              <div>
                  <label for="first-name-1" class="block text-bold font-medium leading-6 text-gray-900 mt-8">Nama Perusahaan</label>
                  <input required type="text" name="nama_perusahaan" id="first-name-1" autocomplete="given-name" class="block w-full rounded-md border-gray-300 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                  <x-input-error :messages="$errors->get('nama_perusahaan')" class="mt-2" />
              </div>
  
              <!-- Lama Bekerja field -->
              <div>
                  <label for="first-name-2" class="block text-bold font-medium leading-6 text-gray-900 mt-8">Berapa Lama Bekerja</label>
                  <input required type="text" name="lama_bekerja" id="first-name-2" autocomplete="given-name" class="block w-full rounded-md border-gray-300 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                  <x-input-error :messages="$errors->get('lama_bekerja')" class="mt-2" />
              </div>
  
              <!-- Tanggal Mulai Bekerja field -->
              <div>
                  <label for="first-name-2" class="block text-bold font-medium leading-6 text-gray-900 mt-8">Tanggal Mulai Bekerja</label>
                  <input required type="date" name="tanggal_mulai" id="first-name-2" autocomplete="given-name" class="block w-full rounded-md border-gray-300 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                  <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-2" />
              </div>
  
          </div>
  
          <div class="mt-6 flex justify-end">
              <button type="button" class="rounded-md px-5 py-3 shadow-sm text-sm font-semibold leading-6 text-gray-900 hover:bg-red-700" onclick="window.location.href='/home';">Cancel</button>
              <button type="submit" class="rounded-md bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 ml-4">Save</button>
          </div>
      </form>
  </div>
  
  <footer class="bg-gray-800 text-white text-center p-4 mt-8">
      <div class="container mx-auto">
          <p>&copy; {{ date('Y') }} - All rights reserved.</p>
          <p>Powered by | Cheat-Codes Teams</p>
      </div>
  </footer>
  

</x-app-layout>
