<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movies_genra extends Model
{
    use HasFactory;
    protected $fillable = [
        'movie_id',
        'genra_id',
    ];
}
