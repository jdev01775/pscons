<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    //
    protected $fillable = ['project_details_plot_from',
    'project_details_plot_to',
    'project_details_unit_amount',
    'project_details_type_home',
    'projects_id',
    ];

}
