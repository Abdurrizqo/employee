<?php

namespace App\Http\Controllers;

use App\Models\Ranting;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboardAdmin()
    {
        $ranting = Ranting::where('is_active', true)->orderBy('nama_ranting', 'asc')->get();

        return view("Admin.dashboardAdmin", [
            'ranting' => $ranting
        ]);
    }
}
