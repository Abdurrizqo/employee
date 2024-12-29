<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:120|unique:users',
            'password' => 'required|string|min:6',
            'nama_user' => 'required|string|max:240',
            'id_ranting' => 'required|uuid|exists:rantings,id',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User created successfully.',
        ], 201);
    }

    public function storeByAdmin(Request $request)
    {
        $admin = Auth::guard('guard_admin')->user();

        $validated = $request->validate([
            'username' => 'required|string|max:120|unique:users',
            'password' => 'required|string|min:6',
            'nama_user' => 'required|string|max:240',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['id_ranting'] = $admin->id_ranting;

        $user = User::create($validated);

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User created successfully.',
        ], 201);
    }

    // Read (with search and pagination)
    public function getAllUsers(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default 10 items per page

        $query = User::query();

        // Join with rantings for searching nama_ranting
        $query->join('rantings', 'users.id_ranting', '=', 'rantings.id')
            ->select('users.*', 'rantings.nama_ranting');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('users.nama_user', 'like', '%' . $search . '%')
                    ->orWhere('users.username', 'like', '%' . $search . '%')
                    ->orWhere('rantings.nama_ranting', 'like', '%' . $search . '%');
            });
        }

        $users = $query->with('ranting')->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }

    public function getAllUsersByRanting(Request $request)
    {
        $admin = Auth::guard('guard_admin')->user();

        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default 10 items per page

        $query = User::query();

        // Join with rantings for searching nama_ranting
        $query->join('rantings', 'users.id_ranting', '=', 'rantings.id')
            ->select('users.*', 'rantings.nama_ranting');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('users.nama_user', 'like', '%' . $search . '%')
                    ->orWhere('users.username', 'like', '%' . $search . '%')
                    ->orWhere('rantings.nama_ranting', 'like', '%' . $search . '%');
            });
        }

        $users = $query
            ->where('users.id_ranting', '=', $admin->id_ranting)
            ->with('ranting')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }

    // Update
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        $validated = $request->validate([
            'username' => 'string|max:120|unique:users,username,' . $id,
            'password' => 'nullable|string|min:6',
            'nama_user' => 'string|max:240',
            'id_ranting' => 'uuid|exists:rantings,id',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User updated successfully.',
        ]);
    }

    public function updateByAdmin(Request $request, $id)
    {
        $admin = Auth::guard('guard_admin')->user();

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        $validated = $request->validate([
            'username' => 'string|max:120|unique:users,username,' . $id,
            'password' => 'nullable|string|min:6',
            'nama_user' => 'string|max:240',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $validated['id_ranting'] = $admin->id_ranting;

        $user->update($validated);

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User updated successfully.',
        ]);
    }

    public function updateByUser(Request $request){
        $user = Auth::guard('guard_user')->user();

        $dataUser = User::find($user->id);

        try {
            // Validasi input
            $validated = $request->validate([
                'username' => 'required|string|max:120|unique:users,username,' . $user->id,
                'password' => 'nullable|string|min:6', // Password bersifat optional
                'nama_user' => 'required|string|max:240',
            ], [
                'username.required' => 'Username wajib diisi.',
                'username.string' => 'Username harus berupa teks.',
                'username.max' => 'Username tidak boleh lebih dari 120 karakter.',
                'username.unique' => 'Username sudah digunakan. Silakan pilih username lain.',
            
                'password.string' => 'Password harus berupa teks.',
                'password.min' => 'Password harus memiliki minimal 6 karakter.',
            
                'nama_user.required' => 'Nama lengkap wajib diisi.',
                'nama_user.string' => 'Nama lengkap harus berupa teks.',
                'nama_user.max' => 'Nama lengkap tidak boleh lebih dari 240 karakter.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangkap error validasi dan kembali ke halaman sebelumnya dengan pesan error
            return back()->withErrors($e->errors())->withInput();
        }

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $dataUser->update($validated);

        return redirect('/kelengkapan-biodata');
    }

    // Switch Status
    public function switchStatus($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User status switched successfully.',
        ]);
    }
}
