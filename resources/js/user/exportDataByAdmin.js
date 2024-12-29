import axios from "axios";
import $ from "jquery";

$(document).ready(function () {
    // Event listener untuk tombol export
    $('#exportButton').on('click', function (e) {
        e.preventDefault();

        // Ambil nilai ranting dari select
        const ranting = $('#rantingExport').val();
        $('#pesanExport').text('Sedang mengolah data, mohon untuk tidak berpindah halaman').addClass('block').removeClass('hidden');

        // Tampilkan spinner
        $('#spinnerExport').removeClass('hidden');
        $('#exportButton p').text('').prop('disabled', true);

        // Kirim permintaan melalui Axios
        axios.get('/admin/export-warga', {
            responseType: 'blob', // Agar respons diterima sebagai file
        })
            .then((response) => {
                // Buat URL untuk mengunduh file
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'export_result.xlsx'); // Nama file hasil unduhan
                document.body.appendChild(link);
                link.click();

                // Sembunyikan spinner
                $('#spinnerExport').addClass('hidden');
                $('#exportButton p').text('Export Data').prop('disabled', false);
                $('#pesanExport').text('').addClass('hidden').removeClass('block');
            })
            .catch((error) => {
                console.error('Error during export:', error);

                // Tampilkan pesan kesalahan
                alert('Gagal melakukan ekspor data. Silakan coba lagi.');
                $('#spinnerExport').addClass('hidden');
                $('#exportButton p').text('Export Data').prop('disabled', false);
                $('#pesanExport').text('Export Gagal, Mohon Coba Lagi Nanti');
            });
    });
});
