<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{

    public static function middleware(){
        return [
            new Middleware('permission: view permissions', only:['index']),
            
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::latest()->paginate(10);

        return view('permissions.list',[
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $validated = $request->validated();
        Permission::create($validated);

        return redirect()
                    ->route('permissions.index')
                    ->with('success', 'Tao Permission Thanh Cong.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit',[
            'permission' => $permission 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $validated = $request->validated();
        $permission->update($validated);

        return redirect()
                    ->route('permissions.index')
                    ->with('success','Cap Nhat Permission Thanh Cong.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        if($permission->delete()){
            return response()->json([
                'status' => true,
                'message' => 'Xoa Permission Thanh Cong'
            ]);
        }

        return response()->json([
                'status' => false,
                'message' => 'Loi, Khong The Xoa Permission'
        ]);
        
    }
}
