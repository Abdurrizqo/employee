<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <link rel="icon" href="{{ asset('asset/Logo-PSHT.png') }}" type="image/x-icon">
    <title>siManiesPSHT - Kutim</title>
</head>

<body class="bg-white flex items-center justify-center p-4">
    <div class="w-[26rem] md:w-[32rem] bg-white rounded-md border shadow p-4 md:p-8">
        <div class="mb-8">
            <h1 class="text-blue-700 font-medium text-center text-xl">Konfigurasi dan Verifikasi</h1>
            <h1 class="text-blue-700 font-medium text-center text-xl">Akun Anggota</h1>
        </div>

        <form method="POST">

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4 text-sm">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @csrf
            <div class="mb-5">
                <label for="nama_user" class="block text-sm font-medium text-gray-900">Nama Lengkap</label>
                <p class="text-xs text-gray-400 mb-2">Isikan dengan nama lengkap sesuai KTP</p>
                <input type="text" id="nama_user" name="nama_user" value="{{ old('nama_user') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="username" required />
            </div>

            <div class="mb-5">
                <label for="username" class="block text-sm font-medium text-gray-900">Username</label>
                <p class="text-xs text-gray-400 mb-2">Input username baru. Ingat dengan baik username yang diinputkan.
                    Username akan
                    digunakan untuk login berikutnya.</p>
                <input type="text" id="username" name="username"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="username" value="{{ old('username') }}" required />
            </div>

            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <p class="text-xs text-gray-400 mb-2">Input password baru. Ingat dengan baik password yang diinputkan.
                    Password akan
                    digunakan untuk login berikutnya.</p>
                <input type="password" id="password" name="password" placeholder="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Konfirmasi
                    Password</label>
                <p class="text-xs text-gray-400 mb-2">Input kembali password baru, untuk konfirmasi.</p>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required />
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Konfirmasi
                Akun</button>

        </form>
    </div>

    @vite(['resources/js/user/FirstTimeLogin.js'])

</body>

</html>
