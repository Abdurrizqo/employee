@extends('User.LayoutDasboardUser')

@section('content')
    <div class="p-3">
        <nav class="flex my-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/dashboard"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
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
                        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Edit
                            Akun</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex justify-center items-center">
            <div class="border rounded-lg p-3 w-full sm:w-[90%] md:w-[70%] lg:w-[32rem] bg-white mb-3" id="containerAdd">
                <form id="addForm" method="POST" class="grid grid-cols-1 gap-8">
                    @csrf
                    <!-- Username Lama -->
                    <div>
                        <label for="username_lama" class="block mb-2 text-sm font-medium text-gray-900">Username
                            Sekarang</label>
                        <input type="text" id="username_lama" name="username_lama"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="username lama" />
                        @error('credentials')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Lama -->
                    <div>
                        <label for="password_lama" class="block mb-2 text-sm font-medium text-gray-900">Password
                            Sekarang</label>
                        <input type="password" id="password_lama" name="password_lama"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="password lama" />
                        @error('credentials')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Username Baru -->
                    <div class="border-t-2 border-gray-400 pt-10">
                        <label for="username_baru" class="block mb-2 text-sm font-medium text-gray-900">Username
                            Baru</label>
                        <input type="text" id="username_baru" name="username_baru"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="username baru" />
                        @error('username_baru')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Baru -->
                    <div>
                        <label for="password_baru" class="block mb-2 text-sm font-medium text-gray-900">Password
                            Baru</label>
                        <input type="password" id="password_baru" name="password_baru"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="password baru" />
                        @error('password_baru')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>




                    <div class="w-full">
                        <button type="submit"
                            class="w-full flex justify-center text-white bg-violet-500 hover:bg-violet-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            <div id="spinnerAdd"
                                class="w-5 h-5 border-2 border-t-transparent border-white rounded-full animate-spin hidden">
                            </div>
                            <p>Ubah Data</p>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
