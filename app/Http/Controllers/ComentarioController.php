<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //
    public function store(Request $request, User $user, Post $post){
        //Validate
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        //Store
        Comentario::create([
            //El usuario es el que comenta, no del dueño de la publicación
            'user_id' => auth()->user()->id,
            'post_id' => $post->id, 
            'comentario' => $request->comentario 
        ]);

        //Save and show a message
        //With lo utilizamos con sesiones (session('mensaje)) in the view
        return back()->with('mensaje', 'Your coment was made successfully');
    }
    
}
