@extends('Admin.LayoutDashboardAdmin')

@section('content')
    <div class="py-6 px-5">

        <div class="fixed top-0 bottom-0 left-0 right-0 bg-black/40 justify-center items-center z-30 hidden" id="modalDelete">
            <div class="bg-white w-[80%] md:w-[50%] lg:w-[30%] rounded p-4">
                <div class="border-b pb-1 text-red-600 font-medium">
                    <p>Hapus Data Pendidikan Terakhir</p>
                </div>

                <div class="my-10">
                    <p class="text-gray-400 text-center text-lg" id="contentModal">Lanjut Hapus Data</p>

                    <div class="mt-4 flex items-center justify-center gap-4">
                        <button type="button" class="bg-white hover:bg-gray-100 border rounded-md w-32 py-1"
                            id="btnBatalDelete">Batal</button>
                        <a class="bg-red-500 hover:bg-red-600 text-white w-32 py-1 rounded flex items-center justify-center"
                            id="deleteConfirm">
                            Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div id="successMessage" class="border rounded-lg p-3 w-full text-white bg-green-600">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->has('error'))
            <div id="errorMessage" class="border rounded-lg p-3 w-full text-white bg-red-600">
                {{ $errors->first('error') }}
            </div>
        @endif

        <nav class="flex my-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/admin/dashboard"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
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
                        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Detail
                            User</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-[1fr_22rem] lg:grid-cols-[1fr_30rem] gap-5">

            <div class="flex flex-col gap-8">
                {{-- Biodata Section --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Biodata Anggota</h1>
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
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700">NIK</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->nomer_induk_keluarga }}</div>
                        </div>
                        <!-- Baris 4 -->
                        <div class="flex items-center p-2 text-sm">
                            <div class="w-1/3 text-gray-700">NIW</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->nomer_induk_warga }}</div>
                        </div>
                        <!-- Baris 5 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Tempat Lahir</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->tempat_lahir }}</div>
                        </div>
                        <!-- Baris 6 -->
                        <div class="flex items-center p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Tanggal Lahir</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->tanggal_lahir }}</div>
                        </div>
                        <!-- Baris 7 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Jenis Kelamin</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->jenis_kelamin }}</div>
                        </div>
                        <!-- Baris 8 -->
                        <div class="flex items-center p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Status Pernikahan</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->status_pernikahan }}</div>
                        </div>
                        <!-- Baris 9 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Alamat</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->alamat }}</div>
                        </div>
                        <!-- Baris 10 -->
                        <div class="flex items-center p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Jenis Pekerjaan</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->jenis_pekerjaan }}</div>
                        </div>
                        <!-- Baris 11 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Instansi</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->lembaga_instansi }}</div>
                        </div>
                        <!-- Baris 12 -->
                        <div class="flex items-center p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Alamat Lembaga / Instansi</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3">{{ $biodata->alamat_lembaga_instansi }}</div>
                        </div>
                        <!-- Baris 13 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700">Dokumen</div>
                            <div class="w-1/12 text-center">:</div>
                            <div class="w-2/3"><a target="#" href="/admin/kartu-warga/{{ $biodata->id }}"
                                    class="text-violet-500 font-medium hover:underline">Kartu Warga</a></div>
                        </div>
                        <!-- Baris 14 -->
                        <div class="flex items-center bg-gray-100 p-2 text-sm">
                            <div class="w-1/3 text-gray-700"></div>
                            <div class="w-1/12 text-center"></div>
                            <div class="w-2/3"><a target="#" href="/admin/ktp-warga/{{ $biodata->id }}"
                                    class="text-violet-500 font-medium hover:underline">KTP</a></div>
                        </div>
                    </div>
                </div>

                {{-- Riwayat Pelatihan --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Riwayat Pelatihan</h1>

                        <a href="{{ $idUser }}/data-riwayat-pelatihan" id="dropdownButton"
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
                    </div>
                </div>

                {{-- Sertifikasi Anggota --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Riwayat Pelatihan Lainnya</h1>

                        <a href="{{ $idUser }}/riwayat-sertifikasi" id="dropdownButton"
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
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-8">

                {{-- Pengesahan Anggota --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Data Pengesahan Warga</h1>

                        <a id="dropdownButton" href="{{ $idUser }}/data-pengesahan"
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
                    </div>
                </div>

                {{-- Jabatan Anggota --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Data Jabatan</h1>

                        <a id="dropdownButton" href="{{ $idUser }}/data-jabatan"
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
                                                href="/sk-jabatan/{{ $item->id }}" target="#">Unduh</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Pendidikan Terakhir Anggota --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Pendidikan Terakhir</h1>

                        @if (@isset($pendidikanTerakhir))
                            <button id="deletePendidikanTerakhir" data-id="{{ $pendidikanTerakhir->id }}"
                                class="p-2 rounded-full hover:bg-violet-600 focus:outline-none active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="white" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        @else
                        @endif
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
                        @endif
                    </div>
                </div>

                {{-- Prestasi Anggota --}}
                <div class="border shadow rounded-md">
                    <div class="font-semibold bg-violet-500 rounded-t-md p-3 flex items-center justify-between">
                        <h1 class="text-white sm:text-sm md:text-base lg:text-xl">Prestasi Anggota</h1>

                        <a id="dropdownButton" href="{{ $idUser }}/prestasi-anggota"
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('deletePendidikanTerakhir').addEventListener('click', function() {
            // Mendapatkan id dari tombol yang diklik
            const itemId = this.getAttribute('data-id');
            console.log(itemId);


            // Menampilkan modal dan menyetel id yang akan dihapus
            document.getElementById('modalDelete').classList.remove('hidden');
            document.getElementById('modalDelete').classList.add('flex');

            const deleteLink = document.getElementById('deleteConfirm');
            deleteLink.setAttribute('href', '/admin/delete-pendidikan-terakhir/' + itemId);
        });

        // Menangani klik tombol Batal untuk menyembunyikan modal
        document.getElementById('btnBatalDelete').addEventListener('click', function() {
            document.getElementById('modalDelete').classList.add('hidden');
            document.getElementById('modalDelete').classList.remove('flex');
        });
    </script>
@endsection
