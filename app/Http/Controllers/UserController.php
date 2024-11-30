<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            'is_active' => 'boolean',
            'is_open' => 'boolean',
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
