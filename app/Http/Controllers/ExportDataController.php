<?php

namespace App\Http\Controllers;

use App\Exports\MultipleExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataController extends Controller
{
    public function exportBySuperAdmin(Request $request)
    {
        $ranting = $request->query('ranting', null);
    
        return Excel::download(new MultipleExport($ranting), 'export_result.xlsx');
    }

    public function exportByAdmin()
    {
        $user = Auth::guard('guard_admin')->user();
    
        return Excel::download(new MultipleExport($user->id_ranting), 'export_result.xlsx');
    }
}
