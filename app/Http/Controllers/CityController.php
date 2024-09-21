<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Governorate;
use App\Http\Resources\CityResource;

class CityController extends Controller
{
    /**
     * Display a listing of the cities.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::with('governorate')->get();
        return response()->json([
            'data' => CityResource::collection($cities),
            'message' => 'Cities retrieved successfully',
        ], 200);
    }

    /**
     * Store a newly created city in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'city_name' => 'required|string|max:255',
            'original_cost' => 'required|numeric',
            'pickup_cost' => 'required|numeric',
            'governorate_id' => 'required|exists:governorates,id',
        ]);

        $city = City::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => new CityResource($city),
            'message' => 'City created successfully',
        ], 201);
    }

    /**
     * Display the specified city.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return response()->json(new CityResource($city), 200);
    }

    /**
     * Update the specified city in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $validatedData = $request->validate([
            'city_name' => 'sometimes|required|string|max:255',
            'original_cost' => 'sometimes|required|numeric',
            'pickup_cost' => 'sometimes|required|numeric',
            'governorate_id' => 'sometimes|required|exists:governorates,id',
        ]);

        $city->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => new CityResource($city),
            'message' => 'City updated successfully',
        ], 200);
    }

    /**
     * Remove the specified city from storage.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        return response()->json([
            'success' => true,
            'message' => 'City deleted successfully',
        ], 200);
    }
}
