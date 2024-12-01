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

    const renderTable = (admins) => {
        tbody.innerHTML = ""; // Kosongkan tabel sebelumnya

        admins.forEach((admin, index) => {
            const row = document.createElement("tr");
            row.className = "odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700";
            row.innerHTML = `
                <th scope="row" class="px-6 py-4 text-center">${index + 1}</th>
                <td class="px-6 py-4 text-center">${admin.nama_admin}</td>
                <td class="px-6 py-4 text-center">${admin.username}</td>
                <td class="px-6 py-4 text-center">${admin.ranting.nama_ranting}</td>
                <td class="px-6 py-4 text-center">${admin.is_active ? "Aktif" : "Tidak Aktif"}</td>
                <td class="px-6 py-4 text-center">
                    <div class="inline-flex">
                        <button class="text-white bg-green-600 px-3 py-1">Edit</button>
                        <button class="text-white bg-red-600 px-3 py-1">Delete</button>
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
            <a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 ${currentPage === 1 ? "pointer-events-none opacity-50" : ""
            }">Previous</a>
        `;
        prevButton.addEventListener("click", (e) => {
            e.preventDefault();
            if (currentPage > 1) fetchAdmins(currentPage - 1);
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
                <a href="#" class="flex items-center px-3 h-8 ${page === currentPage
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
            <a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 ${currentPage === lastPage ? "pointer-events-none opacity-50" : ""
            }">Next</a>
        `;
        nextButton.addEventListener("click", (e) => {
            e.preventDefault();
            if (currentPage < lastPage) fetchAdmins(currentPage + 1);
        });
        paginationContainer.appendChild(nextButton);
    };

    // Panggil data awal
    fetchAdmins(currentPage);
}

document.addEventListener('DOMContentLoaded', function () {
    getAdmin();
});

export default getAdmin;
