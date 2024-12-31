@extends('Admin.LayoutDashboardAdmin')

@section('content')
    <div class="fixed top-0 bottom-0 left-0 right-0 bg-black/40 justify-center items-center z-30 hidden" id="modalDelete">
        <div class="bg-white w-[80%] md:w-[50%] lg:w-[30%] rounded p-4">
            <div class="border-b pb-1 text-red-600 font-medium">
                <p>Hapus Data Pengesahan</p>
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
                    <a href="/admin/detail/{{ $idUser }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-4 w-4 mr-2 mb-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                        </svg>
                        Kembali
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Data
                            Pengesahan</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="border rounded-lg p-3 w-full bg-white mb-3 overflow-auto">
            <div class="relative">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 sticky w-20 text-center">
                                NO
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Tingkat
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Cabang
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Tahun
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Sertifikat Pengesahan
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="adminTableBody">
                        @foreach ($pengesahan as $item)
                            <tr class="odd:bg-white">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4 text-center">{{ $item->tingkat }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->cabang }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->tahun }}</td>
                                <td class="px-6 py-4 text-center"><a target="#"
                                        href="/admin/sertifikat-pengesahan/{{ $item->id }}"
                                        class="text-violet-500 hover:text-violet-600 hover:underline">Sertifikat
                                        Pengesahan</a></td>
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
                deleteLink.setAttribute('href', '/admin/delete-data-pengesahan/' + itemId);
            });
        });

        // Menangani klik tombol Batal untuk menyembunyikan modal
        document.getElementById('btnBatalDelete').addEventListener('click', function() {
            document.getElementById('modalDelete').classList.add('hidden');
            document.getElementById('modalDelete').classList.remove('flex');
        });
    </script>
@endsection
