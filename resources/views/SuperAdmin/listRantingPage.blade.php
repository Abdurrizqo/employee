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
                    <input type="hidden" id="idDelete">
                    <button class="bg-white hover:bg-gray-100 border rounded-md w-32 py-1" id="btnBatalDelete">Batal</button>
                    <button class="bg-red-500 hover:bg-red-600 text-white w-32 py-1 rounded flex items-center justify-center" id="btnDelete">
                        <span id="buttonTextDelete"></span>
                        <div id="spinnerDelete"
                            class="w-5 h-5 border-2 border-t-transparent border-white rounded-full animate-spin hidden">
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="spinner" class="flex">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div id="notificationMessage" class="border rounded-lg p-3 w-full hidden"></div>

    <div class="border rounded-lg p-3 w-full bg-white" id="formAddRanting">
        <form id="ratingForm">
            @csrf
            <div class="grid gap-6 grid-cols-1 md:grid-cols-[80%_1fr]">
                <div>
                    <input type="text" id="ranting_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="nama ranting" required />
                    <div id="rantingNameError" class="text-red-500 text-sm mt-2 hidden">Nama ranting tidak boleh kosong!
                    </div>
                </div>
                <div>
                    <button type="submit" id="submitButton"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center flex items-center justify-center gap-2">
                        <span id="buttonText">Simpan</span>
                        <div id="spinnerAdd"
                            class="w-5 h-5 border-2 border-t-transparent border-white rounded-full animate-spin hidden">
                        </div>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="border rounded-lg p-3 w-full bg-white hidden" id="formEditRanting">
        <form id="submitEdit">
            @csrf
            <div class="grid gap-6 grid-cols-1 md:grid-cols-[70%_1fr]">
                <input type="hidden" id="idEdit">
                <div>
                    <input type="text" id="ranting_name_edit"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="nama rating" required />
                    <div id="rantingNameErrorEdit" class="text-red-500 text-sm mt-2 hidden">Nama ranting tidak boleh kosong!
                    </div>
                </div>

                <div class="flex justify-center items-center gap-4">
                    <button type="button" id="btnBatalEdit"
                        class="text-blue-700 bg-white hover:bg-gray-100 border border-blue-700 focus:ring-4 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center ">Batal</button>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center flex items-center justify-center gap-2">
                        <span id="buttonTextEdit">Edit</span>
                        <div id="spinnerEdit"
                            class="w-5 h-5 border-2 border-t-transparent border-white rounded-full animate-spin hidden">
                        </div>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="flex-grow border rounded-lg p-3 w-full bg-white overflow-y-auto">
        <div class="flex gap-4 items-center flex-1 mb-8">
            <form id="searchForm">
                <input type="text" name="search" id="search" placeholder="cari..."
                    class="border border-gray-400 rounded-md px-3 w-[10rem] sm:w-[20rem] bg-gray-50">
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Cari
                </button>
            </form>
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
                <tbody id="rantingTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
    @vite(['resources/js/ranting/addRanting.js', 'resources/js/ranting/getRanting.js'])
@endsection
