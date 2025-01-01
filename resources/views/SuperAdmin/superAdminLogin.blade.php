<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <link rel="icon" href="{{ asset('asset/Logo-PSHT.png') }}" type="image/x-icon">
    <title>Document</title>
</head>

<body class="bg-white h-screen w-screen p-4 grid grid-cols-1 lg:grid-cols-2">
    <div class="w-full h-full hidden lg:block"
        style="background-image: url('{{ asset('asset/super_admin_bg.jpg') }}'); background-size: cover; background-position: center;">
    </div>
    <div class="w-full h-full flex flex-col justify-center items-center">
        <h1 class="text-xl md:text-2xl font-medium mb-2 text-center">Hi! Selamat Datang</h1>
        <h1 class="text-xl md:text-2xl font-medium mb-10 text-center">Mohon login terlebih dahulu sebagai super admin</h1>


        <form method="POST" class="w-full sm:w-3/4 md:w-1/2 lg:w-3/4 text-sm md:text-base">
            @csrf
            <div class="mb-5">
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                <input type="text" id="username" name="username"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="username" value="{{ old('username') }}" required />
                @error('username')
                    <p class="text-xs text-red-400">*{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">password</label>
                <input type="password" id="password" name="password" placeholder="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required />
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center ">Submit</button>
        </form>

    </div>
</body>

</html>
