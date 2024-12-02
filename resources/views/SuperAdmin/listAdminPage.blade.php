@extends('SuperAdmin.layoutSuperAdmin')

@section('content')
    <div class="border rounded-lg p-3 w-full bg-white mb-3">
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

    @vite(['resources/js/admin/addAdmin.js', 'resources/js/admin/getAdmin.js'])
@endsection
