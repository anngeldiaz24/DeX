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

}
