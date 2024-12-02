import axios from "axios";

async function getAdmin() {
    const tbody = document.querySelector("table tbody");
    const paginationContainer = document.querySelector(".pagination"); // Container <ul>

    let currentPage = 1; // Halaman default

    const fetchAdmins = async (page = 1) => {
        try {
            const response = await axios.get(`/data-admin/all?page=${page}`);
            const data = response.data;

            // Render data admin ke tabel
            renderTable(data.data.data);

            // Render pagination
            renderPagination(data.data.current_page, data.data.last_page);
        } catch (error) {
            console.error("Gagal mengambil data:", error);
        }
    };

    const fetchAdminsWithSearch = async (page = 1, search) => {
        try {
            const response = await axios.get(
                `/data-admin/all?search=${search}&page=${page}`
            );
            const data = response.data;

            // Render data admin ke tabel
            renderTable(data.data.data);

            // Render pagination
            renderPagination(data.data.current_page, data.data.last_page);
        } catch (error) {
            console.error("Gagal mengambil data:", error);
        }
    };

    const renderTable = (admins) => {
        tbody.innerHTML = ""; // Kosongkan tabel sebelumnya

        admins.forEach((admin, index) => {
            const row = document.createElement("tr");
            row.setAttribute("data-id", admin.id);
            row.className =
                "odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700";
            row.innerHTML = `
                <th scope="row" class="px-6 py-4 text-center">${index + 1}</th>
                <td class="px-6 py-4 text-center">${admin.nama_admin}</td>
                <td class="px-6 py-4 text-center">${admin.username}</td>
                <td class="px-6 py-4 text-center">${
                    admin.ranting.nama_ranting
                }</td>
                <td class="px-6 py-4 text-center">${
                    admin.is_active ? "Aktif" : "Tidak Aktif"
                }</td>
                <td class="px-6 py-4 text-center">
                    <div class="inline-flex rounded-md shadow-sm items-center justify-center w-full">
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
    };

    const renderPagination = (currentPage, lastPage) => {
        paginationContainer.innerHTML = ""; // Kosongkan pagination sebelumnya

        // Tombol Previous
        const prevButton = document.createElement("li");
        prevButton.innerHTML = `
            <a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 ${
                currentPage === 1 ? "pointer-events-none opacity-50" : ""
            }">Previous</a>
        `;
        prevButton.addEventListener("click", (e) => {
            e.preventDefault();
            const urlParams = new URLSearchParams(window.location.search);
            const searchValue = urlParams.get("search");
            if (searchValue === null) {
                if (currentPage > 1) fetchAdmins(currentPage - 1);
            } else {
                if (currentPage > 1)
                    fetchAdminsWithSearch(currentPage - 1, searchValue);
            }
        });
        paginationContainer.appendChild(prevButton);

        // Nomor halaman
        let startPage = Math.max(1, currentPage - 2); // Awal range
        let endPage = Math.min(lastPage, currentPage + 2); // Akhir range

        if (startPage > 1) {
            // Tambahkan halaman pertama jika startPage bukan 1
            const firstPageButton = document.createElement("li");
            firstPageButton.innerHTML = `
                <a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">1</a>
            `;
            firstPageButton.addEventListener("click", (e) => {
                e.preventDefault();
                fetchAdmins(1);
            });
            paginationContainer.appendChild(firstPageButton);

            // Tambahkan "..." jika ada gap
            if (startPage > 2) {
                const dots = document.createElement("li");
                dots.innerHTML = `<span class="flex items-center px-3 h-8 text-gray-500">...</span>`;
                paginationContainer.appendChild(dots);
            }
        }

        for (let page = startPage; page <= endPage; page++) {
            const pageButton = document.createElement("li");
            pageButton.innerHTML = `
                <a href="#" class="flex items-center px-3 h-8 ${
                    page === currentPage
                        ? "text-blue-600 bg-blue-50"
                        : "text-gray-500 bg-white"
                } border border-gray-300 hover:bg-gray-100">${page}</a>
            `;
            pageButton.addEventListener("click", (e) => {
                e.preventDefault();
                fetchAdmins(page);
            });
            paginationContainer.appendChild(pageButton);
        }

        if (endPage < lastPage) {
            // Tambahkan "..." jika ada gap
            if (endPage < lastPage - 1) {
                const dots = document.createElement("li");
                dots.innerHTML = `<span class="flex items-center px-3 h-8 text-gray-500">...</span>`;
                paginationContainer.appendChild(dots);
            }

            // Tambahkan halaman terakhir
            const lastPageButton = document.createElement("li");
            lastPageButton.innerHTML = `
                <a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">${lastPage}</a>
            `;
            lastPageButton.addEventListener("click", (e) => {
                e.preventDefault();
                fetchAdmins(lastPage);
            });
            paginationContainer.appendChild(lastPageButton);
        }

        // Tombol Next
        const nextButton = document.createElement("li");
        nextButton.innerHTML = `
            <a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 ${
                currentPage === lastPage ? "pointer-events-none opacity-50" : ""
            }">Next</a>
        `;
        nextButton.addEventListener("click", (e) => {
            e.preventDefault();
            const urlParams = new URLSearchParams(window.location.search);
            const searchValue = urlParams.get("search");

            if (searchValue === null) {
                if (currentPage < lastPage) fetchAdmins(currentPage + 1);
            } else {
                if (currentPage < lastPage)
                    fetchAdminsWithSearch(currentPage + 1, searchValue);
            }
        });
        paginationContainer.appendChild(nextButton);
    };

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
            if (currentUrl.toString() === null) {
                fetchAdmins(currentPage);
            } else {
                fetchAdminsWithSearch(currentPage, searchValue);
            }
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

    // Panggil data awal

    const urlParams = new URLSearchParams(window.location.search);
    const searchValue = urlParams.get("search");

    if (searchValue === null) {
        fetchAdmins(currentPage);
    } else {
        fetchAdminsWithSearch(currentPage, searchValue);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    getAdmin();
});

export default getAdmin;
