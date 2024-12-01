<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Get all admins with optional search
    public function getAllAdmins(Request $request)
    {
        $search = $request->input('search');

        $query = Admin::query();

        // Join dengan tabel rantings untuk pencarian nama_ranting
        $query->join('rantings', 'admins.id_ranting', '=', 'rantings.id')
            ->select('admins.*', 'rantings.nama_ranting'); // Memilih kolom yang diperlukan

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('admins.nama_admin', 'like', '%' . $search . '%')
                    ->orWhere('admins.username', 'like', '%' . $search . '%')
                    ->orWhere('rantings.nama_ranting', 'like', '%' . $search . '%'); // Tambahkan pencarian nama_ranting
            });
        }

        // Paginate hasil
        $admins = $query->with('ranting')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $admins,
        ]);
    }

    // Create a new admin
    public function createAdmin(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:120|unique:admins,username',
            'password' => 'required|string|min:6',
            'nama_admin' => 'required|string|max:240',
            'id_ranting' => 'required|uuid|exists:rantings,id',
        ]);

        $validated['password'] = bcrypt($validated['password']); // Encrypt the password

        $admin = Admin::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Admin created successfully.',
            'data' => $admin,
        ], 201);
    }

    // Update an admin
    public function updateAdmin(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not found.',
            ], 404);
        }

        $validated = $request->validate([
            'username' => 'string|max:120|unique:admins,username,' . $id,
            'password' => 'string|min:6|max:20',
            'nama_admin' => 'string|max:240',
            'id_ranting' => 'uuid|exists:rantings,id',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']); // Encrypt the password
        }

        $admin->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Admin updated successfully.',
            'data' => $admin,
        ]);
    }

    // Switch admin status
    public function switchStatus($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not found.',
            ], 404);
        }

        $admin->is_active = !$admin->is_active;
        $admin->save();

        return response()->json([
            'success' => true,
            'message' => 'Admin status switched successfully.',
            'data' => $admin,
        ]);
    }
}
