<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request){
        // validate data
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // login code

        if(\Auth::attempt($request->only('email','password'))){
           return redirect()->route('books.index');
        }

        return redirect()->route('/')->withError('Login details are not valid');

    }

    public function register_view()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // validate
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/u', 'max:15'],
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed'
        ]);
    
        // save in users table
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password)
        ]);
        if (!$user){
            return redirect(route('register'))->with('error','Registration Failed, Try Again');
        }
        return redirect(route('login'))->with('success','Registration Successful');
    }
    
        // login user here
    
        // if (\Auth::attempt($request->only('email', 'password'))) {
        //     return redirect()->route('books');
        // }
    
    //     return redirect()->route('login')->withSuccess('Registration successful. Please login to continue.');
    //     if (\Auth::attempt($request->only('email', 'password'))) {
    //         return redirect()->route('/books');
    //     }
    // }
    

    public function books(){
        return view('books');
    }

     public function logout(){
        \Session::flush();
        \Auth::logout();
        return redirect('/');
    }
}

