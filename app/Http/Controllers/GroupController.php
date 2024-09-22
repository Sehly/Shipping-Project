<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Group;

use App\Models\Permission;

use App\Http\Resources\GroupResource;

class GroupController extends Controller
{
    
    
    public function assignPermissions(Request $request, $groupId)
    {
        $group = Group::findOrFail($groupId);
        
        $permissions = Permission::whereIn('permissions_name', $request->input('permissions'))->get();

        $group->permissions()->sync($permissions);

        return response()->json(['message' => 'Permissions assigned successfully.']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $groups = Group::all(); 
        
        return response()->json([
            'data' => GroupResource::collection($groups),
            'message' => 'groups retrieved successfully',
        ], 200);
    }
    /**
     * Show the form for creating a new resource.
     */


    // public function create()
    // {
    //     return view('groups.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:groups',
            // 'permissions' => 'required|string', 
        ]);

        $group = Group::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => new GroupResource($group),
            'message' => 'Group created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    function show($id)
    {
       $group = Group::findOrFail($id);
       return response()->json(new GroupResource($group), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */

    // public function edit(Group $group)
    // {
    //     return view('groups.edit', compact('group'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:groups,name,' . $group->id,
            // 'permissions' => 'required|string',
        ]);

        $group->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => new GroupResource($group),
            'message' => 'Group updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return response()->json([
            'success' => true,
            'message' => 'Group deleted successfully',
        ], 200);
    }
}
