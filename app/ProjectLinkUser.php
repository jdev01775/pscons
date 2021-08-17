<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectLinkUser extends Model
{
    protected $table = 'project_link_users';

    protected $fillable = [
        'projects_id', 
        'users_id',
    ];
}
