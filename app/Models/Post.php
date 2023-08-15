<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //Information required for creating a new post in the DB
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user()
    {
        //Select works to just select some attributes you want to show in tinker
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios()
    {
        //A post has many comments
        return $this->hasMany(Comentario::class);    
    }

    public function likes()
    {
        //A post has many likes
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        //Se posiciona en la tabla de likes
        //Verifica si un usuario ya le dio like al post
        //Check the columns
        return $this->likes->contains('user_id', $user->id);
    }


}
