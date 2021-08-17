<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormSubCutOver extends Model
{
    protected $table =  'forms_sub_cut_overs';
    protected $fillable = ['forms_sub_cut_overs_no',
                            'forms_sub_cut_overs_detail',
                            'forms_cut_overs_id',
                        ];
}
