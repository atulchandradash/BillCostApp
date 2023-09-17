<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{

    use HasFactory;

    protected $fillable = [
        'categorie_name',
        'userid',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function costs()
    {
        return $this->hasMany(Cost::class, 'categories_id');
    }
}