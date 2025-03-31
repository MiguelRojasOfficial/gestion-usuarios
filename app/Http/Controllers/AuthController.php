<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginForm() 
    {
        return view('auth.login');
    }

    public function login(Request $request) 
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) 
        {
            $request->session()->regenerate();
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.users.index');
            } elseif (Auth::user()->hasRole('editor')) {
                return redirect()->route('editor.articles.index');
            } else {
                return redirect('/dashboard');
            }
        }
    
        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ]);
    }
    

    public function registerForm() 
    {
        return view('auth.register');
    }

    public function register(Request $request) 
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        $role = \App\Models\Role::where('name', 'editor')->first();
        $user->roles()->attach($role);

        Auth::login($user); 
        return redirect()->route('editor.articles.index');
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
