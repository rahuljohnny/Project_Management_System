<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable=[
        'name',
        'description',
        'company_id',
        'user_id',
        'days'
    ];

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }
}
