<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColUserTableNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_firstname');
            $table->dropColumn('user_lastname');
            $table->dropColumn('user_status');
            $table->dropColumn('position_id');
           
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_firstname');
            $table->string('user_lastname');
            $table->integer('user_status');
            $table->unsignedBigInteger('position_id');
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
