@extends('SuperAdmin.layoutSuperAdmin')

@section('content')
    <div class="border rounded-lg p-3 w-full bg-white">
        <form id="ratingForm">
            @csrf
            <div class="grid gap-6 grid-cols-1 md:grid-cols-[80%_1fr]">
                <div>
                    <input type="text" id="ranting_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="nama ranting" required />
                </div>
                <div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <div class="border rounded-lg p-3 w-full bg-white">
        <form>
            <div class="grid gap-6 grid-cols-1 md:grid-cols-[70%_1fr]">
                <div>
                    <input type="text" id="first_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="nama rating" required />
                </div>

                <div class="flex justify-center items-center gap-4">
                    <button type="submit"
                        class="text-white bg-green-600 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center ">Edit</button>

                    <button type="button"
                        class="text-white bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center ">Batal</button>
                </div>
            </div>
        </form>
    </div>

    <div class="flex-grow border rounded-lg p-3 w-full bg-white overflow-y-auto">
        <div class="flex gap-4 items-center flex-1 mb-8">
            <input type="text" name="search" id="search" placeholder="cari..."
                class="border border-gray-400 rounded-md px-3 w-1/2 md:w-1/4 bg-gray-50">
            <button id="search-btn"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Cari
            </button>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 sticky w-20 text-center">
                            NO
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Nama Ranting
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
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
    @vite(['resources/js/ranting/addRanting.js', 'resources/js/ranting/getRanting.js'])
@endsection
