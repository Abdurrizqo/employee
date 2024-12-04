import axios from "axios";

const tbody = document.querySelector("table tbody");
const paginationContainer = document.querySelector(".pagination"); // Container <ul>
let fetchingResult = null;
let selectDelete = null;

const fetchAdmins = async (page = 1) => {
    try {
        const response = await axios.get(`/data-admin/all?page=${page}`);
        const data = response.data;

        // Render data admin ke tabel
        fetchingResult = data.data.data;
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
        fetchingResult = data.data.data;
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
                    <div class="inline-flex rounded-md items-center justify-center w-full">
                        <button type='button' class="edit-btn px-8 py-2 text-sm font-medium text-white bg-green-600 border rounded-s-lg hover:bg-green-500 focus:z-10 focus:ring-2">
                            Edit
                        </button>
                        ${
                            admin.is_active
                                ? "<button type='button' class='delete-btn px-8 py-2 text-sm font-medium text-white bg-red-600 border rounded-e-lg hover:bg-red-500'> Non Aktif </button>"
                                : "<button type='button' class='delete-btn px-8 py-2 text-sm font-medium text-white bg-blue-600 border rounded-e-lg hover:bg-blue-500'> Aktif </button>"
                        }
                        
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

function fillFormEdit(dataAdmin) {
    document.getElementById("nama_admin_edit").value = dataAdmin.nama_admin;
    document.getElementById("usernameEdit").value = dataAdmin.username;
    document.getElementById("idAdminEdit").value = dataAdmin.id;

    // Mengisi dropdown ranting dengan ID yang sesuai
    const rantingSelect = document.getElementById("rantingEdit");
    // Mencari option dengan value yang sesuai dengan id_ranting
    for (let option of rantingSelect.options) {
        if (option.value === dataAdmin.id_ranting) {
            option.selected = true;
            break;
        }
    }

    // Mengisi password field, tetapi hanya jika ada password di data (sebaiknya tidak memaparkan password asli)
    document.getElementById("passwordEdit").value = ""; // Kosongkan field password, karena kita tidak ingin memaparkan password asli.

    // Menghilangkan pesan error jika ada
    document.getElementById("namaAdminErrorEdit").classList.add("hidden");
    document.getElementById("usernameErrorEdit").classList.add("hidden");
    document.getElementById("rantingErrorEdit").classList.add("hidden");
    document.getElementById("passwordErrorEdit").classList.add("hidden");
}

function deletSwitchedAdmin(id) {
    if (id) {
        axios
            .put(`/data-admin/switch/${id}`)
            .then((response) => {
                alert("Ganti Status Admin Berhasil!!!");
                const modalDelete = document.getElementById("modalDelete");
                modalDelete.classList.add("hidden");
                modalDelete.classList.remove("flex");
                getAdmin();
            })
            .catch((error) => {
                alert("Ganti Status Gagal!!!!, Coba Lagi Beberapa Saat");
            });
    }
}

function getAdmin() {
    const urlParams = new URLSearchParams(window.location.search);
    const searchValue = urlParams.get("search");
    const currentPage = 1;

    if (searchValue === null) {
        fetchAdmins(currentPage);
    } else {
        fetchAdminsWithSearch(currentPage, searchValue);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnBatalDelete").addEventListener("click", (e) => {
        const modalDelete = document.getElementById("modalDelete");
        modalDelete.classList.add("hidden");
        modalDelete.classList.remove("flex");
        selectDelete = "";
    });

    document.getElementById("btnBatalEdit").addEventListener("click", (e) => {
        // Menyembunyikan container edit dan menampilkan container add
        const containerAdd = document.getElementById("containerAdd");
        const containerEdit = document.getElementById("containerEdit");

        containerEdit.classList.add("hidden");
        containerAdd.classList.remove("hidden");

        // Mengosongkan form edit
        document.getElementById("adminFormEdit").reset(); // Mengosongkan semua input dalam form

        // Menyembunyikan pesan error (jika ada)
        const errorMessages = document.querySelectorAll(
            "#containerEdit .text-red-500"
        );
        errorMessages.forEach((error) => error.classList.add("hidden"));

        // Menghapus selected pada dropdown (ranting) dan set ke pilihan pertama atau default
        const rantingSelect = document.getElementById("rantingEdit");
        rantingSelect.selectedIndex = 0;
    });

    document.getElementById("btnDelete").addEventListener("click", (e) => {
        deletSwitchedAdmin(selectDelete);
        selectDelete = "";
    });

    tbody.addEventListener("click", function (e) {
        if (e.target.classList.contains("edit-btn")) {
            const row = e.target.closest("tr");
            const adminId = row.getAttribute("data-id"); // Ambil ID dari data-id

            const containerAdd = document.getElementById("containerAdd");
            const containerEdit = document.getElementById("containerEdit");

            containerAdd.classList.add("hidden");
            containerEdit.classList.remove("hidden");

            const selectedItem = fetchingResult.find((item) => {
                return item.id === adminId;
            });

            fillFormEdit(selectedItem);
        }

        if (e.target.classList.contains("delete-btn")) {
            const row = e.target.closest("tr");
            const adminId = row.getAttribute("data-id"); // Ambil ID dari data-id

            const selectedItem = fetchingResult.find((item) => {
                return item.id === adminId;
            });

            const modalDelete = document.getElementById("modalDelete");
            document.getElementById('contentModal').innerHTML = selectedItem.is_active ?'Lanjutkan menonaktifkan admin':'Lanjutkan mengaktifkan admin';
            document.getElementById('titleModal').innerHTML = selectedItem.is_active ?'Non aktifkan admin?':'Aktifkan admin?';
            document.getElementById("btnDelete").innerHTML = selectedItem.is_active ?'Delete?':'Aktifkan';
            modalDelete.classList.add("flex");
            modalDelete.classList.remove("hidden");
            selectDelete = adminId;
        }
    });

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
                fetchAdmins(1);
            } else {
                fetchAdminsWithSearch(1, searchValue);
            }
        });

    getAdmin();
});

export default getAdmin;
