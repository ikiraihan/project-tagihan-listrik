<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('auth.login');
    }

    public function viewSignup()
    {
        return view('signup');
    }

    public function login(Request $request)
    {

        $login = $request->input('email');
        $user = User::where('email', $login)->orWhere('username', $login)->first();
    
        if (!$user) {
            return back()->with('loginError', 'Login Gagal!');
        }
    
        $request->validate([
            'password' => 'required|min:8',
        ]);
    
        if (Auth::attempt(['email' => $user->email, 'password' => $request->password]) ||
            Auth::attempt(['username' => $user->username, 'password' => $request->password])) {
            Auth::loginUsingId($user->id);
            return redirect('/pelanggan');
        } else {
                return back()->with('loginError', 'Login Gagal!');
        }
    }
    
    public function signUp(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'required|min:3|max:50',
            'email'         => 'required|email:dns|unique:users',
            'password'      => 'required||min:8|max:32'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
    
        User::create($validatedData);

        Session::flash('success', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');

        return redirect('/signup');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
