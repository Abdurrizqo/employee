import axios from "axios";
import $ from "jquery";

let resultFetchingAdmin = null;
let searchValue = '';

function fetchAndRenderTable(searchTerm = "", page = 1) {
    $("#spinner").removeClass("hidden"); // Tampilkan spinner
    $("#spinner").addClass("flex");

    const url = `/data-admin/all?page=${page}${searchTerm ? `&search=${searchTerm}` : ""}`;

    axios
        .get(url)
        .then((response) => {
            resultFetchingAdmin = response.data.data;
            const admins = resultFetchingAdmin.data;
            const currentPage = resultFetchingAdmin.current_page;
            const lastPage = resultFetchingAdmin.last_page;

            const tbody = $("#adminTableBody");
            const paginationContainer = $(".pagination"); // Pastikan elemen ini ada di HTML

            tbody.empty();
            paginationContainer.empty();


            admins.forEach((admin, index) => {
                const row = `
                    <tr data-id="${admin.id
                    }" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            ${index + 1}
                        </th>
                            <td class="px-6 py-4 text-center">${admin.nama_admin}</td>
                <td class="px-6 py-4 text-center">${admin.username}</td>
                <td class="px-6 py-4 text-center">${admin.ranting.nama_ranting
                    }</td>
                        <td class="px-6 py-4 text-center ${admin.is_active
                        ? "text-green-500"
                        : "text-red-500"
                    }">
                            ${admin.is_active ? "Aktif" : "Tidak Aktif"}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex rounded-md items-center justify-center w-full">
                                <button type='button' class="edit-btn px-8 py-2 text-sm font-medium text-white bg-green-600 border rounded-s-lg hover:bg-green-500 focus:z-10 focus:ring-2">
                                    Edit
                                </button>
                                ${admin.is_active
                        ? "<button type='button' class='delete-btn px-8 py-2 text-sm font-medium text-white bg-red-600 border rounded-e-lg hover:bg-red-500'> Non Aktif </button>"
                        : "<button type='button' class='delete-btn px-8 py-2 text-sm font-medium text-white bg-blue-600 border rounded-e-lg hover:bg-blue-500'> Aktif </button>"
                    }
                            </div>
                        </td>
                    </tr>`;
                tbody.append(row);
            });

            //prev button
            const prevButton = $(`<a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 ${currentPage === 1 ? "pointer-events-none opacity-50" : ""
                }">Previous</a>`);

            prevButton.on("click", (e) => {
                e.preventDefault();
                fetchAndRenderTable(searchValue, currentPage - 1)

            });

            paginationContainer.append(prevButton);


            //number list
            let startPage = Math.max(1, currentPage - 2); // Awal range
            let endPage = Math.min(lastPage, currentPage + 2); // Akhir range

            if (startPage > 1) {
                const firstPageButton = $(`
                    <li>
                        <a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">1</a>
                    </li>
                `);

                firstPageButton.on("click", (e) => {
                    e.preventDefault();
                    console.log("ini di awal " + 1);
                    fetchAndRenderTable(searchValue, 1)

                });

                paginationContainer.append(firstPageButton);

                // Tambahkan "..." jika ada gap
                if (startPage > 2) {
                    const dots = $(`
                        <li>
                            <span class="flex items-center px-3 h-8 text-gray-500">...</span>
                        </li>
                    `);
                    paginationContainer.append(dots);
                }
            }

            for (let page = startPage; page <= endPage; page++) {
                const pageButton = $(`
                    <li>
                        <button class="flex items-center px-3 h-8 ${page === currentPage
                        ? "text-blue-600 bg-blue-50"
                        : "text-gray-500 bg-white"
                    } border border-gray-300 hover:bg-gray-100">${page}</button>
                    </li>
                `);

                pageButton.on("click", (e) => {
                    e.preventDefault();
                    console.log("ini di dalam looping " + page);
                    fetchAndRenderTable(searchValue, page)
                });

                paginationContainer.append(pageButton);
            }

            if (endPage < lastPage) {
                // Tambahkan "..." jika ada gap
                if (endPage < lastPage - 1) {
                    const dots = $(`
                        <li><span class="flex items-center px-3 h-8 text-gray-500">...</span></li>
                    `);
                    paginationContainer.append(dots);
                }

                // Tambahkan halaman terakhir
                const lastPageButton = $(`
                    <li>
                        <a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">${lastPage}</a>
                    </li>
                `);

                lastPageButton.on("click", (e) => {
                    e.preventDefault();
                    fetchAndRenderTable(searchValue, lastPage)
                });

                paginationContainer.append(lastPageButton);
            }

            // Tombol Next
            const nextButton = $(`
                                <li><a href="#" class="flex items-center px-3 h-8 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 ${currentPage === lastPage ? "pointer-events-none opacity-50" : ""}">Next</a></li>`);

            nextButton.on("click", (e) => {
                e.preventDefault();
                if (currentPage < lastPage) {
                    console.log("Next button clicked");
                    fetchAndRenderTable(searchValue, currentPage + 1)
                }
            });

            paginationContainer.append(nextButton);

        }).catch((error) => {
            alert("Gagal mengambil data. Coba lagi nanti.");
            console.log(error);
        })
        .finally(() => {
            $("#spinner").addClass("hidden"); // Tampilkan spinner
            $("#spinner").removeClass("flex");
        });
}

$(document).ready(function () {
    fetchAndRenderTable();

    $("#searchForm").on("submit", function (e) {
        e.preventDefault();
        searchValue = $("#search").val().trim(); // Ambil nilai dari input pencarian
        fetchAndRenderTable(searchValue); // Kirim nilai pencarian ke fungsi
    });
})