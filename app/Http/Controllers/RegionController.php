<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

use App\Http\Resources\RegionResource;

class RegionController extends Controller
{
    /**
     * Display a listing of the regions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();

        return response()->json([
            'data' => RegionResource::collection($regions),
            'message' => 'regions retrieved successfully',
        ], 200);

    }

    /**
     * Show the form for creating a new region.
     *
     * @return \Illuminate\Http\Response
     */


    // public function create()
    // {
    //     return view('regions.create');
    // }

    /**
     * Store a newly created region in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'governorate' => 'required|string|max:255',
        ]);

        $region = Region::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => new RegionResource($region),
            'message' => 'Region created successfully',
        ], 201);

    }

    /**
     * Display the specified region.
     *
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        return response()->json(new RegionResource($region), 200);
    }

    /**
     * Show the form for editing the specified region.
     *
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */


    // public function edit(Region $region)
    // {
    //     return view('regions.edit', compact('region'));
    // }

    /**
     * Update the specified region in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'governorate' => 'required|string|max:255',
        ]);

        $region->update($request->all());

        return response()->json([
            'success' => true,
            'data' => new RegionResource($region),
            'message' => 'Region updated successfully',
        ], 200);

    }

    /**
     * Remove the specified region from storage.
     *
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Region deleted successfully',
        ], 200);

    }
}
