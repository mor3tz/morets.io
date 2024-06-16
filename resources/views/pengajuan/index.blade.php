<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-white text-xl leading-tight flex justify-between items-center">
            {{ __('PENGAJUAN BADGE') }}
            <div class="text-right text-sm">
                <i class="fa-solid fa-hashtag"></i>
                {{ __('FUTURE IS OURS') }}
            </div>
        </h2>
    </x-slot> --}}

    <div class="bg-white-custom">
        <div class="container mx-auto px-4 sm:px-6 lg:px-10 bg-white-custom">
            <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="max-w-3xl mx-auto">
                @csrf
                <div class="border-b border-gray-900/10 pb-12 py-10">
                    <h2 class="text-base font-bold leading-7 text-gray-900 text-center">PERSONAL INFORMATION</h2>
                    <p class="mt-1 text-base font-semibold leading-6 text-gray-600 text-center">Silahkan Melengkapi Data Diri Anda.</p>
                
                    <div class="mt-10 grid grid-cols-1 gap-y-8 sm:grid-cols-1 sm:gap-x-6">                 
                    <div>
                        <label for="first-name" class="block text-bold font-medium leading-6 text-gray-900 mt-3">Nama </label>
                        <input required type="text" name="nama" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-gray-300 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        <div>
                            <label for="no_ktp" class="block text-bold font-medium leading-6 text-gray-900 mt-3">No. KTP</label>
                            <input required type="text" name="no_ktp" id="no_ktp" autocomplete="family-name" class="block w-full rounded-md border-gray-300 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <x-input-error :messages="$errors->get('no_ktp')" class="mt-2" />
                    </div>


                    <div class="mt-5  px-4 py-4 rounded-lg">
                        <h3 class="m-auto text-center tracking-wider
                         justify-center text-base font-bold"> LAMPIRAN / Attachment</h3>
                         
                         <p class=" text-center text-base font-semibold text-gray-600">Silahkan Lengkapi Lampiran di Bawah ini</p>
                    </div>
                    

                       <!-- Container utama -->
                       <!-- Foto KTP -->
                        <div class="flex space-x-4 mt-10">
                            <form class="">
                                <div class="w-1/2">
                                <label class="block text-sm font-medium text-gray-900 dark:text-white" for="foto_ktp">FOTO KTP</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="foto_ktp_help" id="foto_ktp" type="file">
                                <div class="text-sm text-gray-500 dark:text-gray-300" id="foto_ktp_help">Upload foto KTP Anda.</div>
                                </div>
                            </form>

                            <!-- Kartu Vaksin -->
                            
                            <form class="w-1/2">                               
                                <label class="block text-sm font-medium text-gray-900 dark:text-white" for="kartu_vaksin">KARTU VAKSIN</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="kartu_vaksin_help" id="kartu_vaksin" type="file">
                                <div class="text-sm text-gray-500 dark:text-gray-300" id="kartu_vaksin_help">Upload kartu vaksin Anda.</div>  
                            </form>
                        </div>

                        <div class="flex space-x-4 mt-10">
                            <form class="w-1/2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">SURAT KESEHATAN</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">
                                <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help"></div>
                            </form>
                            <form class="w-1/2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">SURAT BEBAS NARKOBA</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">
                                <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help"></div>
                            </form>
                        </div>
  
                        
                        <form class="max-w-lg mx-auto">
                            <label class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">SKCK</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">
                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help"></div>
                        </form>
  
        
                    <!-- Area field -->
                    <div class="flex space-x-4 mt-10">
                        <div class="w-1/2">
                            <label for="area" class="block text-sm font-medium leading-6 text-gray-900">AREA</label>
                            <select id="area" name="area" autocomplete="country-name" class="block w-full rounded-md border-gray-300 py-2 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option>Kantor</option>
                                <option>Pabrik</option>
                            </select>
                            <x-input-error :messages="$errors->get('area')" class="mt-2" />
                        </div>
                        
                        <!-- Keperluan -->
                        <div class="w-1/2">
                            <label for="keperluan" class="block text-sm font-medium leading-6 text-gray-900">KEPERLUAN</label>
                            <select id="keperluan" name="keperluan" onchange="showInput()" class="block w-full rounded-md border-gray-300 py-2 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option>Rapat / Kunjungan / Meeting</option>
                                <option>Site Visit / Survey</option>
                                <option value="other">Lainnya</option>
                            </select>
                            <input type="text" id="lainnya" name="lainnya" placeholder="Silakan isi keperluan lainnya" class="hidden mt-2 block w-full rounded-md border-gray-300 py-2 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <x-input-error :messages="$errors->get('keperluan')" class="mt-2" />
                        </div>
                    </div>


                <!-- Tanggal Kunjungan -->      
                <div>
                    <label for="" class="flex mt-10 font-medium text-center items-center justify-center">Start Date and End Date</label>              
                    <div class="flex items-center justify-center mt-5">
                        <div date-rangepicker class="flex items-center">
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                            </div>
                            <span class="mx-4 ml-2 mr-2 text-gray-500">to</span>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                            </div>
                        </div>
                    </div>
                </div>
  

                <!-- Tujuan Berkunjung -->
                    <div class="flex space-x-4 mt-10">
                        <div class="w-1/2">
                            <label for="tujuan_berkunjung" class="block text-md font-medium leading-6 text-gray-900">Tujuan Berkunjung</label>
                            <select id="tujuan_berkunjung" name="tujuan_berkunjung" autocomplete="country-name" class="block w-full rounded-md border-gray-300 py-2 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" onchange="showOtherInput()">
                                <option>Zona 1 (Pemeliharaan, Lab, Istek 1&2, Bengkel, Pabrik 1-7, PPE, Dermaga)</option>
                                <option>Zona 2 (JPP, Shiping, Plant Off Site, Pertagas, KIE, Dermaga, K3)</option>
                                <option>Kantor Pusat (Humas, Keuangan, TJSL, PSDMO)</option>
                                <option>Kaltim Daya Mandiri. PT</option>
                                <option>Kaltim Methanol Industri. PT</option>
                                <option>Kaltim Parna Industri. PT</option>
                                <option value="other">Lainnya</option>
                            </select>
                            
                            <input type="text" id="tujuan_berkunjung_lainnya" name="tujuan_berkunjung_lainnya" placeholder="Tujuan Berkunjung Lainnya" class="hidden mt-2 block w-full rounded-md border-gray-300 py-2 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <x-input-error :messages="$errors->get('tujuan_berkunjung')" class="mt-2" />
                        </div>

                <!-- Lama Kunjungan -->
                        <div class="w-1/2">
                            <label for="lama_kunjungan" class="block text-md font-medium leading-6 text-gray-900">Lama Kunjungan</label>
                            <select id="lama_kunjungan" name="lama_kunjungan" autocomplete="country-name" class="block w-full rounded-md border-gray-300 py-2 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="1 hari">1 Hari</option>
                                <option value="2 hari">2 Hari</option>
                                <option value="3 hari">3 Hari</option>
                                <option value="4 hari">4 Hari</option>
                                <option value="5 hari">5 Hari</option>
                                <option value="lebih dari 5 hari">Lebih dari 5 Hari</option>
                            </select>
                            <x-input-error :messages="$errors->get('lama_kunjungan')" class="mt-2" />
                        </div>
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

                    <!-- Button -->
                <div class="mt-6 flex justify-end">
                    <button type="button" class="rounded-md px-5 py-3 shadow-sm text-sm font-semibold leading-6 text-gray-900 hover:text-white hover:bg-red-700" onclick="window.location.href='/home';">Cancel</button>
                    <button type="submit" class="rounded-md px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 ml-4">Save</button>
                </div>
            </form>
        </div>
    </div>
  
  <footer class="bg-gray-800 text-white text-center p-4 mt-8">
      <div class="container mx-auto">
          <p>&copy; {{ date('Y') }} - All rights reserved.</p>
          <p>Powered by | Cheat-Codes Teams</p>
      </div>
  </footer>
</x-app-layout>
