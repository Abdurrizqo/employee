<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body class="grid grid-cols-[48px_1fr] lg:grid-cols-[200px_1fr] min-h-screen bg-gray-100">
    <!-- Mobile Sidebar -->
    <div
        class="fixed w-[48px] z-10 py-5 lg:hidden flex flex-col items-center gap-4 text-sm border-r bg-gradient-to-b from-blue-500 to-blue-600 text-white h-screen">
        <a href="dashboard" class="{{ setActiveSegmentWildcardMobile('dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="white" viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                    d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                <path
                    d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
            </svg>
        </a>
        <a href="list-ranting" class="{{ setActiveSegmentWildcardMobile('list-ranting') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="white" viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                    d="M5.566 4.657A4.505 4.505 0 0 1 6.75 4.5h10.5c.41 0 .806.055 1.183.157A3 3 0 0 0 15.75 3h-7.5a3 3 0 0 0-2.684 1.657ZM2.25 12a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3v-6ZM5.25 7.5c-.41 0-.806.055-1.184.157A3 3 0 0 1 6.75 6h10.5a3 3 0 0 1 2.683 1.657A4.505 4.505 0 0 0 18.75 7.5H5.25Z" />
            </svg>
        </a>
        <a href="list-admin" class="{{ setActiveSegmentWildcardMobile('list-admin') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 17v-2a4 4 0 10-8 0v2m4-6a4 4 0 100-8 4 4 0 000 8z" />
            </svg>
        </a>
    </div>

    <!-- Desktop Sidebar -->
    <div
        class="font-medium fixed w-[200px] z-10 py-5 hidden lg:flex flex-col px-4 gap-4 text-sm border-r bg-gradient-to-b from-blue-500 to-blue-600 text-white h-screen">
        <a href="dashboard" class="{{ setActiveSegmentWildcard('dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="white" viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                    d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                <path
                    d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
            </svg>
            Home
        </a>
        <a href="list-ranting" class="{{ setActiveSegmentWildcard('list-ranting') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="white" viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                    d="M5.566 4.657A4.505 4.505 0 0 1 6.75 4.5h10.5c.41 0 .806.055 1.183.157A3 3 0 0 0 15.75 3h-7.5a3 3 0 0 0-2.684 1.657ZM2.25 12a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3v-6ZM5.25 7.5c-.41 0-.806.055-1.184.157A3 3 0 0 1 6.75 6h10.5a3 3 0 0 1 2.683 1.657A4.505 4.505 0 0 0 18.75 7.5H5.25Z" />
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

    <!-- Main Content -->
    <div class="p-3 col-start-2 rounded-lg flex flex-col gap-3 overflow-x-auto">
        @yield('content')
    </div>
</body>


</html>
