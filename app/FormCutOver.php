<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormCutOver extends Model
{
    protected $table =  'forms_cut_overs';
    protected $fillable = ['forms_cut_overs_no','forms_cut_amount_date_after_check','forms_id'];
}