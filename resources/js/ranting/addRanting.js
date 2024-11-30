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
    const formData = {
        nama_rating: namaRantingValue,
    };

    // Example: Log the form data to the console
    console.log("Form submitted with data:", formData);

    // Optionally, send the data via fetch or another method
    // fetch('/api/rating', {
    //     method: 'POST',
    //     headers: { 'Content-Type': 'application/json' },
    //     body: JSON.stringify(formData),
    // }).then(response => response.json())
    //   .then(data => console.log(data))
    //   .catch(error => console.error('Error:', error));
});
