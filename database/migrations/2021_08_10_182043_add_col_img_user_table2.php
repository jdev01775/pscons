<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColImgUserTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //dropColumn

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_imgs_name');
            $table->dropColumn('user_imgs_name_new');
            $table->dropColumn('user_imgs_path');
        });

        Schema::create('users_link_img', function (Blueprint $table) {
            $table->bigIncrements('users_link_img_id');
            $table->string('user_imgs_name');
            $table->string('user_imgs_name_new');
            $table->string('user_imgs_path');
            $table->timestamps();
        });

        Schema::table('users_link_img', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
