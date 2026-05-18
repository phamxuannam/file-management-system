<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Hien Thi Danh Sach Role',
            'data'   => RoleResource::collection($roles) 
        ], 200);
    }

    public function store(RoleRequest $request)
    {
        $validated = $request->validated(); 
        $role = Role::create($validated);
        $role->syncPermissions($request->permission);

        return response()->json([
            'status' => true,
            'message' => 'Tao Role Thanh Cong',
            'data'  => new RoleResource($role)
        ], 201);
    }

    public function show(string $id)
    {
        $role = Role::find($id);

        if(!$role){
            return response()->json([
                'status' => false,
                'message' => 'Role Khong Ton Tai',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Hien Thi Role',
            'data' => new RoleResource($role)
        ], 200);
    }

    public function update(RoleRequest $request, string $id)
    {
        $role = Role::find($id);

        if(!$role){
            return response()->json([
                'status' => false,
                'message' => 'Role Khong Ton Tai',
                'data' => null
            ], 404);
        }

        $validated = $request->validated();
        $role->syncPermissions($request->permission ?? []);
        $roleUpdate = $role->update($validated);
       
        return response()->json([
            'status' => true,
            'message' => 'Cap Nhat Role Thanh Cong',
            'data'  => new RoleResource($roleUpdate)
        ], 200);
    }

    public function destroy(string $id)
    {
        $role = Role::find($id);

        if(!$role){
            return response()->json([
                'status' => false,
                'message' => 'Role Khong Ton Tai',
                'data' => null
            ], 404);
        }

        $role->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xoa Role Thanh Cong'
        ], 200);
    }
}
