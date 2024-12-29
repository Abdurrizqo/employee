import axios from "axios";
import $ from "jquery";

$(document).ready(function () {
    $('form').on('submit', function (e) {
        // Prevent form submission
        e.preventDefault();

        // Get form values
        const namaLengkap = $('#nama_user').val().trim();
        const username = $('#username').val().trim();
        const password = $('#password').val().trim();
        const passwordConfirmation = $('#password_confirmation').val().trim();

        // Initialize valid flag
        let isValid = true;

        // Clear previous errors
        $('.error-message').remove();

        // Validation rules
        if (namaLengkap.length < 4) {
            isValid = false;
            $('#nama_user').after('<p class="error-message text-xs text-red-400">Nama lengkap harus minimal 4 karakter.</p>');
        }

        if (username.length < 4) {
            isValid = false;
            $('#username').after('<p class="error-message text-xs text-red-400">Username harus minimal 4 karakter.</p>');
        }

        if (password.length < 6 || password.length > 24) {
            isValid = false;
            $('#password').after('<p class="error-message text-xs text-red-400">Password harus 6-24 karakter.</p>');
        }

        if (password !== passwordConfirmation) {
            isValid = false;
            $('#password_confirmation').after('<p class="error-message text-xs text-red-400">Konfirmasi password harus sama dengan password.</p>');
        }

        // If valid, allow form submission
        if (isValid) {
            this.submit();
        }
    });
});