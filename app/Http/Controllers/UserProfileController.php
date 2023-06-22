<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    //
    public function profile()
    {
        // Returns the view for profile
        if (auth()->check()) {
            $current_user = auth()->user()->id;
            $isfound = UserProfile::find($current_user); //? IS the owner of the profile
            if (!$isfound) //? Is not the owner
            {
                return redirect(route('home')); //! Redirect to homepage if not the owner of the profile
            } else {
                $user = UserProfile::find($current_user)->user; //? Accessing User model information through relations
                $userprof = User::find($current_user)->userprofile; //? Accessing Accessing UserProfile model information through relations
                // return "User Details " . $userprof;
                return view('profile', compact('userprof','user'));
            }
        }
        return redirect(route('logout'));
    }

    public function update_profile(Request $request, $id)
    {
    }

    public function setup_profile(Request $request)
    {
    }
}
