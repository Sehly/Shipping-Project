<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupPermission;
use App\Models\Group;
use App\Models\Permission;
use App\Http\Resources\GroupPermissionResource;

class GroupPermissionController extends Controller
{
    public function index()
    {
        $groupPermissions = GroupPermission::with(['group', 'permission'])->get();

        return response()->json([
            'success' => true,
            'data' => GroupPermissionResource::collection($groupPermissions),
            'message' => 'Group permissions retrieved successfully',
        ], 200);
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);
        if (GroupPermission::where($validatedData)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Group permission already exists',
            ], 409);
        }

        $groupPermission = GroupPermission::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => new GroupPermissionResource($groupPermission),
            'message' => 'Group permission created successfully',
        ], 201);
    }

    public function show($group_id, $permission_id)
    {
        $groupPermission = GroupPermission::with(['group', 'permission'])
            ->where('group_id', $group_id)
            ->where('permission_id', $permission_id)
            ->first();

        if (!$groupPermission) {
            return response()->json([
                'success' => false,
                'message' => 'Group permission not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new GroupPermissionResource($groupPermission),
            'message' => 'Group permission retrieved successfully',
        ], 200);
    }

    public function update(Request $request, $group_id, $permission_id)
    {
        $groupPermission = GroupPermission::where('group_id', $group_id)
            ->where('permission_id', $permission_id)
            ->first();

        if (!$groupPermission) {
            return response()->json([
                'success' => false,
                'message' => 'Group permission not found',
            ], 404);
        }

        $validatedData = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);
        if (GroupPermission::where('group_id', $validatedData['group_id'])
            ->where('permission_id', $validatedData['permission_id'])
            ->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Group permission already exists with new values',
            ], 409);
        }

        $groupPermission->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => new GroupPermissionResource($groupPermission),
            'message' => 'Group permission updated successfully',
        ], 200);
    }

    public function destroy($group_id, $permission_id)
    {
        $groupPermission = GroupPermission::where('group_id', $group_id)
            ->where('permission_id', $permission_id)
            ->first();
    
        if (!$groupPermission) {
            return response()->json([
                'success' => false,
                'message' => 'Group permission not found',
            ], 404);
        }
    
        $deleted = GroupPermission::where('group_id', $group_id)
            ->where('permission_id', $permission_id)
            ->delete();
    
        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Group permission deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting group permission',
            ], 500);
        }
    }    
}
