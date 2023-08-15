<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    //In livewire, we cannot get access to the Request object
    public $post;
    public $isLiked;
    public $likes;

    public function mount($post)
    {
        /* This is equals to a contruct */
        //excecutes automatically
        //Just evaluates when initializes the component
        $this->isLiked = $post->checkLike(auth()->user());

        $this->likes = $post->likes->count();
    }

    public function like()
    {
        if ($this->post->checkLike(auth()->user()))
        {
            //verifica si el usuario autenticado existe en los likes de este post.
            $this->post->likes()->where('user_id', auth()->user()->id)->delete();
            //We need to verify this condition to execute the changes automatically
            $this->isLiked = false;
            $this->likes--;
        }else{
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
