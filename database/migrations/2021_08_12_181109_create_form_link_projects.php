<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormLinkProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms_link_projects', function (Blueprint $table) {
            $table->bigIncrements('forms_link_projects_id');
            $table->timestamps();
        });
    }
 
}
