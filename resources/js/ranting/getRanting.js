import $ from "jquery";

let resultFetchingRanting = null;

function fetchAndRenderTable(searchTerm = "") {
    $("#spinner").removeClass("hidden"); // Tampilkan spinner
    $("#spinner").addClass("flex"); // Tampilkan spinner

    const url = `/data-ranting/all${searchTerm ? `?search=${searchTerm}` : ""}`;

    axios
        .get(url)
        .then((response) => {
            resultFetchingRanting = response.data.data;
            const tbody = $("#rantingTableBody");
            tbody.empty(); // Kosongkan tabel sebelum menambahkan baris baru

            // Loop melalui data dan tambahkan ke tabel
            resultFetchingRanting.forEach((ranting, index) => {
                const row = `
                    <tr data-id="${ranting.id
                    }" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            ${index + 1}
                        </th>
                        <td class="px-6 py-4 text-center">${ranting.nama_ranting
                    }</td>
                        <td class="px-6 py-4 text-center ${ranting.is_active
                        ? "text-green-500"
                        : "text-red-500"
                    }">
                            ${ranting.is_active ? "Aktif" : "Tidak Aktif"}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex rounded-md items-center justify-center w-[16rem]">
                                <button type='button' class="edit-btn px-8 py-2 text-sm font-medium text-white bg-green-600 border rounded-s-lg hover:bg-green-500 focus:z-10 focus:ring-2">
                                    Edit
                                </button>
                                ${ranting.is_active
                        ? "<button type='button' class='delete-btn px-8 py-2 text-sm font-medium text-white bg-red-600 border rounded-e-lg hover:bg-red-500'> Non Aktif </button>"
                        : "<button type='button' class='delete-btn px-8 py-2 text-sm font-medium text-white bg-blue-600 border rounded-e-lg hover:bg-blue-500'> Aktif </button>"
                    }
                            </div>
                        </td>
                    </tr>`;
                tbody.append(row);
            });
        })
        .catch((error) => {
            alert("Gagal mengambil data. Coba lagi nanti.");
        })
        .finally(() => {
            $("#spinner").addClass("hidden"); // Tampilkan spinner
            $("#spinner").removeClass("flex");
        });
}

$(document).ready(function () {
    // Jalankan fetchAndRenderTable pertama kali tanpa pencarian
    fetchAndRenderTable();

    // Event listener untuk tombol "Cari"
    $("#searchForm").on("submit", function (e) {
        e.preventDefault();
        const searchTerm = $("#search").val().trim(); // Ambil nilai dari input pencarian
        fetchAndRenderTable(searchTerm); // Kirim nilai pencarian ke fungsi
    });

    $(document).on("click", ".edit-btn", function () {
        // Ambil ID dari atribut 'data-id' pada elemen tr induk
        const rantingId = $(this).closest("tr").data("id");
        $("#formAddRanting").addClass("hidden");
        $("#formEditRanting").removeClass("hidden");

        const selectedItem = resultFetchingRanting.find((item) => {
            return item.id === rantingId;
        });

        $("#idEdit").val(selectedItem.id);
        $("#ranting_name_edit").val(selectedItem.nama_ranting);
    });

    $(document).on("click", ".delete-btn", function () {
        // Ambil ID dari atribut 'data-id' pada elemen tr induk
        const rantingId = $(this).closest("tr").data("id");
        $("#modalDelete").addClass("flex");
        $("#modalDelete").removeClass("hidden");

        const selectedItem = resultFetchingRanting.find((item) => {
            return item.id === rantingId;
        });

        $("#titleModal").text(
            selectedItem.is_active
                ? "Nonaktifkan Ranting?"
                : "Aktifkan Ranting?"
        );
        $("#buttonTextDelete").text(
            selectedItem.is_active ? "Nonaktifkan" : "Aktifkan"
        );
        $("#idDelete").val(rantingId);
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

        const rantingId = $("#idDelete").val().trim();

        axios
            .put(`/data-ranting/switch/${rantingId}`)
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
                showNotification("Edit Ranting Berhasil", "successMessage");
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
                showNotification(`Edit Ranting Gagal ${error}`, "errorMessage");
            });


    });

    $(document).on("click", "#btnBatalEdit", function () {
        $("#formAddRanting").removeClass("hidden");
        $("#formEditRanting").addClass("hidden");

        $("#idEdit").val("");
        $("#ranting_name_edit").val("");
    });

    $("#submitEdit").on("submit", function (e) {
        e.preventDefault();

        const rantingName = $("#ranting_name_edit").val().trim();
        const rantingId = $("#idEdit").val().trim();
        const csrfToken = document.querySelector('input[name="_token"]').value;

        if (!rantingName) {
            $("#rantingNameErrorEdit").removeClass("hidden");
        } else {
            $("#rantingNameErrorEdit").addClass("hidden");
        }

        const formData = {
            nama_ranting: rantingName,
            _token: csrfToken,
        };

        $("#buttonTextEdit").addClass("hidden"); // Sembunyikan teks "Simpan"
        $("#spinnerEdit").removeClass("hidden");
        $("#btnBatalEdit").prop("disabled", true);

        axios
            .put(`/data-ranting/update/${rantingId}`, formData)
            .then((response) => {
                $("#ranting_name_edit").val("");

                $("#buttonTextEdit").removeClass("hidden");
                $("#spinnerEdit").addClass("hidden");
                $("#btnBatalEdit").prop("disabled", false);
                $("#formAddRanting").removeClass("hidden");
                $("#formEditRanting").addClass("hidden");
                showNotification("Edit Ranting Berhasil", "successMessage");
            })
            .catch((error) => {
                $("#buttonTextEdit").removeClass("hidden");
                $("#spinnerEdit").addClass("hidden");
                $("#btnBatalEdit").prop("disabled", false);
                showNotification(`Edit Ranting Gagal ${error}`, "errorMessage");
            });
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
