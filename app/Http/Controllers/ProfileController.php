<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function firstTimeLogin()
    {
        return view('User.FirstTimeLogin');
    }

    public function kelengkapanBiodata()
    {
        return view('User.KelengkapanBiodata');
    }

    public function addOrUpdateBiodata(Request $request)
    {
        $user = Auth::guard('guard_user')->user();
        $biodata = Biodata::where('id_user', $user->id)->first();

        // Validasi input
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomer_induk_warga' => 'required|string|max:255|unique:biodatas,nomer_induk_warga,' . $biodata->id,
            'nomer_induk_keluarga' => 'required|string|max:255',
            'kartu_warga' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072', // Validasi file PDF maksimal 3MB
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072', // Validasi file PDF maksimal 3MB
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Pria,Perempuan',
            'status_pernikahan' => 'required|in:Belum Kawin,Kawin,Duda,Janda',
            'alamat' => 'required|string',
            'jenis_pekerjaan' => 'nullable|in:Pedagang,Wiraswasta,Swasta,Karyawan Perusahaan,ASN,TNI,POLRI,Lainnya',
            'lembaga_instansi' => 'nullable|string|max:255',
            'alamat_lembaga_instansi' => 'nullable|string',
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',

            'nomer_induk_warga.required' => 'Nomor induk warga harus diisi.',
            'nomer_induk_warga.string' => 'Nomor induk warga harus berupa teks.',
            'nomer_induk_warga.unique' => 'Nomor induk warga sudah terdaftar.',
            'nomer_induk_warga.max' => 'Nomor induk warga tidak boleh lebih dari 255 karakter.',

            'nomer_induk_keluarga.required' => 'Nomor induk keluarga harus diisi.',
            'nomer_induk_keluarga.string' => 'Nomor induk keluarga harus berupa teks.',
            'nomer_induk_keluarga.max' => 'Nomor induk keluarga tidak boleh lebih dari 255 karakter.',

            'kartu_warga.image' => 'File bukan merupakan gambar.',
            'kartu_warga.max' => 'Ukuran file melebihi 3mb.',
            'kartu_warga.mimes' => 'Gambar harus berupa PNG,JPG,JPEG.',

            'ktp.image' => 'File bukan merupakan gambar.',
            'ktp.max' => 'Ukuran file melebihi 3mb.',
            'ktp.mimes' => 'Gambar harus berupa PNG,JPG,JPEG.',

            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tempat_lahir.string' => 'Tempat lahir harus berupa teks.',
            'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 255 karakter.',

            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',

            'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',

            'status_pernikahan.required' => 'Status pernikahan harus diisi.',
            'status_pernikahan.in' => 'Status pernikahan harus salah satu dari pilihan berikut: Belum Kawin, Kawin, Duda, Janda.',

            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',

            'jenis_pekerjaan.in' => 'Jenis pekerjaan tidak sesuai.',

            'lembaga_instansi.string' => 'Lembaga/Instansi harus berupa teks.',
            'lembaga_instansi.max' => 'Lembaga/Instansi tidak boleh lebih dari 255 karakter.',

            'alamat_lembaga_instansi.string' => 'Alamat lembaga/instansi harus berupa teks.',
        ]);

        try {


            // Simpan data ke database
            $data = [
                'id_user' => Auth::guard('guard_user')->id(), // Ambil ID user yang login
                'nama_lengkap' => $validated['nama_lengkap'],
                'nomer_induk_warga' => $validated['nomer_induk_warga'],
                'nomer_induk_keluarga' => $validated['nomer_induk_keluarga'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'status_pernikahan' => $validated['status_pernikahan'],
                'alamat' => $validated['alamat'],
                'jenis_pekerjaan' => $validated['jenis_pekerjaan'],
                'lembaga_instansi' => $validated['lembaga_instansi'],
                'alamat_lembaga_instansi' => $validated['alamat_lembaga_instansi'],
            ];

            if ($biodata) {
                if ($request->hasFile('kartu_warga')) {
                    if ($biodata->kartu_warga && Storage::exists($biodata->kartu_warga)) {
                        Storage::delete($biodata->kartu_warga);
                    }

                    $file = $request->file('kartu_warga');
                    $path = $file->storeAs('private/kartu_warga', time() . '_' . $file->getClientOriginalName()); // Simpan di storage/app/private/sertifikat
                    $data['kartu_warga'] = $path; // Simpan path file
                }

                if ($request->hasFile('ktp')) {
                    if ($biodata->ktp && Storage::exists($biodata->ktp)) {
                        Storage::delete($biodata->ktp);
                    }

                    $file = $request->file('ktp');
                    $path = $file->storeAs('private/ktp', time() . '_' . $file->getClientOriginalName()); // Simpan di storage/app/private/sertifikat
                    $data['ktp'] = $path; // Simpan path file
                }

                $biodata->update($data);
            } else {

                if ($request->hasFile('kartu_warga')) {
                    $file = $request->file('kartu_warga');
                    $path = $file->storeAs('private/kartu_warga', time() . '_' . $file->getClientOriginalName()); // Simpan di storage/app/private/sertifikat
                    $data['kartu_warga'] = $path; // Simpan path file
                }

                if ($request->hasFile('ktp')) {
                    $file = $request->file('ktp');
                    $path = $file->storeAs('private/ktp', time() . '_' . $file->getClientOriginalName()); // Simpan di storage/app/private/sertifikat
                    $data['ktp'] = $path; // Simpan path file
                }

                Biodata::create($data);
            }


            User::where('id', $user->id)->update([
                'is_open' => true
            ]);

            // Redirect ke dashboard jika berhasil
            return redirect('/dashboard')->with('success', 'Data biodata berhasil disimpan.');
        } catch (\Exception $e) {
            // Redirect kembali jika ada kesalahan
            return back()->withErrors(['error' => 'Gagal menyimpan data biodata. Silakan coba lagi.'])->withInput();
        }
    }

    public function editBiodataUser()
    {
        $user = Auth::guard('guard_user')->user();
        $biodata = Biodata::where('id_user', $user->id)->first();

        return view('User.editBiodataUser', [
            'biodata' => $biodata
        ]);
    }

    public function getKartuWarga($id)
    {
        $item = Biodata::findOrFail($id);

        if ($item->kartu_warga && Storage::exists($item->kartu_warga)) {
            return Storage::download($item->kartu_warga);
        }

        abort(404, 'File tidak ditemukan.');
    }

    public function getKTP($id)
    {
        $item = Biodata::findOrFail($id);

        if ($item->ktp && Storage::exists($item->ktp)) {
            return Storage::download($item->ktp);
        }

        abort(404, 'File tidak ditemukan.');
    }
}
