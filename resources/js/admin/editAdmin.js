import axios from "axios";
import getAdmin from "./getAdmin";

document
    .getElementById("adminFormEdit")
    .addEventListener("submit", function (event) {
        event.preventDefault(); // Mencegah pengiriman form jika ada error

        // Ambil nilai input
        const namaAdmin = document
            .getElementById("nama_admin_edit")
            .value.trim();
        const username = document.getElementById("usernameEdit").value.trim();
        const password = document.getElementById("passwordEdit").value.trim();
        const ranting = document.getElementById("rantingEdit").value;
        const idAdmin = document.getElementById("idAdminEdit").value;

        // Ambil elemen error
        const namaAdminError = document.getElementById("namaAdminErrorEdit");
        const usernameError = document.getElementById("usernameErrorEdit");
        const passwordError = document.getElementById("passwordErrorEdit");
        const rantingError = document.getElementById("rantingErrorEdit");

        let isValid = true;

        // Validasi Nama Admin
        if (namaAdmin.length < 4) {
            namaAdminError.classList.remove("hidden");
            isValid = false;
        } else {
            namaAdminError.classList.add("hidden");
        }

        // Validasi Username
        if (username.length < 4) {
            usernameError.classList.remove("hidden");
            isValid = false;
        } else {
            usernameError.classList.add("hidden");
        }

        // Validasi Ranting
        if (!ranting) {
            rantingError.classList.remove("hidden");
            isValid = false;
        } else {
            rantingError.classList.add("hidden");
        }

        // Validasi Password
        if (
            password.length > 0 &&
            (password.length < 6 || password.length > 24)
        ) {
            passwordError.classList.remove("hidden");
            isValid = false;
        } else {
            passwordError.classList.add("hidden");
        }

        // Jika semua validasi benar, kirim form
        if (isValid) {
            axios
                .put(`/data-admin/update/${idAdmin}`, {
                    nama_admin: namaAdmin,
                    username: username,
                    password: password, // Hanya kirim password jika ada perubahan
                    id_ranting: ranting,
                })
                .then((response) => {
                    containerEdit.classList.add("hidden");
                    containerAdd.classList.remove("hidden");

                    // Mengosongkan form edit
                    document.getElementById("adminFormEdit").reset(); // Mengosongkan semua input dalam form

                    // Menyembunyikan pesan error (jika ada)
                    const errorMessages = document.querySelectorAll(
                        "#containerEdit .text-red-500"
                    );
                    errorMessages.forEach((error) =>
                        error.classList.add("hidden")
                    );

                    // Menghapus selected pada dropdown (ranting) dan set ke pilihan pertama atau default
                    const rantingSelect =
                        document.getElementById("rantingEdit");
                    rantingSelect.selectedIndex = 0;
                    alert("Data admin berhasil diperbarui");
                    getAdmin(); // Memperbarui data admin setelah berhasil
                })
                .catch((error) => {
                    alert("Terjadi kesalahan: " + error.message);
                });
        }
    });
