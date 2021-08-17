<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormLinkProject extends Model
{
    protected $table =  'forms_link_projects';
    protected $fillable = ['forms_id','projects_id',];
}
