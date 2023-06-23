<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    // !My Version
    // public function profileV1()
    // {
    //     // Returns the view for profile
    //     if (auth()->check()) {
    //         $current_user = auth()->user()->id;
    //         $isfound = UserProfile::findOrFail($current_user); //? IS the owner of the profile
    //         if (!$isfound) //? Is not the owner
    //         {
    //             $user = User::findOrFail($current_user);
    //             return view('profile.setup', compact('user')); //! Redirect to homepage if not the owner of the profile
    //         } else {
    //             $user = UserProfile::findOrFail($current_user)->user; //? Accessing User model information through relations
    //             $userprof = User::findOrFail($current_user)->userprofile; //? Accessing Accessing UserProfile model information through relations
    //             // return "User Details " . $userprof;
    //             return view('profile.profile', compact('userprof', 'user'));
    //         }
    //     }
    //     return redirect(route('logout'));
    // }
    //* AI Version
    public function profile()
    {
        if (auth()->check()) {
            $current_user = auth()->user()->id;
            $isfound = UserProfile::findOrFail($current_user);

            if (!$isfound) {
                // The user does not have a profile, redirect to setup profile
                $userProfile = [];
                return view('profile.setup', compact('userProfile'));
            } else {
                // The user has a profile, retrieve user and user profile information
                $user = User::findOrFail($current_user);
                $userProfile = $user->userProfile; // Accessing UserProfile model information through relations

                return view('profile.profile', compact('userProfile', 'user'));
            }
        } else {
            // User is not authenticated, redirect to logout
            return redirect(route('logout'));
        }
    }

    public function checkProfile($id)
    {
        $user = User::findOrFail($id);
        $userProfile = $user->userProfile; // Accessing UserProfile model information through relations
        return view('profile.check', compact('userProfile', 'user'));
    }

    public function setup()
    {
        $current_user = auth()->user()->id;
        $user = User::findOrFail($current_user);
        $userProfile = $user->userProfile;
        return view('profile.setup', compact('userProfile'));
    }

    public function update(Request $request)
    {
        // Setup Profile of the logged-in user
        $request->validate([
            'age',
            'gender',
            'address',
            'contact',
        ]);

        $data = [
            'age' => strip_tags($request->age),
            'gender' => strip_tags($request->gender),
            'address' => strip_tags($request->address),
            'contact' => strip_tags($request->contact),
            'user_id' => auth()->user()->id,
        ];

        UserProfile::updateOrCreate(['user_id' => auth()->user()->id], $data);

        // Update the User model
        auth()->user()->update(['name' => strip_tags($request->name)]);

        return redirect(route('profile'));
    }
}
