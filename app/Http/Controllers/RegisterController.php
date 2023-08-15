<?php

namespace App\Http\Controllers;

//Import the model
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() 
    {
        //If the user has already registered or login
        //the system will redirect them to the home page
        if(auth()->user()){
            return redirect()->route('home', [
              'posts' => auth()->user()->posts
            ]);
        }else{
            return view('auth.register');
        }
    }

    public function store(Request $request)
    {
       // dd($request);
       //with dd() you have access to all the values
       //dd($request->get('email'));

       //Modify the request
       //Slug puts a dash between spaces hello angel -> to hello-angel 
       //this avoids to duplicate usernames
       //$request->request->add(['username'=> Str::slug($request->username)]);

       //Validation
       $request->validate([
            'name' => 'required|max:30|string',
            'username' => 'required|string|alpha_dash|unique:users,username|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
       ]);

       User::create([
            'name' => $request->name,
            'username' => Str::lower($request->username),
            'email' => $request->email,
            //Hash the password
            //bcrypt($request->password)
            'password' => Hash::make($request->password)
       ]);


       //Authenticate the user
       /* auth()->attempt([
        'email' => $request->email,
        'password' => $request->password
       ]); */

       //Another way to authenticate the user
       auth()->attempt($request->only('email', 'password'));

       //Redirect user
       return redirect()->route('posts.index', auth()->user()->username);


    }

}
