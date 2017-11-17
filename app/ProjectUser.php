<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $table = "project_user";//It's expecting table named: project_users,we need to define it's table
    protected $fillable = [
        'project_id',
        'user_id'
    ];
}
