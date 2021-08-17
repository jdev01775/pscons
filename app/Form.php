<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table =  'forms';
    protected $fillable = ['menu_id','forms_name','forms_status'];

}
