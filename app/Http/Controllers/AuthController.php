<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // cek internal user
        $user = User::where('email', $request->email)->first();

        if($user){
            if(!Hash::check($request->password, $user->password)){
                return back()->with('error','Password salah');
            }

            Auth::login($user);

            return redirect('/internal/dashboard');
        }

        return back()->with('error','Akun tidak ditemukan');
    }
}