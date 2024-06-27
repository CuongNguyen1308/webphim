<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link_movie extends Model
{
    use HasFactory;
    protected $table = 'link_movies';
    protected $fillable = [
        'title','description','status'
    ];
}
