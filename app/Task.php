<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'project_id',
        'user_id',
        'company_id',
        'days',
        'hours'
    ];

    public function project(){
        return $this->hasMany(Project::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function projects(){
        return $this->belongsToMany(Project::class);
    }
}
