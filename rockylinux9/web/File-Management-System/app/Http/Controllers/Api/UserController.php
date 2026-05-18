<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreationRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  
    public function index()
    {
        $users = User::latest()->paginate(25);

        return response()->json([
            'status' => true,
            'message' => 'Danh Sach User',
            'data'  => UserResource::collection($users)
        ], 200);
    }

    public function store(UserCreationRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Tao User Thanh Cong',
            'data'   => new UserResource($user)
        ], 200);
    }

    public function show(string $id)
    {   
        $user = User::find($id);

        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'User Khong Ton Tai',
                'data' => null
            ], 404);    
        }

        return response()->json([
            'status' => true,
            'message' => 'Hien Thi User',
            'data' => new UserResource($user)
        ], 200);
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $user = User::find($id);

        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'User Khong Ton Tai',
                'data' => null
            ], 404);    
        }

        $validated = $request->validated();
        $user->syncRoles($request->roles ?? []);
        $userUpdate = $user->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Cap Nhat User Thanh Cong.',
            'data' => new UserResource($userUpdate)
        ], 200);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'User Khong Ton Tai',
                'data' => null
            ], 404);    
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xoa User Thanh Cong'
        ], 200); 
    }
}
