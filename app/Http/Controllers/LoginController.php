<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
  
    public function index()
    {
        if(auth()->user()){
            return redirect()->route('home', [
              'posts' => auth()->user()->posts
            ]);
        }else {
            return view('auth.login');
        }
        
    }

    public function store(Request $request)
    {
        //dd is used to check if the communication
        //between routes is successful
        //dd("Autenticando");

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Request->remember will help us to maintain the session logging
        //It will appear in the remember_token field of our database

        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            //back helps you to return to the login page in case
            //credentials are not correct
            return back()->with('mensaje', 'Incorrect Credentials');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
