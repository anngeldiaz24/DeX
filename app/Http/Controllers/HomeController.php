<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //To see the main page, the user need to be authenticated
    public function __construct()
    {
        $this->middleware('auth');
    }



    //It is called automatically
    public function __invoke()
    {
        //Get people who we follow
        //Pluck gets the value of a determined column of our table
        $ids = auth()->user()->followings->pluck('id')->toArray();
        //Where In accepts arrays
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        
        /* dd($posts); */
        return view('home', [
            'posts' => $posts
        ]);
    }
}
