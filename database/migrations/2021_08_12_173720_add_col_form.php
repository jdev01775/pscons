<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('froms');

        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('forms_id');
            $table->integer('menu_id');
            $table->string('forms_status');
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
        //
    }
}
