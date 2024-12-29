import axios from "axios";
import $ from "jquery";
import fetchAndRenderTable from "../user/getUser";

$("#addForm").on("submit", function (event) {
    event.preventDefault(); // Mencegah pengiriman form jika ada error

    const $submitButton = $(this).find("button[type='submit']");
    const $spinner = $submitButton.find("#spinnerAdd");
    const $text = $submitButton.find("p");

    // Saat mulai mengirimkan data
    $spinner.show(); // Tampilkan spinner
    $text.hide();
    // Ambil nilai input
    const namauser = $("#nama_anggota").val().trim();
    const username = $("#username").val().trim();
    const password = $("#password").val().trim();
    const ranting = $("#ranting").val();

    // Ambil elemen error
    const namaUserError = $("#namaAnggotaError");
    const usernameError = $("#usernameError");
    const passwordError = $("#passwordError");
    const rantingError = $("#rantingError");

    let isValid = true;

    // Validasi Nama Admin
    if (namauser.length < 4) {
        namaUserError.removeClass("hidden");
        isValid = false;
    } else {
        namaUserError.addClass("hidden");
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
            .post("/data-user/create", {
                nama_user: namauser,
                username: username,
                password: password,
                id_ranting: ranting,
            })
            .then((response) => {
                $("#addForm")[0].reset(); // Mengosongkan semua input dalam form
                fetchAndRenderTable(); // Panggil fungsi untuk memperbarui data
                showNotification("Tambah Anggota Berhasil", "successMessage");
            })
            .catch((error) => {
                showNotification(`Tambah Anggota Gagal ${error}`, "errorMessage");
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
