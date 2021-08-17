<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectPlotImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_plot_imgs', function (Blueprint $table) {
            $table->bigIncrements('project_plot_imgs_id');
            $table->string('project_plot_imgs_name');
            $table->string('project_plot_imgs_name_new');
            $table->string('project_plot_imgs_path');
            $table->timestamps();

        });

        Schema::table('project_plot_imgs', function (Blueprint $table) {
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
        Schema::dropIfExists('project_plot_imgs');
    }
}
