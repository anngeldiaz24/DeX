<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //We change the logic to LikePost.php
    public function store(Request $request, Post $post)
    {
        //We save the information through the relation
        /* $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back(); */
    }

    public function destroy(Request $request, Post $post)
    {
        /* $request->user()->likes()->where('post_id', $post->id)->delete();

        return back(); */

    }
}
