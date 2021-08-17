<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColImgUserTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('users_link_img');

        Schema::create('users_link_img', function (Blueprint $table) {
            $table->bigIncrements('users_link_img_id');
            $table->string('users_link_img_name');
            $table->string('users_link_img_name_new');
            $table->string('users_link_img_path');
            $table->timestamps();
        });

        Schema::table('users_link_img', function (Blueprint $table) {
            $table->foreignId('users_id')->references('id')->on('users')->onDelete('cascade');
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
