<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFromCutOversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('from_cut_overs', function (Blueprint $table) {
           $table->bigIncrements('forms_cut_overs_id');
            $table->integer('forms_cut_overs_no');
            $table->timestamps();
        });
    }

   
}
