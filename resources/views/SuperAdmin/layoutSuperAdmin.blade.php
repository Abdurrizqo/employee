<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body class="grid grid-cols-1 lg:grid-cols-[200px_1fr] h-screen bg-gray-100">
    <div
        class="font-medium py-5 hidden lg:flex flex-col px-4 gap-4 text-sm border-r bg-gradient-to-b from-blue-500 to-blue-600 text-white h-screen">
        <a href="dashboard" class="{{ setActiveSegmentWildcard('dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 10h11M9 21V3M21 10h-6m0 0h6M21 10V3" />
            </svg>
            Home
        </a>
        <a href="list-ranting" class="{{ setActiveSegmentWildcard('list-ranting') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l-4-4m0 0l4-4m-4 4h16" />
            </svg>
            Ranting
        </a>
        <a href="list-admin" class="{{ setActiveSegmentWildcard('list-admin') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 17v-2a4 4 0 10-8 0v2m4-6a4 4 0 100-8 4 4 0 000 8z" />
            </svg>
            Admin
        </a>
    </div>

    <div class="p-3 col-start-1 lg:col-start-2 rounded-lg flex flex-col gap-3">
        @yield('content')
    </div>
</body>

</html>
