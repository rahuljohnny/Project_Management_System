<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [

      'name',
      'description',
      'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }

    /*
    public function createNew(Company $company) //TODO: A user can publish a post
    {
        $this->companies()->save($company); //TODO: As we have access to the posts,we only need to save a new post to database,nothing more


        /* another approach of saving post,but it didn't work for me

          Post::create(request
        ([
                'title' => request('title'),
                'body' => request('body'),
                'user_id' => auth()->id()
        ]));

        */



}
