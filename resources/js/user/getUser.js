import axios from "axios";
import $ from "jquery";

let searchValue = '';


function fetchAndRenderTable(searchTerm = "", page = 1) {
    $("#spinner").removeClass("hidden"); // Tampilkan spinner
    $("#spinner").addClass("flex");

    const url = `/data-user/all?page=${page}${searchTerm ? `&search=${searchTerm}` : ""}`;

    axios
        .get(url)
        .then((response) => {
            const resultFetchingAnggota = response.data.data;
            const angotas = resultFetchingAnggota.data;
            const currentPage = resultFetchingAnggota.current_page;
            const lastPage = resultFetchingAnggota.last_page;

            const tbody = $("#userTableBody");
            const paginationContainer = $(".pagination"); // Pastikan elemen ini ada di HTML

            tbody.empty();
            paginationContainer.empty();


            angotas.forEach((angota, index) => {
                const row = `
                    <tr data-anggota='${JSON.stringify(angota)}' class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                        ${index + 1}
                        </th>
                            <td class="px-6 py-4 text-center">${angota.nama_user}</td>
                <td class="px-6 py-4 text-center">${angota.username}</td>
                <td class="px-6 py-4 text-center">${angota.ranting.nama_ranting
                    }</td>
                        <td class="px-6 py-4 text-center ${angota.is_active
                        ? "text-green-500"
                        : "text-red-500"
                    }">
                            ${angota.is_active ? "Aktif" : "Tidak Aktif"}
                        </td>
                        <td class="px-6 py-4 text-center ${angota.is_open
                        ? "text-green-500"
                        : "text-red-500"
                    }">
                            ${angota.is_open ? "Lengkap" : "Belum Lengkap"}
                        </td>
                        <td>
                            <div class="flex gap-2 items-center justify-center w-[24rem]">
                                <button type='button' class="edit-btn px-8 py-2 text-sm font-medium text-white bg-green-600 border rounded-md hover:bg-green-500 focus:ring-2">
                                    Edit
                                </button>
                                ${angota.is_active
                        ? "<button type='button' class='delete-btn px-8 py-2 text-sm font-medium text-white bg-red-600 border rounded-md hover:bg-red-500'> Non Aktif </button>"
                        : "<button type='button' class='delete-btn px-8 py-2 text-sm font-medium text-white bg-blue-600 border rounded-md hover:bg-blue-500'> Aktif </button>"
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
        const anggota = $(this).closest("tr").data("anggota");

        $("#idAnggotaEdit").val(anggota.id);
        $("#nama_anggota_edit").val(anggota.nama_user);
        $("#usernameEdit").val(anggota.username);
        $("#passwordEdit").val('');
        $("#rantingEdit").find(`option[value="${anggota.id_ranting}"]`).prop("selected", true);

        $("#containerAdd").addClass("hidden");
        $("#containerEdit").removeClass("hidden");
    });

    $(document).on("click", "#btnBatalEdit", function () {
        $("#idAnggotaEdit").val('');
        $("#nama_anggota_edit").val('');
        $("#usernameEdit").val('');
        $("#passwordEdit").val('');
        $("#rantingEdit").val('');

        $("#containerAdd").removeClass("hidden");
        $("#containerEdit").addClass("hidden");
    })

    $(document).on("click", ".delete-btn", function () {
        const anggota = $(this).closest("tr").data("anggota");

        $("#modalDelete").addClass("flex");
        $("#modalDelete").removeClass("hidden");

        $("#titleModal").text(
            anggota.is_active
                ? "Nonaktifkan Anggota?"
                : "Aktifkan Anggota?"
        );
        $("#buttonTextDelete").text(
            anggota.is_active ? "Nonaktifkan" : "Aktifkan"
        );
        $("#idDelete").val(anggota.id);
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

        const anggotaId = $("#idDelete").val().trim();

        axios
            .put(`/data-user/switch/${anggotaId}`)
            .then((response) => {
                $("#buttonTextDelete").removeClass("hidden");
                $("#buttonTextDelete").text("");
                $("#spinnerDelete").addClass("hidden");
                $("#btnBatalDelete").prop("disabled", false);

                $("#modalDelete").removeClass("flex");
                $("#modalDelete").addClass("hidden");
                $("#titleModal").text("");
                $("#idDelete").val("");
                showNotification("Edit Anggota Berhasil", "successMessage");
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
                showNotification(`Edit Anggota Gagal ${error}`, "errorMessage");
            });
    });

    $("#editForm").on("submit", function (e) {
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

        const id_user = $("#idAnggotaEdit").val().trim();
        const namaUser = $("#nama_anggota_edit").val().trim();
        const usernameUser = $("#usernameEdit").val().trim();
        const passwordUser = $("#passwordEdit").val().trim();
        const rantingUser = $("#rantingEdit").val().trim();

        const formData = {
            nama_user: namaUser,
            username: usernameUser,
            password: passwordUser,
            id_ranting: rantingUser,
        };

        // Ambil elemen error
        const namaUserError = $("#namaAnggotaErrorEdit");
        const usernameError = $("#usernameErrorEdit");
        const passwordError = $("#passwordErrorEdit");
        const rantingError = $("#rantingErrorEdit");

        let isValid = true;

        if (namaUser.length < 4) {
            namaUserError.removeClass("hidden");
            isValid = false;
        } else {
            namaUserError.addClass("hidden");
        }

        // Validasi Username
        if (usernameUser.length < 4) {
            usernameError.removeClass("hidden");
            isValid = false;
        } else {
            usernameError.addClass("hidden");
        }

        // Validasi Ranting
        if (!rantingUser) {
            rantingError.removeClass("hidden");
            isValid = false;
        } else {
            rantingError.addClass("hidden");
        }

        // Validasi Password
        if (passwordUser.length < 6 || password.length > 24) {
            passwordError.removeClass("hidden");
            isValid = false;
        } else {
            passwordError.addClass("hidden");
        }

        // Jika semua validasi benar, kirim form
        if (isValid) {
            axios
                .put(`/data-user/update/${id_user}`, formData)
                .then((response) => {
                    $("#editForm")[0].reset(); // Mengosongkan semua input dalam form
                    fetchAndRenderTable(); // Panggil fungsi untuk memperbarui data
                    showNotification("Edit Anggota Berhasil", "successMessage");

                })
                .catch((error) => {
                    showNotification(`Edit Anggota Gagal ${error}`, "errorMessage");
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