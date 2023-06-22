<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    //
    public function login()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('login');
    }

    public function registration()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('registration');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect(route('home'))->with('success', 'Login Success!');
        }

        return redirect(route('login'))->with('error', 'Invalid Email/Password!');
    }


    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $data['name'] = strip_tags($request->name);
        $data['email'] = strip_tags($request->email);
        $data['password'] = Hash::make($request->password);
        $user  = User::create($data);

        if (!$user) {
            return redirect(route('registration'))->with('error', 'Registration Failed! Try again.');
        }

        return redirect(route('login'))->with('succes', 'Registration Success!');
    }


    public function logout()
    {
        // Session::flush();
        session()->flush();
        auth()->logout();
        return redirect(route('login'));
    }
}
