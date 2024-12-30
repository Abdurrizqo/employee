<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body class="bg-gray-100">
    <div class="fixed top-0 bottom-0 left-0 right-0 bg-black/40 justify-center items-center z-30 hidden" id="modalDelete">
        <div class="bg-white w-[80%] md:w-[50%] lg:w-[30%] rounded p-4">
            <div class="border-b pb-1 text-red-600 font-medium">
                <p id="titleModal"></p>
            </div>

            <div class="my-10">
                <p class="text-gray-400 text-center text-lg" id="contentModal">Lanjut Menonaktifkan Data</p>

                <div class="mt-4 flex items-center justify-center gap-4">
                    <input type="hidden" id="idDelete">
                    <button class="bg-white hover:bg-gray-100 border rounded-md w-32 py-1"
                        id="btnBatalDelete">Batal</button>
                    <button
                        class="bg-red-500 hover:bg-red-600 text-white w-32 py-1 rounded flex items-center justify-center"
                        id="btnDelete">
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

    <nav
        class="w-full flex items-center justify-end gap-5 bg-white border-b border-gray-200 h-20 sticky top-0 z-10 px-10">
        <p class="text-xl font-medium border-r border-gray-600 pr-10">Halo, <span
                class="text-blue-700">{{ auth('guard_admin')->user()->nama_admin }}</span></p>

        <a href="/logout" class="active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 text-red-500 hover:text-red-700">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
            </svg>
        </a>
    </nav>

    <div id="notificationMessage" class="border rounded-lg p-3 w-full hidden mt-4"></div>


    <div class="px-3 sm:px-10 md:px-16 py-5">
        <div class="border shadow rounded-lg p-3 w-full bg-white mb-8" id="containerAdd">
            <form id="addForm" class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div>
                    <label for="nama_anggota" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Anggota</label>
                    <input type="text" id="nama_anggota"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="nama anggota" required />
                    <span id="namaAnggotaError" class="text-red-500 text-xs hidden">Nama anggota minimal 4
                        karakter</span>
                </div>

                <div>
                    <label for="username"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" id="username"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Username" required />
                    <span id="usernameError" class="text-red-500 text-xs hidden">Username minimal 4 karakter</span>
                </div>

                <div>
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Password" required />
                    <span id="passwordError" class="text-red-500 text-xs hidden">Password minimal 6 karakter dan
                        maksimal 24
                        karakter</span>
                </div>

                <div></div>

                <div class="sm:col-start-2 flex justify-end">
                    <button type="submit"
                        class="w-full sm:w-60 flex justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        <div id="spinnerAdd"
                            class="w-5 h-5 border-2 border-t-transparent border-white rounded-full animate-spin hidden">
                        </div>
                        <p>Simpan Data Anggota</p>
                    </button>
                </div>
            </form>
        </div>

        <div class="border shadow rounded-lg p-3 w-full bg-white hidden mb-8" id="containerEdit">
            <form id="editForm" class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <input type="hidden" name="idAnggotaEdit" id="idAnggotaEdit">

                <div>
                    <label for="nama_anggota_edit"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Anggota</label>
                    <input type="text" id="nama_anggota_edit"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="nama anggota" required />
                    <span id="namaAnggotaErrorEdit" class="text-red-500 text-xs hidden">Nama anggota minimal 4
                        karakter</span>
                </div>

                <div>
                    <label for="usernameEdit"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" id="usernameEdit"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Username" required />
                    <span id="usernameErrorEdit" class="text-red-500 text-xs hidden">Username minimal 4
                        karakter</span>
                </div>

                <div>
                    <label for="passwordEdit"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" id="passwordEdit"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Password" required />

                    <span id="passwordErrorEdit" class="text-red-500 text-xs hidden">Password minimal 6 karakter dan
                        maksimal 24 karakter</span>
                </div>

                <div></div>

                <div class="sm:col-start-2 flex justify-end gap-4 text-xs">
                    <button type="button" id="btnBatalEdit"
                        class="w-full sm:w-60 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg px-5 py-2.5">Batal</button>

                    <button type="submit"
                        class="w-full sm:w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5">Ubah
                        Data Anggota</button>
                    <div class="justify-center items-center w-full hidden" id="spinnerEdit">
                        <div
                            class="w-5 h-5 border-[3px] border-t-transparent border-blue-700 rounded-full animate-spin">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div
            class="border shadow rounded-lg p-3 w-full bg-white mb-8 flex justify-center flex-col sm:justify-between sm:items-center sm:flex-row gap-8">
            <div class="text-center sm:text-left">
                <h1 class="text-gray-800 md:text-xl font-semibold">Export Data Warga</h1>
                <p class="text-sm text-gray-400">Data yang di export adalah data warga sesuai ranting Admin</p>
                <p id="pesanExport" class="text-gray-800 hidden text-sm"></p>

            </div>
            <div class="flex justify-end">
                <button type="submit" id="exportButton"
                    class="w-full sm:w-60 flex justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    <div id="spinnerExport"
                        class="w-5 h-5 border-2 border-t-transparent border-white rounded-full animate-spin hidden">
                    </div>
                    <p>Export Data</p>
                </button>
            </div>
        </div>

        <div class="flex-grow shadow border rounded-lg p-3 w-full bg-white overflow-y-auto">
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

            <div class="relative overflow-auto min-h-[20rem] max-h-[60rem]">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 sticky w-20 text-center">
                                NO
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Nama Anggota
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
                                Kelengkapan Biodata
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                    </tbody>
                </table>

                <div class="my-8 flex justify-center items-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination inline-flex -space-x-px text-sm"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @vite(['resources/js/user/addUserByAdmin.js', 'resources/js/user/getUserByRanting.js', 'resources/js/user/exportDataByAdmin.js'])

</body>

</html>
