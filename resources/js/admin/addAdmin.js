import axios from "axios";
import $ from "jquery";
import fetchAndRenderTable from "../admin/getAdmin";

$("#adminForm").on("submit", function (event) {
    event.preventDefault(); // Mencegah pengiriman form jika ada error

    const $submitButton = $(this).find("button[type='submit']");
    const $spinner = $submitButton.find("#spinnerAdd");
    const $text = $submitButton.find("p");

    // Saat mulai mengirimkan data
    $spinner.show(); // Tampilkan spinner
    $text.hide();
    // Ambil nilai input
    const namaAdmin = $("#nama_admin").val().trim();
    const username = $("#username").val().trim();
    const password = $("#password").val().trim();
    const ranting = $("#ranting").val();

    // Ambil elemen error
    const namaAdminError = $("#namaAdminError");
    const usernameError = $("#usernameError");
    const passwordError = $("#passwordError");
    const rantingError = $("#rantingError");

    let isValid = true;

    // Validasi Nama Admin
    if (namaAdmin.length < 4) {
        namaAdminError.removeClass("hidden");
        isValid = false;
    } else {
        namaAdminError.addClass("hidden");
    }

    // Validasi Username
    if (username.length < 4) {
        usernameError.removeClass("hidden");
        isValid = false;
    } else {
        usernameError.addClass("hidden");
    }

    // Validasi Ranting
    if (!ranting) {
        rantingError.removeClass("hidden");
        isValid = false;
    } else {
        rantingError.addClass("hidden");
    }

    // Validasi Password
    if (password.length < 6 || password.length > 24) {
        passwordError.removeClass("hidden");
        isValid = false;
    } else {
        passwordError.addClass("hidden");
    }

    // Jika semua validasi benar, kirim form
    if (isValid) {
        axios
            .post("/data-admin/create", {
                nama_admin: namaAdmin,
                username: username,
                password: password,
                id_ranting: ranting,
            })
            .then((response) => {
                $("#adminForm")[0].reset(); // Mengosongkan semua input dalam form
                fetchAndRenderTable(); // Panggil fungsi untuk memperbarui data
                showNotification("Tambah Admin Berhasil", "successMessage");
            })
            .catch((error) => {
                showNotification(`Tambah Admin Gagal ${error}`, "errorMessage");
            }).finally(() => {
                $spinner.hide(); // Tampilkan spinner
                $text.show();
            });
    }
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
