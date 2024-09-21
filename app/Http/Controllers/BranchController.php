<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Branch;

use App\Http\Resources\BranchResource;


class BranchController extends Controller
{
    /**
     * Display a listing of the branches.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();
        return response()->json([
            'data' => BranchResource::collection($branches),
            'message' => 'branches retrieved successfully',
        ], 200);
    }

    /**
     * Show the form for creating a new branch.
     *
     * @return \Illuminate\Http\Response
     */

    // public function create()
    // {
    //     return view('branches.create');
    // }

    /**
     * Store a newly created branch in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedDate = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Branch::create($validatedDate);

        return response()->json([
            'success' => true,
            'data' => new BranchResource($branch),
            'message' => 'Branch created successfully',
        ], 201);
    }

    /**
     * Display the specified branch.
     *
     * @param \App\Models\Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        return response()->json(new BranchResource($branch), 200);
    }

    /**
     * Show the form for editing the specified branch.
     *
     * @param \App\Models\Branch $branch
     * @return \Illuminate\Http\Response
     */


    // public function edit(Branch $branch)
    // {
    //     return view('branches.edit', compact('branch'));
    // }

    /**
     * Update the specified branch in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $validatedDated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',

        ]);

        $branch->update($validatedDated);

        return response()->json([
            'success' => true,
            'data' => new BranchResource($branch),
            'message' => 'Branch updated successfully',
        ], 200);
    }

    /**
     * Remove the specified branch from storage.
     *
     * @param \App\Models\Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();


        return response()->json([
            'success' => true,
            'message' => 'Branch deleted successfully',
        ], 200);

    }
}
