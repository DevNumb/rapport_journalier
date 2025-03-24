<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks'; // Optional, if your table name is different
    public $timestamps = true; // Optional, if you have created_at and updated_at columns
// app/Models/Task.php
// app/Models/Task.php
protected $fillable = [
    'title',
    'description',
    'status',
    'duree_debut',
    'duree_fin',
    'hours',
    'project_id',
    'worker_id',
    'system_date'
];

protected $casts = [
    'duree_debut' => 'string', // Or 'time' if using a time cast
    'duree_fin' => 'string',
    'system_date' => 'datetime'
];



    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
