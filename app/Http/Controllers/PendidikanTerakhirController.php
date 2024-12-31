<?php

namespace App\Http\Controllers;

use App\Models\PendidikanTerakhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PendidikanTerakhirController extends Controller
{
    public function formPendidikanTerakhir()
    {
        return view('User.FormPendidikanTerakhir');
    }

    public function handleFormPendidikanTerakhir(Request $request)
    {
        $validated = $request->validate([
            'pendidikan_terakhir' => 'required|in:-,SD / Sederajat,SMP / Sederajat,SMA / Sederajat,SMK,DI,D-II,D-III,D-IV / Sarjana,Pasca Sarjana - S2,Pasca Sarjana - S3',
            'jurusan' => 'nullable|string|max:255',
            'tahun_lulus' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'ijazah' => 'nullable|file|mimes:pdf|max:3072', // Validasi file PDF maksimal 3MB
        ], [
            "pendidikan_terakhir.in" => "Data pendidikan akhir tidak valid",
            "jurusan.max" => "Data jurusan maksimal 255 karakter",
            "tahun_lulus.max" => "tahun lulus maksimal tahun " . date('Y'),
            "ijazah.file" => "Dokumen ijazah harus dalam bentuk PDF",
            "ijazah.pdf" => "Dokumen ijazah harus dalam bentuk PDF",
            "ijazah.max" => "Dokumen ijazah maksimal 3mb",
        ]);

        $user = Auth::guard('guard_user')->user();

        $data = [
            'id_user' => $user->id,
            'pendidikan_terakhir' => $validated['pendidikan_terakhir'],
            'jurusan' => $validated['jurusan'],
            'tahun_lulus' => $validated['tahun_lulus'],
        ];

        $riwayatPendidikan = PendidikanTerakhir::where('id_user', $user->id)->first();

        if ($riwayatPendidikan) {
            if ($request->hasFile('ijazah')) {
                if ($riwayatPendidikan->ijazah && Storage::exists($riwayatPendidikan->ijazah)) {
                    Storage::delete($riwayatPendidikan->ijazah);
                }

                $file = $request->file('ijazah');
                $path = $file->storeAs('private/ijazah', time() . '_' . $file->getClientOriginalName()); // Simpan di storage/app/private/sertifikat
                $data['ijazah'] = $path; // Simpan path file
            }

            $riwayatPendidikan->update($data);
        } else {
            if ($request->hasFile('ijazah')) {
                $file = $request->file('ijazah');
                $path = $file->storeAs('private/ijazah', time() . '_' . $file->getClientOriginalName()); // Simpan di storage/app/private/sertifikat
                $data['ijazah'] = $path; // Simpan path file
            }

            PendidikanTerakhir::create($data);
        }

        return redirect('/dashboard')->with('success', 'Riwayat pendidikan berhasil diperbarui.');
    }

    public function getIjazah($id)
    {
        $item = PendidikanTerakhir::findOrFail($id);

        if ($item->ijazah && Storage::exists($item->ijazah)) {
            return Storage::download($item->ijazah);
        }

        abort(404, 'File tidak ditemukan.');
    }

    public function delete($id)
    {
        try {
            // Cari data berdasarkan ID
            $item = PendidikanTerakhir::findOrFail($id);

            // Hapus data
            $item->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }
}
