<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\UserCreationRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Area;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use AuthorizesRequests;

    // public function __construct()
    // {
    //     $this->authorizeResource(User::class, 'user');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $areas = Area::latest()->get();
        $roles = Role::latest()->get();
        $users = User::byArea(Auth::user())->with('roles')->latest()->paginate(25);
       
        return view('users.list', [
            'users' => $users,
            'areas' => $areas,
            'roles' => $roles
        ]);
    }

    public function fetchUser(){
        $users = User::byArea(Auth::user())->with('roles')->latest()->paginate(25);

        return view('users.load-data',[
            'users' => $users
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $this->authorize('create', User::class);

        $roles = Role::latest()->get();
        $areas = Area::latest()->get();

        return view('users.create', [
            'roles' => $roles,
            'areas' => $areas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreationRequest $request) {
        $this->authorize('create', User::class);
        
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $user->syncRoles($request->role);

        return response()->json([
            'status' => true,
            'message' => 'Tao User Thanh Cong'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $roles = Role::latest()->get();
        $hasRoles = $user->roles->pluck('id');
        $areas = Area::lastest()->get();

        return view('users.edit', [
            'user'  => $user,
            'roles' => $roles,
            'hasRoles' => $hasRoles,
            'areas' => $areas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();
        $user->update($validated);
        $user->syncRoles($request->role);

        return response()->json([
            'status' => true,
            'message' => 'Cap Nhat User Thanh Cong',
        ]);
    }

    public function editProfile(EditProfileRequest $request){
        $validated = $request->validated();
        Auth::user()->update([
            'fullname' => $request->fullname,
            'password' => Hash::make($validated['new_password'])
        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'Thay Doi Thanh Cong.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        if ($user->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Xoa User Thanh Cong'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Loi, Khong The Xoa User'
        ]);
    }
}
