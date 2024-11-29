<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body class="grid grid-cols-[200px_1fr] h-screen bg-gray-100">
    <div
        class="font-medium py-5 flex flex-col px-4 gap-4 text-sm border-r bg-gradient-to-b from-blue-500 to-blue-600 text-white h-screen">
        <a href="dashboard"
            class="flex items-center gap-2 border rounded-lg p-2 bg-blue-700 hover:bg-blue-800 transition-all duration-300 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 10h11M9 21V3M21 10h-6m0 0h6M21 10V3" />
            </svg>
            Home
        </a>
        <a href="ranting"
            class="flex items-center gap-2 rounded-lg p-2 hover:bg-blue-700 hover:shadow-md transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l-4-4m0 0l4-4m-4 4h16" />
            </svg>
            Ranting
        </a>
        <a href="data-admin"
            class="flex items-center gap-2 rounded-lg p-2 hover:bg-blue-700 hover:shadow-md transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 17v-2a4 4 0 10-8 0v2m4-6a4 4 0 100-8 4 4 0 000 8z" />
            </svg>
            Admin
        </a>
        <a href="data-anggota"
            class="flex items-center gap-2 rounded-lg p-2 hover:bg-blue-700 hover:shadow-md transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14M5 12h14m-7 7v-7m0 0v-7m0 0V5" />
            </svg>
            Anggota
        </a>
    </div>

    <div class="m-3 col-start-2 rounded-lg">
        @yield('content')
    </div>
</body>

</html>
