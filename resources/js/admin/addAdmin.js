import axios from "axios";
import getAdmin from "./getAdmin";
import $ from "jquery";
import fetchAndRenderTable from "../admin/getAdmin";

$("#adminForm").on("submit", function (event) {
    event.preventDefault(); // Mencegah pengiriman form jika ada error

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
            })
            .catch((error) => {
                console.log(error);
                alert(error);
            });
    }
});

