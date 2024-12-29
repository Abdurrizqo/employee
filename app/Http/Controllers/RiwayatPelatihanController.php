<?php

namespace App\Http\Controllers;

use App\Models\RiwayatLatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RiwayatPelatihanController extends Controller
{
    public function getRiwayatPelatihan()
    {
        $user = Auth::guard('guard_user')->user();

        $riwayatPelatihan = RiwayatLatihan::where('id_user', $user->id)->get();
        return view('User.DataRiwayatLatihan', ['riwayatPelatihan' => $riwayatPelatihan]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'tingkat' => 'required|in:Tingkat Polos,Tingkat Jambon,Tingkat Hijau,Tingkat Putih',
            'rayon' => 'required|string|max:255',
            'sertifikat' => 'nullable|file|mimes:pdf|max:3072', // Validasi file PDF maksimal 3MB
            'penyelenggara' => 'nullable|string|max:255',
        ],[
            'tingkat.in' =>'Data tingkat tidak valid',
            'rayon.max' =>'Data rayon maksimal 255 karakter',
            'sertifikat.file' =>'Sertifikat harus dalam bentuk file',
            'sertifikat.max' =>'Sertifikat maksimal 3mb',
            'penyelenggara.max' =>'Data penyelenggara maksimal 255 karakter',
        ]);

        try {
            $data = $validated;

            // Handle upload file sertifikat
            if ($request->hasFile('sertifikat')) {
                $file = $request->file('sertifikat');
                $path = $file->storeAs('private/sertifikat', time() . '_' . $file->getClientOriginalName()); // Simpan di storage/app/private/sertifikat
                $data['sertifikat'] = $path; // Simpan path file
            }

            $user = Auth::guard('guard_user')->user();
            $data['id_user'] = $user->id;

            RiwayatLatihan::create($data);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan data: ' . $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            // Cari data berdasarkan ID
            $item = RiwayatLatihan::findOrFail($id);

            // Hapus data
            $item->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }

    public function getSertifikat($id)
    {
        $item = RiwayatLatihan::findOrFail($id);

        if ($item->sertifikat && Storage::exists($item->sertifikat)) {
            return Storage::download($item->sertifikat);
        }

        abort(404, 'File tidak ditemukan.');
    }
}
