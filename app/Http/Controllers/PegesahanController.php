<?php

namespace App\Http\Controllers;

use App\Models\Pengesahan;
use App\Models\Sertifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PegesahanController extends Controller
{
    public function dataPengesahan()
    {
        $user = Auth::guard('guard_user')->user();

        $pengesahan = Pengesahan::where('id_user', $user->id)->get();
        return view('User.DataPengesahan', [
            'pengesahan' => $pengesahan
        ]);
    }

    public function dataPengesahanByAdmin($id)
    {

        $pengesahan = Pengesahan::where('id_user', $id)->get();
        return view('Admin.DataPengesahan', [
            'pengesahan' => $pengesahan,
            'idUser' => $id
        ]);
    }

    public function dataPengesahanBySuperAdmin($id)
    {

        $pengesahan = Pengesahan::where('id_user', $id)->get();
        return view('SuperAdmin.DataPengesahan', [
            'pengesahan' => $pengesahan,
            'idUser' => $id
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'tingkat' => 'required|in:Tingkat I,Tingkat II,Tingkat III',
            'cabang' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'), // Validasi file PDF maksimal 3MB
            'sertifikat_pengesahan' => 'required|file|mimes:pdf|max:3072', // Validasi file PDF maksimal 3MB
        ], [
            'tingkat.in' => 'Tingkat tidak valid',
            'cabang.max' => 'Cabang maksimal 255 karakter',
            'tahun.max' => 'Tahun maksimal ' . date('Y'),
            'sertifikat_pengesahan.file' => 'Sertifikat pengesahan harus pdf',
            'sertifikat_pengesahan.pdf' => 'Sertifikat pengesahan harus pdf',
            'sertifikat_pengesahan.max' => 'Sertifikat pengesahan maksimal 3mb'
        ]);

        try {
            $data = $validated;

            $user = Auth::guard('guard_user')->user();

            if ($request->hasFile('sertifikat_pengesahan')) {
                $file = $request->file('sertifikat_pengesahan');
                $path = $file->storeAs('private/sertifikat_pengesahan', time() . '_' . $file->getClientOriginalName()); // Simpan di storage/app/private/sertifikat
                $data['sertifikat_pengesahan'] = $path; // Simpan path file
            }

            $data['id_user'] = $user->id;

            Pengesahan::create($data);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan data: ' . $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            // Cari data berdasarkan ID
            $item = Pengesahan::findOrFail($id);

            // Hapus data
            $item->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }

    public function getSertifikatPengesahan($id)
    {
        $item = Pengesahan::findOrFail($id);

        if ($item->sertifikat_pengesahan && Storage::exists($item->sertifikat_pengesahan)) {
            return Storage::download($item->sertifikat_pengesahan);
        }

        abort(404, 'File tidak ditemukan.');
    }
}
