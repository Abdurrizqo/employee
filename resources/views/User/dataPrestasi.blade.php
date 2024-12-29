@extends('User.LayoutDasboardUser')

@section('content')
    <div class="fixed top-0 bottom-0 left-0 right-0 bg-black/40 justify-center items-center z-30 hidden" id="modalDelete">
        <div class="bg-white w-[80%] md:w-[50%] lg:w-[30%] rounded p-4">
            <div class="border-b pb-1 text-red-600 font-medium">
                <p>Hapus Data Prestasi</p>
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


    <div class="p-3">
        <nav class="flex my-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/dashboard"
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
                        <a href="#"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Prestasi Anggota</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="border rounded-lg p-3 w-full bg-white mb-3" id="containerAdd">
            <form id="addForm" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div>
                        <label for="tingkat" class="block mb-2 text-sm font-medium text-gray-900">Tingkat Pengesahan<span
                                class="text-red-400">*</span></label>
                        <select id="tingkat" name="tingkat"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="Internasional">Internasional</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Provinsi">Provinsi</option>
                            <option value="Daerah">Daerah</option>
                            <option value="Cabang">Cabang</option>
                        </select>
                        @error('tingkat')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="prestasi" class="block mb-2 text-sm font-medium text-gray-900">Prestasi<span
                                class="text-red-400">*</span></label>
                        <input type="text" id="prestasi" name="prestasi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Prestasi" required />
                        @error('prestasi')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900">Tahun Sertifikasi<span
                                class="text-red-400">*</span></label>
                        <input type="number" min="1900" max="2099" step="1" id="tahun" name="tahun"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Tahun Sertifikasi" />
                        @error('tahun')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Sertifikat
                            Prestasi</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                            aria-describedby="file_input_help" id="file_input" type="file" name="sertifikat_prestasi"
                            accept="application/pdf">
                        <p class="mt-1 text-sm text-gray-500" id="file_input_help">PDF (MAX 3mb).</p>
                        @error('sertifikat_prestasi')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="w-full flex justify-end mt-10 md:mt-3">
                    <button type="submit"
                        class="w-full sm:w-60 flex justify-center text-white bg-violet-500 hover:bg-violet-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        <div id="spinnerAdd"
                            class="w-5 h-5 border-2 border-t-transparent border-white rounded-full animate-spin hidden">
                        </div>
                        <p>Simpan Data</p>
                    </button>
                </div>
            </form>
        </div>

        <div class="border rounded-lg p-3 w-full bg-white mb-3 overflow-auto">
            <div class="relative">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 sticky w-20 text-center">
                                NO
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Prestasi
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Tingkat
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Tahun
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Sertifikat
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="adminTableBody">
                        @foreach ($prestasi as $item)
                            <tr class="odd:bg-white">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4 text-center">{{ $item->prestasi }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->tingkat }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->tahun }}</td>
                                <td class="px-6 py-4 text-center"><a target="#"
                                        href="/sertifikat-prestasi/{{ $item->id }}"
                                        class="text-violet-500 hover:text-violet-600 hover:underline">Sertifikat Prestasi</a></td>
                                <td class="px-6 py-4 text-center">
                                    <button
                                        class="w-24 bg-red-500 hover:bg-red-600 active:scale-95 text-white p-1.5 rounded"
                                        data-id="{{ $item->id }}" id="btnDelete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[id^="btnDelete"]').forEach(button => {
            button.addEventListener('click', function() {
                // Mendapatkan id dari tombol yang diklik
                const itemId = this.getAttribute('data-id');

                // Menampilkan modal dan menyetel id yang akan dihapus
                document.getElementById('modalDelete').classList.remove('hidden');
                document.getElementById('modalDelete').classList.add('flex');

                const deleteLink = document.getElementById('deleteConfirm');
                deleteLink.setAttribute('href', '/delete-prestasi-anggota/' + itemId);
            });
        });

        // Menangani klik tombol Batal untuk menyembunyikan modal
        document.getElementById('btnBatalDelete').addEventListener('click', function() {
            document.getElementById('modalDelete').classList.add('hidden');
            document.getElementById('modalDelete').classList.remove('flex');
        });
    </script>
@endsection
