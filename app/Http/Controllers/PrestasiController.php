<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function getPrestasi()
    {
        $user = Auth::guard('guard_user')->user();

        $prestasi = Prestasi::where('id_user', $user->id)->get();
        return view('User.dataPrestasi', ['prestasi' => $prestasi]);
    }

    public function getPrestasiByadmin($id)
    {
        $prestasi = Prestasi::where('id_user', $id)->get();
        return view('Admin.dataPrestasi', [
            'prestasi' => $prestasi,
            'idUser' => $id
        ]);
    }

    public function getPrestasiBySuperAdmin($id)
    {
        $prestasi = Prestasi::where('id_user', $id)->get();
        return view('SuperAdmin.dataPrestasi', [
            'prestasi' => $prestasi,
            'idUser' => $id
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'tingkat' => 'required|in:Internasional,Nasional,Provinsi,Daerah,Cabang',
            'prestasi' => 'required|string|max:255',
            'tahun' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'), // Validasi file PDF maksimal 3MB
            'sertifikat_prestasi' => 'nullable|file|mimes:pdf|max:3072', // Validasi file PDF maksimal 3MB
        ], [
            'tingkat.in' => 'data Tingkat tidak valid',
            'prestasi.in' => 'prestasi maksimal 255 karakter',
            'prestasi.max' => 'tahun tidak dapat lebih dari tahun saat ini',
            'sertifikat_prestasi.file' => 'sertifikat harus PDF',
            'sertifikat_prestasi.max' => 'sertifikat maksimal 3mb',
        ]);

        try {
            $data = $validated;

            $user = Auth::guard('guard_user')->user();

            if ($request->hasFile('sertifikat_prestasi')) {
                $file = $request->file('sertifikat_prestasi');
                $path = $file->storeAs('private/sertifikat_prestasi', time() . '_' . $file->getClientOriginalName()); // Simpan di storage/app/private/sertifikat
                $data['sertifikat_prestasi'] = $path; // Simpan path file
            }

            $data['id_user'] = $user->id;

            Prestasi::create($data);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan data: ' . $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            // Cari data berdasarkan ID
            $item = Prestasi::findOrFail($id);

            // Hapus data
            $item->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }

    public function getSertifikatPrestasi($id)
    {
        $item = Prestasi::findOrFail($id);

        if ($item->sertifikat_prestasi && Storage::exists($item->sertifikat_prestasi)) {
            return Storage::download($item->sertifikat_prestasi);
        }

        abort(404, 'File tidak ditemukan.');
    }
}
