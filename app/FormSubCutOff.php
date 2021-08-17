<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormSubCutOff extends Model
{
    //
    protected $table =  'forms_sub_cut_offs';
    protected $fillable = ['form_sub_cut_offs_no',
                            'form_sub_cut_offs_detail',
                            'forms_cut_offs_id',
                        ];
    
}
