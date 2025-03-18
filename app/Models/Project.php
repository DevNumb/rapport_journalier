<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'ref',
        'nom_projet',
        'description'
    ];

    // In your Project model
public function tasks()
{
    return $this->hasMany(Task::class);
}

}


