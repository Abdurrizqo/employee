<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardSuperAdmin extends Controller
{
    public function dashboardSuperAdmin(){
        return view("SuperAdmin.dashboardSuperAdmin");
    }

    public function listRantingPage(){
        return view('SuperAdmin.listRantingPage');
    }

    public function listAdminPage(){
        return view('SuperAdmin.listAdminPage');
    }

    public function listAnggotaPage(){
        return view('SuperAdmin.listAnggotaPage');
    }
}
