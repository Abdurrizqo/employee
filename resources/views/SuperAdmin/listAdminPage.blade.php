@extends('SuperAdmin.layoutSuperAdmin')

@section('content')
    <div class="border rounded-lg p-3 w-full bg-white mb-3">
        <form class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div>
                <label for="nama_admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                    Admin</label>
                <input type="text" id="nama_admin"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="nama admin" required />
            </div>

            <div>
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                <input type="text" id="username"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Username" required />
            </div>

            <div>
                <label for="ranting" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ranting</label>
                <select id="ranting"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option>United States</option>
                    <option>Canada</option>
                    <option>France</option>
                    <option>Germany</option>
                </select>
            </div>

            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Password" required />
            </div>

            <div class="sm:col-start-2 flex justify-end">
                <button
                    class="w-full sm:w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Simpan
                    Data Admin</button>
            </div>
        </form>
    </div>

    <div class="flex-grow border rounded-lg p-3 w-full bg-white overflow-y-auto">
        <div class="flex gap-4 ites-center flex-1 mb-8">
            <input type="text" name="search" id="search" placeholder="cari..."
                class="border border-gray-400 rounded-md px-3 w-1/2 md:w-1/4 bg-gray-50">
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Cari</button>
        </div>

        <div class="relative overflow-x-auto">
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
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            1
                        </th>
                        <td class="px-6 py-4">
                            Silver
                        </td>
                        <td class="px-6 py-4">
                            Silver
                        </td>
                        <td class="px-6 py-4">
                            Silver
                        </td>
                        <td class="px-6 py-4 text-center">
                            Aktif
                        </td>
                        <td class="px-6 py-4">
                            <div class="inline-flex rounded-md shadow-sm items-center justify-center w-full">
                                <button href="#" aria-current="page"
                                    class="px-8 py-2 text-sm font-medium text-white bg-green-600 borde rounded-s-lg hover:bg-green-500 focus:z-10 focus:ring-2">
                                    Edit
                                </button>
                                <button href="#"
                                    class="px-8 py-2 text-sm font-medium text-white bg-red-600 border rounded-e-lg hover:bg-red-500">
                                    Delete
                                </button>
                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
