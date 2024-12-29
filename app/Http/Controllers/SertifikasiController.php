<?php

namespace App\Http\Controllers;

use App\Models\Sertifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SertifikasiController extends Controller
{
    public function getSertifikasi()
    {
        $user = Auth::guard('guard_user')->user();

        $sertifikasi = Sertifikasi::where('id_user', $user->id)->get();
        return view('User.dataSertifikasi', ['sertifikasi' => $sertifikasi]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'tingkat' => 'required|in:Internasional,Nasional,Provinsi,Daerah,Cabang',
            'dokumen_sertifikasi' => 'nullable|file|mimes:pdf|max:3072',
            'penyelenggara' => 'required|string|max:255',
            'sertifikasi' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'), // Validasi file PDF maksimal 3MB
        ],[
            'tingkat.in' => "Data tingkat tidak valid",
            'dokumen_sertifikasi.file' => "Bukti sertifikat harus berupa PDF",
            'dokumen_sertifikasi.max' => "Bukti sertifikat harus kurang dari 3mb",
            'penyelenggara.max' => "Penyelenggara maksimal 255 karakter",
            'sertifikasi.max' => "Penyelenggara maksimal 255 karakter",
            'tahun.max' => "Tahun tidak dapat lebih dari tahun saat ini",
        ]);

        try {
            $data = $validated;

            $user = Auth::guard('guard_user')->user();

            // Handle upload file sertifikat
            if ($request->hasFile('dokumen_sertifikasi')) {
                $file = $request->file('dokumen_sertifikasi');
                $path = $file->storeAs('private/dokumen_sertifikasi', time() . '_' . $file->getClientOriginalName()); // Simpan di storage/app/private/sertifikat
                $data['dokumen_sertifikasi'] = $path; // Simpan path file
            }

            $data['id_user'] = $user->id;

            Sertifikasi::create($data);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan data: ' . $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            // Cari data berdasarkan ID
            $item = Sertifikasi::findOrFail($id);

            // Hapus data
            $item->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }

    public function getDokumenSertifikasi($id)
    {
        $item = Sertifikasi::findOrFail($id);

        if ($item->dokumen_sertifikasi && Storage::exists($item->dokumen_sertifikasi)) {
            return Storage::download($item->dokumen_sertifikasi);
        }

        abort(404, 'File tidak ditemukan.');
    }
}
