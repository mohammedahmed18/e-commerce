<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function showProfile()
    {
        $productsAddedByAdmin = Auth::guard('admin')->user()->products->sortByDesc('id');
        $admin = Auth::guard('admin')->user();
        return view('pages.dashboard.profile', ['products' => $productsAddedByAdmin, 'admin' => $admin]);
    }
    public function changePassword(Request $req)
    {
        $validated = $req->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:3',
            'confirm_new_password' => 'required'
        ]);
        $admin = Auth::guard('admin')->user();
        $dbAdmin = Admin::find($admin->id);

        //    check if password is right
        if (!Hash::check($validated['old_password'], $dbAdmin->password)) {
            return back()->with('error', 'password is wrong');
        }

        if ($validated['new_password'] != $validated['confirm_new_password']) {
            return back()->with('error', 'password doesn\'t match');
        }
        // change password
        $dbAdmin->password = Hash::make($validated['new_password']);
        $dbAdmin->save();
        // log out
        Auth::guard('admin')->logout();
        $req->session()->flush();
        $req->session()->regenerate();
        return redirect('/dashboard-login');
    }
    public function login(Request $req)
    {
        // validation
        $credentials = $req->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $admin = Admin::where('username', $credentials['username'])->first();
        if ($admin) {
            if (Hash::check($credentials['password'], $admin->password)) {
                $remember = $req['remember'] ? true : false;
                Auth::guard('admin')->login($admin, $remember = $remember);
                return redirect('/dashboard');
            }
        }
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
    public function uploadavatar(Request $req)
    {
        $req->validate([
            'avatar' => 'mimes:jpeg,jpg,png,gif|required|max:2048'
        ], [
            'avatar.max:2048' => "image size can't be bigger than 2mb"
        ]);

        $imageName = time() . '.' . $req->avatar->extension();

        $adminId = Auth::guard('admin')->id();
        $avatar = Avatar::where('user_id', $adminId)->first();
        if ($avatar) {
            request()->avatar->move(public_path('images/avatars'), $avatar->title);
        } else {
            request()->avatar->move(public_path('images/avatars'), $imageName);
            $new_avatar = new Avatar();
            $new_avatar->user_id = $adminId;
            $new_avatar->title = $imageName;
            $new_avatar->save();
        }

        return redirect('/dashboard/profile');
    }
    public function logout(Request $req)
    {
        Auth::guard('admin')->logout();
        $req->session()->flush();
        $req->session()->regenerate();
        return redirect('/dashboard-login');
    }
}
