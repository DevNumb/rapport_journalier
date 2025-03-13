<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


use App\Models\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Worker extends Authenticatable
{


    protected $table = 'workers';

    protected $fillable = ['name', 'email', 'password', 'role','poste'];


    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
