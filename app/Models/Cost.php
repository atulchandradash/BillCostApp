<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'cost',
        'categories_id',
        'date'
    ];


    public function categorie() // Use lowercase "categorie" here
    {
        return $this->belongsTo(Categorie::class, 'categories_id');
    }
}