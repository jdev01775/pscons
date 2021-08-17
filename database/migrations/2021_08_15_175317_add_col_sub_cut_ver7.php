<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColSubCutVer7 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forms_cut_overs', function (Blueprint $table) {
              $table->bigIncrements('forms_cut_overs_id');
        });
    }

     
}
