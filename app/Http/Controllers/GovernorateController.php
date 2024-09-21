<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Governorate;
use App\Http\Resources\GovernorateResource;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the governorates.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $governorates = Governorate::with('cities')->get();
        return response()->json([
            'data' => GovernorateResource::collection($governorates),
            'message' => 'Governorates retrieved successfully',
        ], 200);
    }

    /**
     * Store a newly created governorate in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'sometimes|boolean',
        ]);

        $governorate = Governorate::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => new GovernorateResource($governorate),
            'message' => 'Governorate created successfully',
        ], 201);
    }

    /**
     * Display the specified governorate.
     *
     * @param \App\Models\Governorate $governorate
     * @return \Illuminate\Http\Response
     */
    public function show(Governorate $governorate)
    {
        return response()->json(new GovernorateResource($governorate), 200);
    }

    /**
     * Update the specified governorate in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Governorate $governorate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Governorate $governorate)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|boolean',
        ]);

        $governorate->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => new GovernorateResource($governorate),
            'message' => 'Governorate updated successfully',
        ], 200);
    }

    /**
     * Remove the specified governorate from storage.
     *
     * @param \App\Models\Governorate $governorate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Governorate $governorate)
    {
        $governorate->delete();

        return response()->json([
            'success' => true,
            'message' => 'Governorate deleted successfully',
        ], 200);
    }
}

