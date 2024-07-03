<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_category extends Model
{
    use HasFactory;
    public function movie(){
        return $this->belongsTo(Category::class);
    }
}

