import axios from "axios";
import $ from "jquery";

let searchValue = '';

function fetchAndRenderTable(searchTerm = "", page = 1) {
    $("#spinner").removeClass("hidden"); // Tampilkan spinner
    $("#spinner").addClass("flex");

    const url = `/data-admin/all?page=${page}${searchTerm ? `&search=${searchTerm}` : ""}`;

    axios
        .get(url)
        .then((response) => {
            const resultFetchingAdmin = response.data.data;
            const admins = resultFetchingAdmin.data;
            const currentPage = resultFetchingAdmin.current_page;
            const lastPage = resultFetchingAdmin.last_page;

            const tbody = $("#adminTableBody");
            const paginationContainer = $(".pagination"); // Pastikan elemen ini ada di HTML

            tbody.empty();
            paginationContainer.empty();


            admins.forEach((admin, index) => {
                const row = `
                    <tr data-admin='${JSON.stringify(admin)}' class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                        ${index + 1}
                        </th>
                            <td class="px-6 py-4 text-center">${admin.nama_admin}</td>
                <td class="px-6 py-4 text-center">${admin.username}</td>
                <td class="px-6 py-4 text-center">${admin.ranting.nama_ranting
                    }</td>
                        <td class="px-6 py-4 text-center ${admin.is_active
                        ? "text-green-500"
                        : "text-red-500"
                    }">
                            ${admin.is_active ? "Aktif" : "Tidak Aktif"}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex rounded-md items-center justify-center w-[16rem]">
                                <button type='button' class="edit-btn px-8 py-2 text-sm font-medium text-white bg-green-600 border rounded-s-lg hover:bg-green-500 focus:z-10 focus:ring-2">
                                    Edit
                                </button>
                                ${admin.is_active
                        ? "<button type='button' class='delete-btn px-8 py-2 text-sm font-medium text-white bg-red-600 border rounded-e-lg hover:bg-red-500'> Non Aktif </button>"
                        : "<button type='button' class='delete-btn px-8 py-2 text-sm font-medium text-white bg-blue-600 border rounded-e-lg hover:bg-blue-500'> Aktif </button>"
                    }
                            </div>
                        </td>
                    </tr>`;
                tbody.append(row);
            });

            //prev button
            const prevButton = $(`<a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 ${currentPage === 1 ? "pointer-events-none opacity-50" : ""
                }">Previous</a>`);

            prevButton.on("click", (e) => {
                e.preventDefault();
                fetchAndRenderTable(searchValue, currentPage - 1)

            });

            paginationContainer.append(prevButton);


            //number list
            let startPage = Math.max(1, currentPage - 2); // Awal range
            let endPage = Math.min(lastPage, currentPage + 2); // Akhir range

            if (startPage > 1) {
                const firstPageButton = $(`
                    <li>
                        <a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">1</a>
                    </li>
                `);

                firstPageButton.on("click", (e) => {
                    e.preventDefault();
                    fetchAndRenderTable(searchValue, 1)

                });

                paginationContainer.append(firstPageButton);

                // Tambahkan "..." jika ada gap
                if (startPage > 2) {
                    const dots = $(`
                        <li>
                            <span class="flex items-center px-3 h-8 text-gray-500">...</span>
                        </li>
                    `);
                    paginationContainer.append(dots);
                }
            }

            for (let page = startPage; page <= endPage; page++) {
                const pageButton = $(`
                    <li>
                        <button class="flex items-center px-3 h-8 ${page === currentPage
                        ? "text-blue-600 bg-blue-50"
                        : "text-gray-500 bg-white"
                    } border border-gray-300 hover:bg-gray-100">${page}</button>
                    </li>
                `);

                pageButton.on("click", (e) => {
                    e.preventDefault();
                    fetchAndRenderTable(searchValue, page)
                });

                paginationContainer.append(pageButton);
            }

            if (endPage < lastPage) {
                // Tambahkan "..." jika ada gap
                if (endPage < lastPage - 1) {
                    const dots = $(`
                        <li><span class="flex items-center px-3 h-8 text-gray-500">...</span></li>
                    `);
                    paginationContainer.append(dots);
                }

                // Tambahkan halaman terakhir
                const lastPageButton = $(`
                    <li>
                        <a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">${lastPage}</a>
                    </li>
                `);

                lastPageButton.on("click", (e) => {
                    e.preventDefault();
                    fetchAndRenderTable(searchValue, lastPage)
                });

                paginationContainer.append(lastPageButton);
            }

            // Tombol Next
            const nextButton = $(`
                                <li><a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 ${currentPage === lastPage ? "pointer-events-none opacity-50" : ""}">Next</a></li>`);

            nextButton.on("click", (e) => {
                e.preventDefault();
                if (currentPage < lastPage) {
                    fetchAndRenderTable(searchValue, currentPage + 1)
                }
            });

            paginationContainer.append(nextButton);

        }).catch((error) => {
            alert("Gagal mengambil data. Coba lagi nanti.");
            console.log(error);
        })
        .finally(() => {
            $("#spinner").addClass("hidden"); // Tampilkan spinner
            $("#spinner").removeClass("flex");
        });
}

$(document).ready(function () {
    fetchAndRenderTable();

    $("#searchForm").on("submit", function (e) {
        e.preventDefault();
        searchValue = $("#search").val().trim(); // Ambil nilai dari input pencarian
        fetchAndRenderTable(searchValue); // Kirim nilai pencarian ke fungsi
    });

    $(document).on("click", ".edit-btn", function () {
        const admin = $(this).closest("tr").data("admin");

        $("#idAdminEdit").val(admin.id);
        $("#nama_admin_edit").val(admin.nama_admin);
        $("#usernameEdit").val(admin.username);
        $("#passwordEdit").val('');
        $("#rantingEdit").find(`option[value="${admin.id_ranting}"]`).prop("selected", true);

        $("#containerAdd").addClass("hidden");
        $("#containerEdit").removeClass("hidden");
    });

    $(document).on("click", "#btnBatalEdit", function () {
        $("#idAdminEdit").val('');
        $("#nama_admin_edit").val('');
        $("#usernameEdit").val('');
        $("#passwordEdit").val('');
        $("#rantingEdit").val('');

        $("#containerAdd").removeClass("hidden");
        $("#containerEdit").addClass("hidden");
    })

    $(document).on("click", ".delete-btn", function () {
        const admin = $(this).closest("tr").data("admin");

        $("#modalDelete").addClass("flex");
        $("#modalDelete").removeClass("hidden");

        $("#titleModal").text(
            admin.is_active
                ? "Nonaktifkan Admin?"
                : "Aktifkan Admin?"
        );
        $("#buttonTextDelete").text(
            admin.is_active ? "Nonaktifkan" : "Aktifkan"
        );
        $("#idDelete").val(admin.id);
    });

    $(document).on("click", "#btnBatalDelete", function () {
        $("#modalDelete").removeClass("flex");
        $("#modalDelete").addClass("hidden");
        $("#titleModal").text("");
        $("#buttonTextDelete").text("");
        $("#idDelete").val("");
    });

    $(document).on("click", "#btnDelete", function () {
        $("#spinnerDelete").removeClass("hidden");
        $("#buttonTextDelete").addClass("hidden");
        $("#btnBatalDelete").prop("disabled", true);

        const adminId = $("#idDelete").val().trim();

        axios
            .put(`/data-admin/switch/${adminId}`)
            .then((response) => {
                $("#buttonTextDelete").removeClass("hidden");
                $("#buttonTextDelete").text("");
                $("#spinnerDelete").addClass("hidden");
                $("#btnBatalDelete").prop("disabled", false);

                $("#modalDelete").removeClass("flex");
                $("#modalDelete").addClass("hidden");
                $("#titleModal").text("");
                $("#idDelete").val("");
                fetchAndRenderTable();
                showNotification("Edit Admin Berhasil", "successMessage");
            })
            .catch((error) => {
                $("#buttonTextDelete").removeClass("hidden");
                $("#buttonTextDelete").text("");
                $("#spinnerDelete").addClass("hidden");
                $("#btnBatalDelete").prop("disabled", false);

                $("#modalDelete").removeClass("flex");
                $("#modalDelete").addClass("hidden");
                $("#titleModal").text("");
                $("#idDelete").val("");
                showNotification(`Edit Admin Gagal ${error}`, "errorMessage");
            });
    });

    $("#adminFormEdit").on("submit", function (e) {
        e.preventDefault();

        const $submitButton = $(this).find("button[type='submit']");
        const $btnBatal = $(this).find("#btnBatalEdit");
        const $spinner = $(this).find("#spinnerEdit");

        // Sembunyikan tombol Simpan dan Batal
        $submitButton.addClass("hidden");
        $btnBatal.addClass("hidden");

        // Tampilkan spinner
        $spinner.removeClass("hidden");
        $spinner.addClass("flex");

        const idAdmin = $("#idAdminEdit").val().trim();
        const namaAdmin = $("#nama_admin_edit").val().trim();
        const usernameAdmin = $("#usernameEdit").val().trim();
        const passwordAdmin = $("#passwordEdit").val().trim();
        const rantingAdmin = $("#rantingEdit").val().trim();

        const formData = {
            nama_admin: namaAdmin,
            username: usernameAdmin,
            password: passwordAdmin,
            id_ranting: rantingAdmin,
        };

        // Ambil elemen error
        const namaAdminError = $("#namaAdminErrorEdit");
        const usernameError = $("#usernameErrorEdit");
        const passwordError = $("#passwordErrorEdit");
        const rantingError = $("#rantingErrorEdit");

        let isValid = true;

        // Validasi Nama Admin
        if (namaAdmin.length < 4) {
            namaAdminError.removeClass("hidden");
            isValid = false;
        } else {
            namaAdminError.addClass("hidden");
        }

        // Validasi Username
        if (usernameAdmin.length < 4) {
            usernameError.removeClass("hidden");
            isValid = false;
        } else {
            usernameError.addClass("hidden");
        }

        // Validasi Ranting
        if (!rantingAdmin) {
            rantingError.removeClass("hidden");
            isValid = false;
        } else {
            rantingError.addClass("hidden");
        }

        // Validasi Password
        if (passwordAdmin.length < 6 || password.length > 24) {
            passwordError.removeClass("hidden");
            isValid = false;
        } else {
            passwordError.addClass("hidden");
        }

        // Jika semua validasi benar, kirim form
        if (isValid) {
            axios
                .put(`/data-admin/update/${idAdmin}`, formData)
                .then((response) => {
                    $("#adminFormEdit")[0].reset(); // Mengosongkan semua input dalam form
                    fetchAndRenderTable(); // Panggil fungsi untuk memperbarui data
                    showNotification("Edit Admin Berhasil", "successMessage");

                })
                .catch((error) => {
                    showNotification(`Edit Admin Gagal ${error}`, "errorMessage");
                }).finally(() => {
                    $submitButton.removeClass("hidden");
                    $btnBatal.removeClass("hidden");
                    $spinner.addClass("hidden");

                    $("#containerAdd").removeClass("hidden");
                    $("#containerEdit").addClass("hidden");
                });
        }
    });
});

function showNotification(message, type) {
    const notification = $("#notificationMessage");

    notification
        .removeClass("hidden successMessage errorMessage") // Hapus kelas sebelumnya
        .addClass(type);

    notification.text(message);

    notification.removeClass("hidden");

    setTimeout(() => {
        notification.addClass("hidden");
    }, 4000);
}

export default fetchAndRenderTable;