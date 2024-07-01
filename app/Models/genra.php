<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genra extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'e_id',
        'name',
    ];

    public function movies(){
        return $this->belongsToMany(movie::class , 'movies_genras');
       }


}
