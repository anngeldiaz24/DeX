<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    //Determina if the user can delete the model
    public function delete(User $user, Post $post)
    {
        /* If the creator of this post is the same person who is authenticated
        he/she, will be able to delete the post  */ 
        return $user->id === $post->user_id;
        
    }
}
