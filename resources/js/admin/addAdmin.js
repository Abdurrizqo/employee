import axios from "axios";
import getAdmin from "./getAdmin";

document.getElementById('adminForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Mencegah pengiriman form jika ada error

    // Ambil nilai input
    const namaAdmin = document.getElementById('nama_admin').value.trim();
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    const ranting = document.getElementById('ranting').value;

    // Ambil elemen error
    const namaAdminError = document.getElementById('namaAdminError');
    const usernameError = document.getElementById('usernameError');
    const passwordError = document.getElementById('passwordError');
    const rantingError = document.getElementById('rantingError');

    let isValid = true;

    // Validasi Nama Admin
    if (namaAdmin.length < 4) {
        namaAdminError.classList.remove('hidden');
        isValid = false;
    } else {
        namaAdminError.classList.add('hidden');
    }

    // Validasi Username
    if (username.length < 4) {
        usernameError.classList.remove('hidden');
        isValid = false;
    } else {
        usernameError.classList.add('hidden');
    }

    // Validasi Ranting
    if (!ranting) {
        rantingError.classList.remove('hidden');
        isValid = false;
    } else {
        rantingError.classList.add('hidden');
    }

    // Validasi Password
    if (password.length < 6 || password.length > 24) {
        passwordError.classList.remove('hidden');
        isValid = false;
    } else {
        passwordError.classList.add('hidden');
    }

    // Jika semua validasi benar, kirim form
    if (isValid) {
        axios.post('/data-admin/create', {
            nama_admin: namaAdmin,
            username: username,
            password: password,
            id_ranting: ranting
        })
            .then((response) => {
                getAdmin()
            })
            .catch(error => alert(error));
    }
});
