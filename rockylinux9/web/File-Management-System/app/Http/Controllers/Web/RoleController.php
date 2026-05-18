<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.creates');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $validated = $request->validated();
        $role = Role::create($validated);
        if(!empty($request->permission)){
            foreach($request->permission as $name){
                $role->syncPermissions($name);
            }
        }    
        
        return redirect()->route('roles.index')->with('success','Tao Role Thanh Cong');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $hasPermissions = $role->permissions()->pluck('name');
        $permissions = Permission::latest()->get(); 

        return view('roles.edit',[
            'role' => $role,
            'hasPermissions' => $hasPermissions,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $validated = $request->validated();
        $role->update($validated);
        if(!empty($request->permission)){
            $role->syncPermissions($request->permission);
        }else{
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')->with('success','Cap Nhat Role Thanh Cong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if($role->delete()){
            return response()->json([
                'status' => true,
                'message'=> 'Xoa Role Thanh Cong'
            ]);
        }

        return response()->json([
            'status' => false,
            'message'=> 'Loi, Khong The Xoa Role'
        ]);
    }
}
