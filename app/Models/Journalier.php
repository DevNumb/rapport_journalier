<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journalier extends Model
{
    protected $fillable = [
        'nom',
        'projet',
        'duree_debut',
        'duree_fin',
        'description',
        'date'  // Make sure date is here
    ];
}
