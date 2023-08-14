<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts(){
        //One to many
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Stores the followers of a user
    public function followers()
    {
        //Un follower puede pertenecer a muchos usuarios
        // id('11') -> 4, 6, 1, 6
        //Follower id is the person who follows the user
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    //Stores the users that a follower follows
    public function followings()
    {
        // id('11') -> 4, 6, 1, 6
        //Follower id is the person who follows the user
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }


    //Check if user follows a follower
    public function siguiendo(User $user)
    {
        //Contains iterates through the followers table and 
        //check if user follows the followe
        //$user_id is who visit the muro
        return $this->followers->contains($user->id);
    }

}
