<?php

namespace App\Http\Controllers;

use App\Models\Ranting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RantingController extends Controller
{
    public function getAllRanting(Request $request)
    {
        $search = $request->input('search');

        $query = Ranting::query();

        if ($search) {
            $query->where('nama_ranting', 'like', '%' . $search . '%');
        }

        $rantings = $query->get();

        return response()->json([
            'success' => true,
            'data' => $rantings,
        ]);
    }

    public function getAllRatingActive()
    {
        $rantings = Ranting::where('is_active', true)->get();
        return response()->json([
            'success' => true,
            'data' => $rantings,
        ]);
    }

    // Create a new ranting
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ranting' => 'required|string|max:240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $ranting = Ranting::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $ranting,
            'message' => 'Ranting created successfully.',
        ], 201);
    }

    // Update a specific ranting
    public function update(Request $request, $id)
    {
        $ranting = Ranting::find($id);

        if (!$ranting) {
            return response()->json([
                'success' => false,
                'message' => 'Ranting not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_ranting' => 'sometimes|string|max:240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $ranting->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $ranting,
            'message' => 'Ranting updated successfully.',
        ]);
    }

    // Delete a specific ranting
    public function switchStatus($id)
    {
        $ranting = Ranting::find($id);

        if (!$ranting) {
            return response()->json([
                'success' => false,
                'message' => 'Ranting not found.',
            ], 404);
        }

        // Toggle the is_active status
        $ranting->is_active = !$ranting->is_active;
        $ranting->save();

        return response()->json([
            'success' => true,
            'message' => 'Ranting status switched successfully.',
            'data' => $ranting,
        ]);
    }
}
