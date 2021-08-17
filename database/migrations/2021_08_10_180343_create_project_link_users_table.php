<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectLinkUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_link_users', function (Blueprint $table) {
            $table->bigIncrements('project_link_users_id');
            $table->integer('id');
            $table->timestamps();
        });

        Schema::table('project_link_users', function (Blueprint $table) {
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
        Schema::dropIfExists('project_link_users');
    }
}
