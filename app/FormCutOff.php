<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormCutOff extends Model
{
    protected $table =  'forms_cut_offs';
    protected $fillable = ['forms_cut_offs_no','forms_cut_offs_detail','forms_id'];
}
