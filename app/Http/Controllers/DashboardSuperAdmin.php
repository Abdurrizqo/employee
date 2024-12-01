<?php

namespace App\Http\Controllers;

use App\Models\Ranting;
use Illuminate\Http\Request;

class DashboardSuperAdmin extends Controller
{
    public function dashboardSuperAdmin()
    {
        $ranting = Ranting::where('is_active', true)->orderBy('nama_ranting', 'asc')->get();

        return view("SuperAdmin.dashboardSuperAdmin", [
            'ranting' => $ranting
        ]);
    }

    public function listRantingPage()
    {
        return view('SuperAdmin.listRantingPage');
    }

    public function listAdminPage()
    {
        $ranting = Ranting::where('is_active', true)->orderBy('nama_ranting', 'asc')->get();
        return view('SuperAdmin.listAdminPage', [
            'ranting' => $ranting
        ]);
    }
}
