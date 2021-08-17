<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLinkImg extends Model
{
    protected $table = 'users_link_img';

    protected $fillable = [
        'users_link_img_name', 
        'users_link_img_name_new',
        'users_link_img_path',
        'users_id',
    ];

    
}
