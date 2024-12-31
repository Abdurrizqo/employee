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
    <nav
        class="w-full flex items-center justify-end gap-3 bg-white border-b border-gray-200 h-20 sticky top-0 z-10 px-10">
        <p class="text-xl font-medium border-r border-gray-600 pr-3">Logout</p>

        <a href="/logout" class="active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 text-red-500 hover:text-red-700">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
            </svg>
        </a>
    </nav>

    @yield('content')

    <script>
        window.onload = function() {
            // Cek jika pesan sukses ada
            var successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 3000); // Sembunyikan setelah 3 detik
            }

            // Cek jika pesan error ada
            var errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 3000); // Sembunyikan setelah 3 detik
            }
        };
    </script>

</body>

</html>
