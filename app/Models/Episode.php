<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    public function movie(){
        return $this->belongsTo(Movie::class);
    }
    public function link_movie(){
        return $this->belongsTo(Link_movie::class);
    }
}
