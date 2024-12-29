<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <title>Document</title>
</head>

<body>
    <nav class="w-full bg-white border-b shadow text-sm flex justify-end items-center p-4 gap-3">
        <p class="text-sm md:text-base border-r border-gray-600 pr-2">Halo, <span
                class="text-blue-700">{{ auth('guard_user')->user()->nama_user }}</span></p>

        <!-- Dropdown Container -->
        <div class="relative">
            <!-- Button (Tiga Titik Vertikal) -->
            <button id="dropdownButton" class="p-2 rounded-full hover:bg-gray-200 focus:outline-none"
                onclick="toggleDropdown()">
                <!-- Icon Tiga Titik -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v.01M12 12v.01M12 18v.01" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg hidden">
                <a href="dashboard/edit-akun" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Edit Akun</a>
                <a href="/logout" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
            </div>
        </div>
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

        // JavaScript to toggle dropdown menu visibility
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('hidden');
        }

        // Optional: Close dropdown if clicked outside
        document.addEventListener('click', function(event) {
            const dropdownButton = document.getElementById('dropdownButton');
            const dropdownMenu = document.getElementById('dropdownMenu');
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
