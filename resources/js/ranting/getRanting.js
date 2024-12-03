import axios from "axios";

function getRanting() {
    // Ambil elemen <tbody>
    const tbody = document.querySelector("tbody");
    // Fungsi untuk mengambil data ranting
    async function fetchRantings() {
        try {
            // Fetch data dari endpoint menggunakan Axios
            const response = await axios.get("/data-ranting/all");
            const rantings = response.data.data;

            // Hapus konten lama di <tbody>
            tbody.innerHTML = "";

            // Iterasi data dan buat baris tabel
            rantings.forEach((ranting, index) => {
                const row = document.createElement("tr");
                row.setAttribute("data-id", ranting.id);
                row.className =
                    "odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700";

                row.innerHTML = `
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                    ${index + 1}
                </th>
                <td class="px-6 py-4 text-center">${ranting.nama_ranting}</td>
                <td class="px-6 py-4 text-center ${
                    ranting.is_active ? "text-green-500" : "text-red-500"
                } ">${ranting.is_active ? "Aktif" : "Tidak Aktif"}</td>
                <td class="px-6 py-4 text-center">
                    <div class="inline-flex rounded-md items-center justify-center w-full">
                        <button type='button' class="edit-btn px-8 py-2 text-sm font-medium text-white bg-green-600 border rounded-s-lg hover:bg-green-500 focus:z-10 focus:ring-2">
                            Edit
                        </button>
                        <button type='button' class="delete-btn px-8 py-2 text-sm font-medium text-white bg-red-600 border rounded-e-lg hover:bg-red-500">
                            Delete
                        </button>
                    </div>
                </td>
            `;

                tbody.appendChild(row);
            });
        } catch (error) {
            console.error("Gagal mengambil data ranting:", error);
        }
    }

    async function fetchRantingsWithSearch(search) {
        try {
            // Fetch data dari endpoint menggunakan Axios
            const response = await axios.get(
                `/data-ranting/all?search=${search}`
            );
            const rantings = response.data.data;

            // Hapus konten lama di <tbody>
            tbody.innerHTML = "";

            // Iterasi data dan buat baris tabel
            rantings.forEach((ranting, index) => {
                const row = document.createElement("tr");
                row.setAttribute("data-id", ranting.id);
                row.className =
                    "odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700";

                row.innerHTML = `
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                    ${index + 1}
                </th>
                <td class="px-6 py-4 text-center">${ranting.nama_ranting}</td>
                <td class="px-6 py-4 text-center">${
                    ranting.is_active ? "Aktif" : "Tidak Aktif"
                }</td>
                <td class="px-6 py-4 text-center">
                    <div class="inline-flex rounded-md items-center justify-center w-full">
                        <button type='button' class="edit-btn px-8 py-2 text-sm font-medium text-white bg-green-600 border rounded-s-lg hover:bg-green-500 focus:z-10 focus:ring-2">
                            Edit
                        </button>
                        <button type='button' class="delete-btn px-8 py-2 text-sm font-medium text-white bg-red-600 border rounded-e-lg hover:bg-red-500">
                            Delete
                        </button>
                    </div>
                </td>
            `;

                tbody.appendChild(row);
            });
        } catch (error) {
            alert("Gagal mengambil data ranting:", error);
        }
    }

    document
        .getElementById("search-btn")
        .addEventListener("click", function (e) {
            e.preventDefault(); // Mencegah reload halaman default

            // Ambil nilai input dari field "search"
            const searchValue = document.getElementById("search").value.trim();

            // Perbarui URL tanpa reload jika ada nilai pencarian
            const currentUrl = new URL(window.location.href);

            if (searchValue) {
                currentUrl.searchParams.set("search", searchValue); // Tambahkan parameter search
            } else {
                currentUrl.searchParams.delete("search"); // Hapus parameter jika input kosong
            }

            // Perbarui URL tanpa reload
            window.history.pushState({}, "", currentUrl.toString());
            fetchRantingsWithSearch(searchValue);
        });

    tbody.addEventListener("click", function (e) {
        if (e.target.classList.contains("edit-btn")) {
            const row = e.target.closest("tr");
            const rantingId = row.getAttribute("data-id"); // Ambil ID dari data-id
            console.log("Edit Ranting ID:", rantingId);
            // Lakukan aksi edit dengan ID tersebut
        }

        if (e.target.classList.contains("delete-btn")) {
            const row = e.target.closest("tr");
            const rantingId = row.getAttribute("data-id"); // Ambil ID dari data-id
            console.log("Delete Ranting ID:", rantingId);
            // Lakukan aksi delete dengan ID tersebut
        }
    });

    // Panggil fungsi untuk fetch data
    const urlParams = new URLSearchParams(window.location.search);
    const searchValue = urlParams.get("search");

    if (searchValue === null) {
        fetchRantings();
    } else {
        fetchRantingsWithSearch(searchValue);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    getRanting();
});

export default getRanting;
