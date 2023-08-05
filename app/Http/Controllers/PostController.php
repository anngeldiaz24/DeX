<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //The user needs to be logged in to get access to the wall  
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        //Auth() will check out the user has already been authenticated
        //dd(auth()->user());

        //Here, index will show the user only the posts with his/her id
        //$posts = Post::where('user_id', $user->id)->get();
        //It will paginate the posts every 20 posts
        $posts = Post::where('user_id', $user->id)->paginate(20);
        //dd($posts);
        
        return view('dashboard', [
            //Pasamos la informacion a la vista
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'

        ]);

        /* Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id

        ]);
    */
        //Another way to create a record
        /* $post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();
    */

    //Saving data with relations
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
        
    }
}


