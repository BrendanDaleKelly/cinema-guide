<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    protected $fillable = ['movie_id', 'cinema_id', 'time'];
}
