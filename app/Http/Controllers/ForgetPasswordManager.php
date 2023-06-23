<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordManager extends Controller
{
    //
    public function forgetPassword()
    {
        return view('auth.forget-password');
    }

    public function forgetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email']
        ]);

        $token = Str::random(64);
        DB::table('password_resets_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.forget-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password");
        });

        return redirect(route('auth.forgot'))->with('success', 'We have send a an email to reset password.');
    }


    public function resetPassword()
    {
    }
}
