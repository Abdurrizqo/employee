<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <title>Document</title>
</head>

<body class="bg-white flex items-center justify-center p-4">
    <div class="w-full bg-white rounded-md border shadow p-4 md:p-8">
        <div class="mb-8">
            <h1 class="text-blue-700 font-semibold text-xl">Kelengkapan Informasi Biodata Anggota</h1>
            <p class="text-gray-500 text-sm">
                Harap lengkapi semua informasi biodata anggota di bawah ini dengan benar. Data yang Anda isi akan
                digunakan untuk keperluan administrasi dan disimpan dengan aman. Pastikan semua kolom wajib diisi sesuai
                dokumen resmi seperti KTP atau KK.
            </p>
        </div>

        <form method="POST" enctype="multipart/form-data">
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4 text-sm">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @csrf

            <!-- Nama Lengkap -->
            <div class="mb-5">
                <label for="nama_lengkap" class="block text-sm font-medium text-gray-900">Nama Lengkap Beserta
                    Gelar</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Nama Lengkap" required />
            </div>

            <div class="grid grid-col-1 md:grid-cols-2 md:gap-6">
                <!-- Nomer Induk Warga -->
                <div class="mb-5">
                    <label for="nomer_induk_warga" class="block text-sm font-medium text-gray-900">Nomer Induk
                        Warga</label>
                    <input type="text" id="nomer_induk_warga" name="nomer_induk_warga"
                        value="{{ old('nomer_induk_warga') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Nomer Induk Warga" required />
                </div>

                <!-- Nomer Induk Keluarga -->
                <div class="mb-5">
                    <label for="nomer_induk_keluarga" class="block text-sm font-medium text-gray-900">Nomer Induk
                        Keluarga</label>
                    <input type="text" id="nomer_induk_keluarga" name="nomer_induk_keluarga"
                        value="{{ old('nomer_induk_keluarga') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Nomer Induk Keluarga" required />
                </div>
            </div>

            <div class="grid grid-col-1 md:grid-cols-2 md:gap-6">
                <!-- Gambar Nomer Induk Warga -->
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Kartu Nomer Induk
                        Warga</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                        aria-describedby="file_input_help" id="file_input" type="file" name="kartu_warga"
                        accept="image/*">
                    <p class="mt-1 text-sm text-gray-500" id="file_input_help">Gambar (MAX 3mb).</p>
                    @error('kartu_warga')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Gambar KTP-->
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input_ktp">Kartu Tanda
                        Penduduk</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                        aria-describedby="file_input_help_ktp" id="file_input_ktp" type="file" name="ktp"
                        accept="image/*">
                    <p class="mt-1 text-sm text-gray-500" id="file_input_help_ktp">Gambar (MAX 3mb).</p>
                    @error('ktp')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-col-1 md:grid-cols-2 md:gap-6">
                <!-- Tempat Lahir -->
                <div class="mb-5">
                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-900">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Tempat Lahir" required />
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-5">
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-900">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
            </div>

            <div class="grid grid-col-1 md:grid-cols-2 md:gap-6">

                <!-- Jenis Kelamin -->
                <div class="mb-5">
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-900">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Pria">Pria</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <!-- Status Pernikahan -->
                <div class="mb-5">
                    <label for="status_pernikahan" class="block text-sm font-medium text-gray-900">Status
                        Pernikahan</label>
                    <select id="status_pernikahan" name="status_pernikahan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="">Pilih Status</option>
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Kawin">Kawin</option>
                        <option value="Duda">Duda</option>
                        <option value="Janda">Janda</option>
                    </select>
                </div>

            </div>

            <!-- Alamat -->
            <div class="mb-5">
                <label for="alamat" class="block text-sm font-medium text-gray-900">Alamat</label>
                <textarea id="alamat" name="alamat"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-20"
                    placeholder="Alamat Lengkap" required>{{ old('alamat') }}</textarea>
            </div>

            <section class="mt-12 mb-6">
                <h2 class="text-blue-700 font-semibold text-lg">Informasi Pekerjaan</h2>
                <p class="text-gray-500 text-sm">
                    Silakan lengkapi informasi terkait pekerjaan Anda. Jika Anda tidak memiliki pekerjaan saat ini, Anda
                    dapat mengosongkan kolom yang tidak relevan.
                </p>
            </section>

            <div class="grid grid-col-1 md:grid-cols-2 md:gap-6">
                <!-- Jenis Pekerjaan -->
                <div class="mb-5">
                    <label for="jenis_pekerjaan" class="block text-sm font-medium text-gray-900">Jenis
                        Pekerjaan</label>
                    <select id="jenis_pekerjaan" name="jenis_pekerjaan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="">Pilih Jenis Pekerjaan</option>
                        <option value="Pedagang">Pedagang</option>
                        <option value="Wiraswasta">Wiraswasta</option>
                        <option value="Swasta">Swasta</option>
                        <option value="Karyawan Perusahaan">Karyawan Perusahaan</option>
                        <option value="ASN">ASN</option>
                        <option value="TNI">TNI</option>
                        <option value="POLRI">POLRI</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Lembaga/Instansi -->
                <div class="mb-5">
                    <label for="lembaga_instansi"
                        class="block text-sm font-medium text-gray-900">Lembaga/Instansi</label>
                    <input type="text" id="lembaga_instansi" name="lembaga_instansi"
                        value="{{ old('lembaga_instansi') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Lembaga/Instansi" required />
                </div>
            </div>

            <!-- Alamat Lembaga/Instansi -->
            <div class="mb-5">
                <label for="alamat_lembaga_instansi" class="block text-sm font-medium text-gray-900">Alamat
                    Lembaga/Instansi</label>
                <textarea id="alamat_lembaga_instansi" name="alamat_lembaga_instansi"
                    class="bg-gray-50 border h-20 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Alamat Lembaga/Instansi" required>{{ old('alamat_lembaga_instansi') }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">
                Submit
            </button>
        </form>
    </div>

</body>

</html>
