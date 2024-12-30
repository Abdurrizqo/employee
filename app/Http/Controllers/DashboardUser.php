<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Jabatan;
use App\Models\PendidikanTerakhir;
use App\Models\Pengesahan;
use App\Models\Prestasi;
use App\Models\Ranting;
use App\Models\RiwayatLatihan;
use App\Models\Sertifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardUser extends Controller
{
    public function dashboardUserView()
    {
        $user = Auth::guard('guard_user')->user();

        $biodata = Biodata::where('id_user', $user->id)->first();
        $ranting = Ranting::where('id', $user->id_ranting)->first();
        $jabatan = Jabatan::where('id_user', $user->id)->get();
        $pengesahan = Pengesahan::where('id_user', $user->id)->get();
        $riwayatLatihan = RiwayatLatihan::where('id_user', $user->id)->get();
        $pendidikanTerakhir = PendidikanTerakhir::where('id_user', $user->id)->first();
        $sertifikasi = Sertifikasi::where('id_user', $user->id)->get();
        $prestasi = Prestasi::where('id_user', $user->id)->get();

        return view('User.HomeUser', [
            'biodata' => $biodata,
            'ranting' => $ranting,
            'jabatans' => $jabatan,
            'pengesahan' => $pengesahan,
            'riwayatLatihan' => $riwayatLatihan,
            'pendidikanTerakhir' => $pendidikanTerakhir,
            'sertifikasi' => $sertifikasi,
            'prestasi' => $prestasi,
        ]);
    }
}