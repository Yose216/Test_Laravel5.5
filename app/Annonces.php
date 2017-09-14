<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annonces extends Model
{
    protected $fillable = ['title','descriptions','user_id'];

    public function user() 
    {
        return $this->belongsTo(\App\User::class);
    }
}
