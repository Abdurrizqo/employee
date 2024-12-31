<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use App\Models\Jabatan;
use App\Models\PendidikanTerakhir;
use App\Models\Pengesahan;
use App\Models\Prestasi;
use App\Models\Ranting;
use App\Models\RiwayatLatihan;
use App\Models\Sertifikasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function dashboardAdmin()
    {
        $ranting = Ranting::where('is_active', true)->orderBy('nama_ranting', 'asc')->get();

        return view("Admin.dashboardAdmin", [
            'ranting' => $ranting
        ]);
    }

    public function detailUser($id)
    {
        $admin = Auth::guard('guard_admin')->user();

        $biodata = Biodata::where('id_user', $id)->first();
        $ranting = Ranting::where('id', $admin->id_ranting)->first();
        $jabatan = Jabatan::where('id_user', $id)->get();
        $pengesahan = Pengesahan::where('id_user', $id)->get();
        $riwayatLatihan = RiwayatLatihan::where('id_user', $id)->get();
        $pendidikanTerakhir = PendidikanTerakhir::where('id_user', $id)->first();
        $sertifikasi = Sertifikasi::where('id_user', $id)->get();
        $prestasi = Prestasi::where('id_user', $id)->get();

        return view('Admin.detailUser', [
            'idUser' => $id,
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

    public function detailUserBySuperAdmin($id)
    {
        $user = User::where('id', $id)->first();

        $biodata = Biodata::where('id_user', $id)->first();
        $ranting = Ranting::where('id', $user->id_ranting)->first();
        $jabatan = Jabatan::where('id_user', $id)->get();
        $pengesahan = Pengesahan::where('id_user', $id)->get();
        $riwayatLatihan = RiwayatLatihan::where('id_user', $id)->get();
        $pendidikanTerakhir = PendidikanTerakhir::where('id_user', $id)->first();
        $sertifikasi = Sertifikasi::where('id_user', $id)->get();
        $prestasi = Prestasi::where('id_user', $id)->get();

        return view('SuperAdmin.detailUser', [
            'idUser' => $id,
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
