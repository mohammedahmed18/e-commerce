<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function getAllUsers(Request $req)
    {
        if ($req->input('user')) {
            $search = $req->input('user');

            $users = User::where(function($q) use ($search){
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            })->orderBy('id', 'DESC')->get();
       
        } else {
            $users = User::orderBy('id', 'DESC')->get();
        }
        return view('pages.dashboard.users', ['users' => $users]);
    }
    
    public function signup(Request $req)
    {
        $req->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|max:20|min:6',
                'confirm_password' => 'required',
            ],
            [
                'name.required' => "name is required",
                'email.required' => "email is required",
                'email.unique' => "sorry this email is already registered",
                'password.required' => "password is required",
                'confirm_password.required' => "confirm password is required",
                "password.min:6" => "The password must be at least 6 characters",
                'password.max:20' => "password can't be longer than 20 characters",
            ]
        );
        if($req->input('password') != $req->input('confirm_password')){
            return redirect('/signup')->with('error',"password doesn't match")->withInput();
        }
        $user = User::where('email',$req->input('email'))->first();
        if($user) {
            return redirect('/signup')->with('error',"this email already exists")->withInput();
        }
        $new_user = new User();
        $new_user->name = $req->input('name');
        $new_user->email = $req->input('email');
        $new_user->password = Hash::make($req->input('password'));
        $new_user->save();
        Session::flash('toast-success', 'Your account is created successfully');
        Auth::login($new_user, $remember =true);
        return redirect('/');
    }

    public function login(Request $req){

        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = User::where('email',$credentials['email'])->first();
        if ($user) {
            if(Hash::check($credentials['password'], $user->password))
            {
                $rememberMe = $req['rememberMe']?true:false;
                if($user->blocked){
                    Session::flash('toast-error', 'sorry you can\'t view your account right now'); 
                    return back()->withInput();
                }
                Auth::login($user, $remember =$rememberMe);
                Session::flash('toast-info', 'You are logged in'); 
                $redirect = $req->input('redirect');
                if($redirect){
                    return redirect($redirect);
                }
                return redirect('/');
            }
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        Session::flash('toast-info', 'you are logged out');
        return Redirect::back();
    }

    public function toggleBlock($id){
        $user = User::find($id);
        if ($user->blocked) {
            // unblock
            $user->blocked = false;
            Session::flash('toast-info', $user->name.' is unblocked'); 
        }else{
            $user->blocked = true;
            Session::flash('toast-error', $user->name.' is bolcked'); 
        
        }
    
        $user->save();
        return;
    }


}
