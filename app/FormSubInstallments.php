<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormSubInstallments extends Model
{
    protected $table =  'forms_sub_installments';
    protected $fillable = ['forms_sub_installments_no',
                            'forms_sub_installments_detail',
                            'forms_sub_installments_percent',
                            'forms_sub_installments_operation_cost',
                            'forms_installments_id',
                                                ];
}
