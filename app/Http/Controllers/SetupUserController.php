<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class SetupUserController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function editPass()
    {
        return view('admin.c_password.index');
    }
    public function changePass(Request $req)
    {
        $req->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);


        $hashedPass = Auth::user()->password;
        echo $hashedPass;

        if (Hash::check($req->current_password, $hashedPass)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($req->password);
            $user->save();
            Auth::logout();
            return redirect()->back()->with('success', 'Password changed');
        }
        return Redirect()->back()->with('error', 'Current password doesn\'t match ');
    }
    public function editProfile()
    {
        $user = User::find(Auth::user()->id);
        return view('admin.c_profile.index', compact('user'));
    }
    public function changeProfile(Request $req)
    {
        User::find(Auth::user()->id)->update([
            'name' => !$req->user_name ? $req->old_name : $req->user_name, !$req->user_email ? $req->old_email : $req->user_email
        ]);

        $notification = [
            'message' => 'Update user successfully 🚀🚀🚀',
            'alertType' => 'success'
        ];

        return Redirect()->back()->with($notification);
    }
}
