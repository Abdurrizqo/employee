import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    // server: {
    //     host: true, // Mengizinkan koneksi dari jaringan lain
    //     hmr: {
    //         host: "10.20.31.249", // Ganti dengan IP lokal komputer Anda
    //     },
    // },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/admin/addAdmin.js",
                "resources/js/admin/getAdmin.js",
                "resources/js/ranting/addRanting.js",
                "resources/js/ranting/getRanting.js",
                "resources/js/user/addUser.js",
                "resources/js/user/addUserByAdmin.js",
                "resources/js/user/exportData.js",
                "resources/js/user/exportDataByAdmin.js",
                "resources/js/user/FirstTimeLogin.js",
                "resources/js/user/getUser.js",
                "resources/js/user/getUserByRanting.js",
            ],
            refresh: false,
        }),
    ],
});
