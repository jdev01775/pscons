<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsSubCutOvers2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms_sub_cut_overs', function (Blueprint $table) {
            $table->bigIncrements('forms_sub_cut_overs_id');
            $table->integer('forms_sub_cut_overs_no');
            $table->string('forms_sub_cut_overs_detail');
            $table->timestamps();
        });
    }

  
}
