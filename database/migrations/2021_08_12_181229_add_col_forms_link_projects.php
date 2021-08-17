<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColFormsLinkProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forms_link_projects', function (Blueprint $table) {
            $table->foreignId('forms_id')->references('forms_id')->on('forms')->onDelete('cascade');
            $table->foreignId('projects_id')->references('projects_id')->on('projects')->onDelete('cascade');
        });
    }

}
