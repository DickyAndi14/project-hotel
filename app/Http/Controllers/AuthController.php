<?php

namespace App\Http\Controllers;

use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('pages.auth.login');
    }

    public function signin(SigninRequest $request){
        $credential = ['email' => request('email'),'password' => request('password')];
        if(Auth::attempt($credential)){
            return redirect()->route('landing');
        }
        return redirect()->back()->with('alert-errors', 'User tidak ditemukan.');
    }

    public function register(){
        return view('pages.auth.register');
    }

    public function signup(SignupRequest $request){
        User::create([
            'name'  => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password'))
        ]);

        $credential = ['email' => request('email'),'password' => request('password')];
        if(Auth::attempt($credential)){
            return redirect()->route('landing');
        }
    }

    public function logout(){
        Auth::logout();
        session()->flush();
        return redirect()->route('landing');
    }
}
