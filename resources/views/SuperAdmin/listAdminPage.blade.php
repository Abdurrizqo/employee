@extends('SuperAdmin.layoutSuperAdmin')

@section('content')
    <div class="fixed top-0 bottom-0 left-0 right-0 bg-black/40 justify-center items-center z-30 hidden" id="modalDelete">
        <div class="bg-white w-[80%] md:w-[50%] lg:w-[30%] rounded p-4">
            <div class="border-b pb-1 text-red-600 font-medium">
                <p id="titleModal"></p>
            </div>

            <div class="my-10">
                <p class="text-gray-400 text-center text-lg" id="contentModal">Lanjut Menonaktifkan Data</p>

                <div class="mt-4 flex items-center justify-center gap-4">
                    <button class="bg-white hover:bg-gray-100 border rounded-md w-24 py-1" id="btnBatalDelete">Batal</button>
                    <button class="bg-red-500 hover:bg-red-600 text-white w-24 py-1 rounded" id="btnDelete"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="border rounded-lg p-3 w-full bg-white mb-3" id="containerAdd">
        <form id="adminForm" class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            @csrf
            <div>
                <label for="nama_admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                    Admin</label>
                <input type="text" id="nama_admin"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Nama Admin" required />
                <span id="namaAdminError" class="text-red-500 text-xs hidden">Nama admin minimal 4 karakter</span>
            </div>

            <div>
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                <input type="text" id="username"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Username" required />
                <span id="usernameError" class="text-red-500 text-xs hidden">Username minimal 4 karakter</span>
            </div>

            <div>
                <label for="ranting" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ranting</label>
                <select id="ranting"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                    @foreach ($ranting as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_ranting }}</option>
                    @endforeach
                </select>
                <span id="rantingError" class="text-red-500 text-xs hidden">Ranting harus dipilih</span>
            </div>

            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Password" required />
                <span id="passwordError" class="text-red-500 text-xs hidden">Password minimal 6 karakter dan maksimal 24
                    karakter</span>
            </div>

            <div class="sm:col-start-2 flex justify-end">
                <button type="submit"
                    class="w-full sm:w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Simpan
                    Data Admin</button>
            </div>
        </form>
    </div>

    <div class="border rounded-lg p-3 w-full bg-white mb-3 hidden" id="containerEdit">
        <form id="adminFormEdit" class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            @csrf
            <input type="hidden" name="idAdminEdit" id="idAdminEdit">
            <div>
                <label for="nama_admin_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                    Admin</label>
                <input type="text" id="nama_admin_edit"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Nama Admin" required />
                <span id="namaAdminErrorEdit" class="text-red-500 text-xs hidden">Nama admin minimal 4 karakter</span>
            </div>

            <div>
                <label for="usernameEdit"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                <input type="text" id="usernameEdit"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Username" required />
                <span id="usernameErrorEdit" class="text-red-500 text-xs hidden">Username minimal 4 karakter</span>
            </div>

            <div>
                <label for="rantingEdit"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ranting</label>
                <select id="rantingEdit"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                    @foreach ($ranting as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_ranting }}</option>
                    @endforeach
                </select>
                <span id="rantingErrorEdit" class="text-red-500 text-xs hidden">Ranting harus dipilih</span>
            </div>

            <div>
                <label for="passwordEdit"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" id="passwordEdit"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Password" required />
                <span id="passwordErrorEdit" class="text-red-500 text-xs hidden">Password minimal 6 karakter dan maksimal 24
                    karakter</span>
            </div>

            <div class="sm:col-start-2 flex justify-end gap-4 text-xs">
                <button type="button" id="btnBatalEdit"
                    class="w-full sm:w-60 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg px-5 py-2.5">Batal</button>

                <button type="submit"
                    class="w-full sm:w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5">Ubah
                    Data Admin</button>
            </div>
        </form>
    </div>

    <div class="w-full border rounded-lg p-3 bg-white overflow-x-auto">
        <div class="flex gap-4 ites-center mb-8">
            <input type="text" name="search" id="search" placeholder="cari..."
                class="border border-gray-400 rounded-md px-3 w-1/2 md:w-1/4 bg-gray-50">
            <button id="search-btn"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Cari</button>
        </div>

        <div class="relative">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 sticky w-20 text-center">
                            NO
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Nama Admin
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Ranting
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div class="my-8 flex justify-center items-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination inline-flex -space-x-px text-sm"></ul>
            </nav>
        </div>
    </div>

    @vite(['resources/js/admin/addAdmin.js', 'resources/js/admin/getAdmin.js', 'resources/js/admin/editAdmin.js'])
@endsection
