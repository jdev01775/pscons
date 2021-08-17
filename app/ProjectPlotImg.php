<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectPlotImg extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'project_plot_imgs_name', 
        'project_plot_imgs_name_new',
        'project_plot_imgs_path',
    ];

}
