@extends('User.LayoutDasboardUser')

@section('content')
    <div class="py-6 px-5">

        @if (session('success'))
            <div id="successMessage" class="border rounded-lg p-3 w-full text-white bg-green-600 mb-5">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->has('error'))
            <div id="errorMessage" class="border rounded-lg p-3 w-full text-white bg-red-600 mb-5">
                {{ $errors->first('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-[1fr_22rem] lg:grid-cols-[1fr_30rem] gap-5">

            <div class="flex flex-col gap-8">
                {{-- Biodata Section --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Biodata Anggota</h1>

                        <a id="dropdownButton" href="dashboard/edit-biodata"
                            class="p-[0.15rem] rounded-full hover:bg-violet-600 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M16.5 3l4.5 4.5-10.5 10.5H6v-4.5L16.5 3z" />
                            </svg>
                        </a>
                    </div>

                    <div class="grid gap-1 p-2">
                        <!-- Baris 1 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Nama</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata['nama_lengkap'] }}</div>
                        </div>
                        <!-- Baris 2 -->
                        <div class="flex items-center p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Ranting</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $ranting->nama_ranting }}</div>
                        </div>
                        <!-- Baris 3 -->
                        <div class="flex items-center p-2 text-sm">
                            <div class="w-1/3 text-gray-700">NIK</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->nomer_induk_keluarga }}</div>
                        </div>
                        <!-- Baris 4 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700">NIW</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->nomer_induk_warga }}</div>
                        </div>
                        <!-- Baris 5 -->
                        <div class="flex items-center  p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Tempat Lahir</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->tempat_lahir }}</div>
                        </div>
                        <!-- Baris 6 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Tanggal Lahir</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->tanggal_lahir }}</div>
                        </div>
                        <!-- Baris 7 -->
                        <div class="flex items-center p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Jenis Kelamin</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->jenis_kelamin }}</div>
                        </div>
                        <!-- Baris 8 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Status Pernikahan</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->status_pernikahan }}</div>
                        </div>
                        <!-- Baris 9 -->
                        <div class="flex items-center p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Alamat</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->alamat }}</div>
                        </div>
                        <!-- Baris 10 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Jenis Pekerjaan</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->jenis_pekerjaan }}</div>
                        </div>
                        <!-- Baris 11 -->
                        <div class="flex items-center p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Instansi</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->lembaga_instansi }}</div>
                        </div>
                        <!-- Baris 12 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Alamat Lembaga / Instansi</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->alamat_lembaga_instansi }}</div>
                        </div>
                        <!-- Baris 13 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Dokumen</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3"><a target="#" href="kartu-warga/{{ $biodata->id }}"
                                    class="text-violet-500 font-medium hover:underline">Kartu Warga</a></div>
                        </div>
                        <!-- Baris 14 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700"></div>
                            <div class="w-1/12 text-center"></div>
                            <div class="w-2/3"><a target="#" href="ktp-warga/{{ $biodata->id }}"
                                    class="text-violet-500 font-medium hover:underline">KTP</a></div>
                        </div>
                    </div>
                </div>

                {{-- Riwayat Pelatihan --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Riwayat Pelatihan</h1>

                        <a href="dashboard/data-riwayat-pelatihan" id="dropdownButton"
                            class="p-[0.15rem] rounded-full hover:bg-violet-600 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="6" r="2" />
                                <circle cx="12" cy="12" r="2" />
                                <circle cx="12" cy="18" r="2" />
                            </svg>
                        </a>
                    </div>

                    <div class="p-2">
                        @if ($riwayatLatihan->isNotEmpty())
                            <div class="grid grid-cols-1 gap-4">
                                @foreach ($riwayatLatihan as $riwayat)
                                    <div class="bg-white p-2 border-b grid grid-cols-1 gap-2">
                                        <div>
                                            <p class="text-xs text-gray-600">Penyelenggara</p>
                                            <p class="text-sm font-medium pl-1">{{ $riwayat->penyelenggara }}</p>
                                        </div>
                                        <div class="grid grid-cols-2 gap-2">
                                            <div>
                                                <p class="text-xs text-gray-600">Rayon</p>
                                                <p class="text-sm font-medium pl-1">{{ $riwayat->rayon }}</p>
                                            </div>

                                            <div>
                                                <p class="text-xs text-gray-600">Tingkat Pelatihan</p>
                                                <p class="text-sm font-medium pl-1">{{ $riwayat->tingkat }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="flex items-center justify-center h-32">
                                <a href="dashboard/data-riwayat-pelatihan"
                                    class="bg-violet-500 text-white px-4 py-2 rounded hover:bg-violet-600">
                                    Data Riwayat Pelatihan
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Sertifikasi Anggota --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Riwayat Pelatihan Lainnya</h1>

                        <a href="/dashboard/riwayat-sertifikasi" id="dropdownButton"
                            class="p-[0.15rem] rounded-full hover:bg-violet-600 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="6" r="2" />
                                <circle cx="12" cy="12" r="2" />
                                <circle cx="12" cy="18" r="2" />
                            </svg>
                        </a>
                    </div>

                    <div class="p-2">
                        @if ($sertifikasi->isNotEmpty())
                            @foreach ($sertifikasi as $item)
                                <div class="bg-white p-2 border-b grid grid-cols-1 gap-2">
                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            <p class="text-xs text-gray-600">Tingkat Sertifikasi</p>
                                            <p class="text-sm font-medium pl-1">{{ $item->tingkat }}</p>
                                        </div>

                                        <div>
                                            <p class="text-xs text-gray-600">Penyelenggara</p>
                                            <p class="text-sm font-medium pl-1">{{ $item->penyelenggara }}</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            <p class="text-xs text-gray-600">Sertifikasi</p>
                                            <p class="text-sm font-medium pl-1">{{ $item->sertifikasi }}</p>
                                        </div>

                                        <div>
                                            <p class="text-xs text-gray-600">Tahun Sertifikasi</p>
                                            <p class="text-sm font-medium pl-1">{{ $item->tahun }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center justify-center h-32">
                                <a href="/dashboard/riwayat-sertifikasi"
                                    class="bg-violet-500 text-white px-4 py-2 rounded hover:bg-violet-600">
                                    Riwayat Pelatihan Lainnya
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-8">

                {{-- Pengesahan Anggota --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Data Pengesahan Warga</h1>

                        <a id="dropdownButton" href="dashboard/data-pengesahan"
                            class="p-[0.15rem] rounded-full hover:bg-violet-600 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="6" r="2" />
                                <circle cx="12" cy="12" r="2" />
                                <circle cx="12" cy="18" r="2" />
                            </svg>
                        </a>
                    </div>

                    <div class="p-2">
                        @if ($pengesahan->isNotEmpty())
                            @foreach ($pengesahan as $item)
                                <div class="bg-white p-2 border-b grid grid-cols-1 gap-5">
                                    <div>
                                        <p class="text-xs text-gray-600">Tingkat Pengesahan</p>
                                        <p class="text-sm font-medium pl-1">{{ $item->tingkat }}</p>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            <p class="text-xs text-gray-600">Cabang</p>
                                            <p class="text-sm font-medium pl-1">{{ $item->cabang }}</p>
                                        </div>

                                        <div>
                                            <p class="text-xs text-gray-600">Tahun Pengesahan</p>
                                            <p class="text-sm font-medium pl-1">{{ $item->tahun }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center justify-center h-32">
                                <a href="dashboard/data-pengesahan"
                                    class="bg-violet-500 text-white px-4 py-2 rounded hover:bg-violet-600">
                                    Data Pengesahan Warga
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Jabatan Anggota --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Data Jabatan</h1>

                        <a id="dropdownButton" href="dashboard/data-jabatan"
                            class="p-[0.15rem] rounded-full hover:bg-violet-600 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="6" r="2" />
                                <circle cx="12" cy="12" r="2" />
                                <circle cx="12" cy="18" r="2" />
                            </svg>
                        </a>
                    </div>

                    <div class="p-2">
                        @if ($jabatans->isNotEmpty())
                            @foreach ($jabatans as $item)
                                <div class="bg-white p-2 border-b grid grid-cols-1 gap-5">
                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            <p class="text-xs text-gray-600">Lokasi Jabatan</p>
                                            <p class="text-sm font-medium pl-1">{{ $item->lokasi_jabatan }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-600">Jabatan</p>
                                            <p class="text-sm font-medium pl-1">{{ $item->jabatan }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            <p class="text-xs text-gray-600">SK Jabatan</p>
                                            <p class="text-sm font-medium pl-1"><a class="text-violet-500 hover:underline"
                                                    href="/sk-jabatan/{{ $item->id }}"
                                                    target="#">Unduh</a></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center justify-center h-32">
                                <a href="dashboard/data-jabatan"
                                    class="bg-violet-500 text-white px-4 py-2 rounded hover:bg-violet-600">
                                    Tambah Jabatan
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Pendidikan Terakhir Anggota --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Pendidikan Terakhir</h1>

                        <a id="dropdownButton" href="dashboard/pendidikan-terakhir"
                            class="p-[0.15rem] rounded-full hover:bg-violet-600 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M16.5 3l4.5 4.5-10.5 10.5H6v-4.5L16.5 3z" />
                            </svg>
                        </a>
                    </div>

                    <div class="p-2">
                        @if (@isset($pendidikanTerakhir))
                            <div class="bg-white p-2 border-b grid grid-cols-1 gap-4">
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <p class="text-xs text-gray-600">Pendidikan Terakhir</p>
                                        <p class="text-sm font-medium pl-1">{{ $pendidikanTerakhir->pendidikan_terakhir }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs text-gray-600">Jurusan</p>
                                        <p class="text-sm font-medium pl-1">{{ $pendidikanTerakhir->jurusan }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <p class="text-xs text-gray-600">Tahun Lulus</p>
                                        <p class="text-sm font-medium pl-1">{{ $pendidikanTerakhir->tahun_lulus }}</p>
                                    </div>

                                    <div>
                                        <p class="text-xs text-gray-600">Ijazah</p>
                                        <p class="text-sm font-medium pl-1"><a class="text-violet-500 hover:underline"
                                                href="/ijazah-pendidikan-terakhir/{{ $pendidikanTerakhir->id }}"
                                                target="#">Unduh</a></p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center justify-center h-32">
                                <a href="dashboard/pendidikan-terakhir"
                                    class="bg-violet-500 text-white px-4 py-2 rounded hover:bg-violet-600">
                                    Pendidikan Terakhir
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Prestasi Anggota --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Prestasi Anggota</h1>

                        <a id="dropdownButton" href="dashboard/prestasi-anggota"
                            class="p-[0.15rem] rounded-full hover:bg-violet-600 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="6" r="2" />
                                <circle cx="12" cy="12" r="2" />
                                <circle cx="12" cy="18" r="2" />
                            </svg>
                        </a>
                    </div>

                    <div class="p-2">
                        @if ($prestasi->isNotEmpty())
                            @foreach ($prestasi as $item)
                                <div class="bg-white p-2 border-b grid grid-cols-1 gap-2">
                                    <div>
                                        <p class="text-xs text-gray-600">Prestasi</p>
                                        <p class="text-sm font-medium pl-1">{{ $item->prestasi }}</p>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-xs text-gray-600">Tingkat</p>
                                            <p class="text-sm font-medium pl-1">{{ $item->tingkat }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-600">Tahun</p>
                                            <p class="text-sm font-medium pl-1">{{ $item->tahun }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center justify-center h-32">
                                <a href="dashboard/prestasi-anggota"
                                    class="bg-violet-500 text-white px-4 py-2 rounded hover:bg-violet-600">
                                    Data Prestasi
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
