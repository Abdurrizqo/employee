<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JabatanController extends Controller
{
    public function getJabatan()
    {
        $user = Auth::guard('guard_user')->user();

        $jabatan = Jabatan::where('id_user', $user->id)->get();
        return view('User.dataJabatan', ['jabatan' => $jabatan]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'lokasi_jabatan' => 'required|in:Pusat,Provinsi,Cabang,Ranting,Rayon',
            'jabatan' => 'required|string|max:255',
            'sk_jabatan' => 'nullable|file|mimes:pdf|max:3072', // Validasi file PDF maksimal 3MB
        ]);

        try {
            $data = $validated;

            // Handle upload file sertifikat
            if ($request->hasFile('sk_jabatan')) {
                $file = $request->file('sk_jabatan');
                $path = $file->storeAs('private/SKJabatan', time() . '_' . $file->getClientOriginalName()); // Simpan di storage/app/private/sertifikat
                $data['sk_jabatan'] = $path; // Simpan path file
            }

            $user = Auth::guard('guard_user')->user();
            $data['id_user'] = $user->id;

            Jabatan::create($data);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan data: ' . $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            // Cari data berdasarkan ID
            $item = Jabatan::findOrFail($id);

            // Hapus data
            $item->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }

    public function getSKJabatan($id)
    {
        $item = Jabatan::findOrFail($id);

        if ($item->sk_jabatan && Storage::exists($item->sk_jabatan)) {
            return Storage::download($item->sk_jabatan);
        }

        abort(404, 'File tidak ditemukan.');
    }
}
