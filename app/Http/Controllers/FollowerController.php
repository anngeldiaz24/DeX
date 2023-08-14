<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //
    //User is the user we are following
    public function store(User $user)
    {
        //Muchos a muchos
        $user->followers()->attach(auth()->user()->id );

        return back();
    }

    public function destroy(User $user)
    {
        //Muchos a muchos
        $user->followers()->detach(auth()->user()->id );

        return back();
    }
}
