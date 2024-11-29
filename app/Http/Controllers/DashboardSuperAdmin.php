<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardSuperAdmin extends Controller
{
    public function dashboardSuperAdmin(){
        return view("SuperAdmin.dashboardSuperAdmin");
    }
}
