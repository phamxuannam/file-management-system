<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreationRequest;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister(){
        return view('auth.register');
    }

    public function register(UserCreationRequest $request){
        $validated = $request->validated();
        $user = User::create($validated);
        $user->roles()->attach(1);

        return redirect()->route('login')->with('success', 'Dang Ky Thanh Cong');
    }

    public function showLogin()
    {
        $areas = Area::latest()->get();
        
        return view('auth.login',[
            'areas' => $areas
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('files.index'));
        }

        return back()->withErrors([
            'email' => 'Email Or Password is incorrect.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
