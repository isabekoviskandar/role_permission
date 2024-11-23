<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route as FacadesRoute;

class AuthController extends Controller
{
    public function loginPage(){

        return view('auth2.login');

    }

    public function login(Request $request){
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        if (FacadesAuth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/students')->with('success', 'You are logged in!');
        }else{
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }

    public function registerPage(){
        return view('auth2.register');
    }

    public function register(Request $request){
        // dd($request->all());
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
    
            return redirect('/')->with('success', 'User Registered successfully. Please Login!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }

    public function logout(){
        FacadesAuth::logout();
        return redirect('/')->with('success', 'You have been logged out.');
    }

}
