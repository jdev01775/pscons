<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetForeignKeyProjectsDetailsProjectsId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::drop('project_details');
       
        
        Schema::create('project_details', function (Blueprint $table) {
            $table->bigIncrements('project_details_id');
           
            $table->integer('project_details_plot_from');
            $table->integer('project_details_plot_to');
            $table->integer('project_details_unit_amount');
            $table->string('project_details_type_home');
            $table->timestamps();
        });

        Schema::table('project_details', function (Blueprint $table) {
            $table->foreignId('projects_id')->references('projects_id')->on('projects')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
