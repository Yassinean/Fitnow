<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progression extends Model
{
    use HasFactory;

    protected $fillable = [
        'poids',
        'taille',
        'performances',
        'user_id',
    ];

    public function user(){
        return $this->hasOne(Progression::class);
    }
}