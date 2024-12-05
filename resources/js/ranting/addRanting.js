import $ from "jquery";
import fetchAndRenderTable from "./getRanting";

$(document).ready(function () {
    $("#ratingForm").on("submit", function (e) {
        e.preventDefault();
        const rantingName = $("#ranting_name").val().trim(); // Ambil nilai dari input pencarian
        const csrfToken = document.querySelector('input[name="_token"]').value;

        if (!rantingName) {
            $("#rantingNameError").removeClass("hidden");
        } else {
            $("#rantingNameError").addClass("hidden"); // Sembunyikan pesan error jika input valid
        }

        const formData = {
            nama_ranting: rantingName,
            _token: csrfToken,
        };

        $("#buttonText").addClass("hidden"); // Sembunyikan teks "Simpan"
        $("#spinnerAdd").removeClass("hidden");

        axios
            .post("/data-ranting/create", formData)
            .then((response) => {
                fetchAndRenderTable();
                $("#ranting_name").val("");

                $("#buttonText").removeClass("hidden");
                $("#spinnerAdd").addClass("hidden");
                showNotification("Tambah Ranting Berhasil", "successMessage");
            })
            .catch((error) => {
                $("#buttonText").removeClass("hidden");
                $("#spinnerAdd").addClass("hidden");
                showNotification(`Tambah Ranting Gagal ${error}`, 'errorMessage');
            });
    });
});

function showNotification(message, type) {
    const notification = $("#notificationMessage");

    // Set kelas berdasarkan tipe (success atau error)
    notification
        .removeClass("hidden successMessage errorMessage") // Hapus kelas sebelumnya
        .addClass(type); // Tambahkan kelas berdasarkan tipe

    // Set teks pesan
    notification.text(message);

    // Tampilkan elemen
    notification.removeClass("hidden");

    // Sembunyikan elemen setelah 12 detik
    setTimeout(() => {
        notification.addClass("hidden");
    }, 4000); // 12000ms = 12 detik
}
