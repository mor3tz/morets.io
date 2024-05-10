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
  <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <div class="border-b border-gray-900/10 pb-12 py-10">
      <h2 class=" text-base font-semibold leading-7 text-gray-900 text-center">PERSONAL INFORMATION</h2>
      <p class="mt-1 text-sm leading-6 text-gray-600 text-center">Silahkan Melengkapi Data Diri Anda.</p>
    
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-2">
            <label for="first-name" class="block text-bold font-medium leading-6 text-gray-900 mt-3">Nama</label>
            <div class="mt-2">
              <input required type="text" name="nama" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div class="sm:col-span-2">
            <label for="no_ktp" class="block text-bold font-medium leading-6 text-gray-900 mt-3">No. KTP</label>
            <div class="mt-2">
              <input required type="text" name="no_ktp" id="no_ktp" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

      
              
      
              <div class="col-span-5">
                <label for="cover-photo" class="block text-bold font-medium leading-6 text-gray-900">Fotocopy KTP</label>
                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 ml-10">
                  <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                    </svg>
                    <div class="mt-4 flex text-bold leading-6 text-gray-600">
                      <label for="foto_ktp" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                        <span>Upload a file </span>
                        <input required id="foto_ktp" name="foto_ktp" type="file" class="">
                      </label>
                      
                      <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                  </div>
                </div>
              </div>


              <div class="col-span-5">
                <label for="cover-photo" class="block text-bold font-medium leading-6 text-gray-900">Kartu Vaksin Booster</label>
                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-800/25 px-6 py-10 ml-10">
                  <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                    </svg>
                    <div class="mt-4 flex text-bold leading-6 text-gray-600">
                      <label for="kartu_vaksin" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                        <span>Upload a file</span>
                        <input required id="kartu_vaksin" name="kartu_vaksin" type="file" class="">
                      </label>
                      <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                  </div>
                </div>
              </div>


        </div>
      </div>
  
        
  
          
      <!-- Coloumn Area -->
      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-7">
        <!-- Area field -->
        <div class="sm:col-span-3">
            <label for="country" class="block text-bold font-medium leading-6 text-gray-900">Area</label>
            <div class="mt-2">
                <select id="country" name="area" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option>Kantor</option>
                    <option>Pabrik</option>
                </select>
            </div>
        </div>

        <!-- Unit Kerja field -->
        <div class="sm:col-span-3">
            <label for="first-name" class="block text-bold font-medium leading-6 text-gray-900">Unit Kerja</label>
            <div class="mt-2">
                <input required type="text" name="unit_kerja" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>
    </div>
    
          
      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-7">
          <!-- Unit Kerja 1 -->
          <div class="sm:col-span-3 mb-7">
              <label for="first-name-1" class="block text-bold font-medium leading-6 text-gray-900">Nama Perusahaan</label>
              <div class="mt-2">
                  <input required type="text" name="nama_perusahaan" id="first-name-1" autocomplete="given-name" 
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                                placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
          </div>
          <!-- Unit Kerja 2 -->
          <div class="sm:col-span-3 mb-7">
              <label for="first-name-2" class="block text-bold font-medium leading-6 text-gray-900">Berapa Lama bekerja</label>
              <div class="mt-2">
                  <input required type="text" name="lama_bekerja" id="first-name-2" autocomplete="given-name" 
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                                placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
          </div>
          
          
          <div class="sm:col-span-3 mb-7">
              <label for="first-name-2" class="block text-bold font-medium leading-6 text-gray-900">Tanggal Mulai Bekerja</label>
              <div class="mt-2">
                  <input required type="date" name="tanggal_mulai" id="first-name-2" autocomplete="given-name" 
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                                placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
          </div>
      </div>

      
    
      <div class="mt-3 mb-3 flex justify-end gap-x-6">
        <button type="button" class="rounded-md px-5 py-3 shadow-sm text-sm font-semibold leading-6 text-gray-900 hover:bg-red-700" onclick="window.location.href='/home';">Cancel</button>

        <button type="submit" class="rounded-md bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mr-[10rem]">Save</button>
    </div>
  
  
  </form>
</div>
  
 {{-- Footer --}}
 <footer class="bg-gray-800 text-white text-center p-4">
    <div class="container mx-auto">
        <p>&copy; {{ date('Y') }} - All rights reserved.</p>
        <p>Powered by | Cheat-Codes Teams</p>
    </div>
</footer>

</x-app-layout>
