<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMainMenuIdColToPermitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_menu', function (Blueprint $table) {
            $table->id();
            $table->string('main_menu_name')->unique();
        });

        Schema::table('permition', function (Blueprint $table) {
            $table->foreignId('main_menu_id');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permition', function (Blueprint $table) {
            //
        });
    }
}
