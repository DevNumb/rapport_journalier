<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks'; // Optional, if your table name is different
    public $timestamps = true; // Optional, if you have created_at and updated_at columns
    protected $fillable = ['title', 'description', 'status', 'project_id', 'worker_id','hours', 'system_date',];

    protected $casts = [
        'system_date' => 'datetime',];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
