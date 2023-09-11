<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Auth;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    public function show()
    {
        if(Auth::check()){
            return view('auth.profile');
        }
        else{
            return view('auth.login');
        }
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
        $validated = $request->validated();
        $user = Auth::user();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if($request->filled('password')){
            $user->password =  Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
