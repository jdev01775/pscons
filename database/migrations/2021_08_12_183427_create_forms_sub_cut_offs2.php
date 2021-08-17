<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsSubCutOffs2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms_sub_cut_offs', function (Blueprint $table) {
            $table->bigIncrements('form_sub_cut_offs_id');
            $table->integer('form_sub_cut_offs_no');
            $table->string('form_sub_cut_offs_detail');
            $table->timestamps();
        });
    }

 
}
