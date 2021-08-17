<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('project_details', function (Blueprint $table) {
            $table->bigIncrements('project_details_id');
            $table->bigInteger('projects_id');
            $table->integer('project_details_plot_from');
            $table->integer('project_details_plot_to');
            $table->integer('project_details_unit_amount');
            $table->string('project_details_type_home');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_details');
    }
}
