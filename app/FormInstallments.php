<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormInstallments extends Model
{
    protected $table =  'forms_installments';
    protected $fillable = ['forms_installments_no','forms_idIndex','forms_id'];
}
