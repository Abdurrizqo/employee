import axios from "axios";
import getRanting from "./getRanting";

const ratingForm = document.getElementById("ratingForm");

// Add event listener for form submission
ratingForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission behavior

    // Get the input value
    const namaRantingInput = document.getElementById("ranting_name");
    const namaRantingValue = namaRantingInput.value.trim(); // Trim whitespace

    // Validate the input value
    if (!namaRantingValue) {
        alert("Nama ranting tidak boleh kosong!");
        namaRantingInput.focus(); // Focus the input field for user correction
        return;
    }

    // If validation passes, you can proceed with your logic (e.g., send data to server)
    const csrfToken = document.querySelector('input[name="_token"]').value;
    const formData = {
        nama_ranting: namaRantingValue,
        _token: csrfToken
    };


    axios.post('/data-ranting/create', formData)
        .then((response) => {
            getRanting();  // Panggil fungsi untuk mendapatkan data ranting
        })
        .catch((error) => {
            console.error('Simpan data gagal', error);
        });
});
