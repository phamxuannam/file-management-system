<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
   
    public function index()
    {
        $permissions = Permission::latest()->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Danh Sach Permissions.',
            'data'  =>  PermissionResource::collection($permissions)
        ], 200);
    }

    public function store(PermissionRequest $request)
    {
        $validated = $request->validated();
        $permission = Permission::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Tao Permission Thanh Cong.',
            'data'  => new PermissionResource($permission)
        ], 201);
    }

    public function show(string $id)
    {
        $permission = Permission::find($id);

        if(!$permission){
             return response()->json([
            'status' => false,
            'message' => 'Permission Khong Ton Tai.',
            'data'  => null
        ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Hien Thi Permission.',
            'data'  => new PermissionResource($permission)
        ], 200);
    }

    public function update(PermissionRequest $request, string $id)
    {
        $permission = Permission::find($id);

        if(!$permission){
            return response()->json([
                'status' => false,
                'message' => 'Permission Khong Ton Tai.',
                'data' => null
            ], 404);
        }

        $validated = $request->validated();
        $permissionUpdate = $permission->update($validated);

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => new PermissionResource($permissionUpdate)
        ], 200);
    }


    public function destroy(string $id)
    {  
        $permission = Permission::find($id);

        if(!$permission){
            return response()->json([
                'status' => false,
                'message' => 'Permission Khong Ton Tai.',
                'data' => null
            ], 404);
        }

        $permission->delete();

        return response()->json([
            'status' => true,
            'messgae' => 'Xoa Permission Thanh Cong.'
        ], 200);
    }
}
