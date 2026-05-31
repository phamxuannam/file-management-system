<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\UserCreationRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{

    use AuthorizesRequests;
    
    public function store(UserCreationRequest $request) {
        $this->authorize('create', User::class);
        
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $user->syncRoles($request->role);

        return response()->json([
            'status' => true,
            'message' => 'Tao User Thanh Cong',
            'data'   => new UserResource($user)
        ], 201);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();
        $user->update($validated);
        $user->syncRoles($request->role);

        return response()->json([
            'status' => true,
            'message' => 'Cap Nhat User Thanh Cong',
            'data'   => new UserResource($user)
        ], 200);
    }

     public function editProfile(EditProfileRequest $request){
        $user = Auth::user();
        $validated = $request->validated();
        $user->update([
            'fullname' => $request->fullname,
            'password' => Hash::make($validated['new_password'])
        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'Thay Doi Thanh Cong.',
            'data'  => new UseResource($user)
        ], 200);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        if ($user->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Xoa User Thanh Cong'
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Loi, Khong The Xoa User'
        ], 403);
    }

}
// {
  
//     public function index()
//     {
//         $users = User::latest()->paginate(25);

//         return response()->json([
//             'status' => true,
//             'message' => 'Danh Sach User',
//             'data'  => UserResource::collection($users)
//         ], 200);
//     }

//     public function store(UserCreationRequest $request)
//     {
//         $validated = $request->validated();
//         $user = User::create($validated);

//         return response()->json([
//             'status' => true,
//             'message' => 'Tao User Thanh Cong',
//             'data'   => new UserResource($user)
//         ], 200);
//     }

//     public function show(string $id)
//     {   
//         $user = User::find($id);

//         if(!$user){
//             return response()->json([
//                 'status' => false,
//                 'message' => 'User Khong Ton Tai',
//                 'data' => null
//             ], 404);    
//         }

//         return response()->json([
//             'status' => true,
//             'message' => 'Hien Thi User',
//             'data' => new UserResource($user)
//         ], 200);
//     }

//     public function update(UserUpdateRequest $request, string $id)
//     {
//         $user = User::find($id);

//         if(!$user){
//             return response()->json([
//                 'status' => false,
//                 'message' => 'User Khong Ton Tai',
//                 'data' => null
//             ], 404);    
//         }

//         $validated = $request->validated();
//         $user->syncRoles($request->roles ?? []);
//         $userUpdate = $user->update($validated);

//         return response()->json([
//             'status' => true,
//             'message' => 'Cap Nhat User Thanh Cong.',
//             'data' => new UserResource($userUpdate)
//         ], 200);
//     }

//     public function destroy(string $id)
//     {
//         $user = User::find($id);

//         if(!$user){
//             return response()->json([
//                 'status' => false,
//                 'message' => 'User Khong Ton Tai',
//                 'data' => null
//             ], 404);    
//         }

//         $user->delete();

//         return response()->json([
//             'status' => true,
//             'message' => 'Xoa User Thanh Cong'
//         ], 200); 
//     }
// }
