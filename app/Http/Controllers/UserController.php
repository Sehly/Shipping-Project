<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Group;

use App\Models\User;

use App\Http\Resources\UserResource;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('group', 'orders')->get();

        $users = User::all(); 
        return response()->json([
            'data' => UserResource::collection($users),
            'message' => 'users retrieved successfully',
        ], 200);
        // return view('users.index', compact('users'));
    }


    // public function create()
    // {
    //     $groups = Group::all();
    //     return view('users.create', compact('groups'));
    // }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,employee,trader,deliveryman',
            'group_id' => 'required|exists:groups,id',
            'company_name' => 'nullable|string|max:255'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => new UserResource($user),
            'message' => 'User created successfully',
        ], 201);
    }

    public function show(User $user)
    {
       return response()->json(new UserResource($user), 200);
    }

    // public function edit(User $user)
    // {
    //     $groups = Group::all();
    //     return view('users.edit', compact('user', 'groups'));
    // }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,employee,trader,deliveryman',
            'group_id' => 'required|exists:groups,id',
            'company_name' => 'nullable|string|max:255'
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($validatedData);
        return response()->json([
            'success' => true,
            'data' => new UserResource($user),
            'message' => 'User updated successfully',
        ], 200);
    }


    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ], 200);
    }
}
