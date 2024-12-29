@extends('User.LayoutDasboardUser')

@section('content')
    <div class="p-3">
        <nav class="flex my-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/dashboard"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Pendidikan
                            Terakhir</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex justify-center items-center">
            <div class="border rounded-lg p-3 w-full sm:w-[90%] md:w-[70%] lg:w-[32rem] bg-white mb-3" id="containerAdd">
                <form id="addForm" method="POST" class="grid grid-cols-1 gap-8" enctype="multipart/form-data">
                    @csrf
                    <!-- Pendidikan Terakhir -->
                    <div>
                        <label for="pendidikan_terakhir" class="block mb-2 text-sm font-medium text-gray-900">Pendidikan
                            Terakhir<span class="text-red-400">*</span></label>
                        <select id="pendidikan_terakhir" name="pendidikan_terakhir"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="-" {{ old('pendidikan_terakhir') == '-' ? 'selected' : '' }}>-</option>
                            <option value="SD / Sederajat"
                                {{ old('pendidikan_terakhir') == 'SD / Sederajat' ? 'selected' : '' }}>SD / Sederajat
                            </option>
                            <option value="SMP / Sederajat"
                                {{ old('pendidikan_terakhir') == 'SMP / Sederajat' ? 'selected' : '' }}>SMP / Sederajat
                            </option>
                            <option value="SMA / Sederajat"
                                {{ old('pendidikan_terakhir') == 'SMA / Sederajat' ? 'selected' : '' }}>SMA / Sederajat
                            </option>
                            <option value="SMK" {{ old('pendidikan_terakhir') == 'SMK' ? 'selected' : '' }}>SMK</option>
                            <option value="DI" {{ old('pendidikan_terakhir') == 'DI' ? 'selected' : '' }}>DI</option>
                            <option value="D-II" {{ old('pendidikan_terakhir') == 'D-II' ? 'selected' : '' }}>D-II
                            </option>
                            <option value="D-III" {{ old('pendidikan_terakhir') == 'D-III' ? 'selected' : '' }}>D-III
                            </option>
                            <option value="D-IV / Sarjana"
                                {{ old('pendidikan_terakhir') == 'D-IV / Sarjana' ? 'selected' : '' }}>D-IV / Sarjana
                            </option>
                            <option value="Pasca Sarjana - S2"
                                {{ old('pendidikan_terakhir') == 'Pasca Sarjana - S2' ? 'selected' : '' }}>Pasca Sarjana -
                                S2
                            </option>
                            <option value="Pasca Sarjana - S3"
                                {{ old('pendidikan_terakhir') == 'Pasca Sarjana - S3' ? 'selected' : '' }}>Pasca Sarjana -
                                S3
                            </option>
                        </select>
                        @error('pendidikan_terakhir')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jurusan -->
                    <div>
                        <label for="jurusan" class="block mb-2 text-sm font-medium text-gray-900">Jurusan</label>
                        <input type="text" id="jurusan" name="jurusan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Jurusan" value="{{ old('jurusan') }}" />
                        @error('jurusan')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Penyenggara -->
                    <div>
                        <label for="tahun_lulus" class="block mb-2 text-sm font-medium text-gray-900">Tahun Lulus</label>
                        <input type="number" min="1900" max="2099" step="1" id="tahun_lulus"
                            name="tahun_lulus"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="tahun lulus" value="{{ old('tahun_lulus') }}" />
                        @error('tahun_lulus')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Ijazah</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                            aria-describedby="file_input_help" id="file_input" type="file" name="ijazah"
                            accept="application/pdf">
                        <p class="mt-1 text-sm text-gray-500" id="file_input_help">PDF (MAX 3mb).</p>
                        @error('ijazah')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-full">
                        <button type="submit"
                            class="w-full flex justify-center text-white bg-violet-500 hover:bg-violet-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            <div id="spinnerAdd"
                                class="w-5 h-5 border-2 border-t-transparent border-white rounded-full animate-spin hidden">
                            </div>
                            <p>Simpan Data</p>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
