<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFromSubCutOversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('from_sub_cut_overs', function (Blueprint $table) {
            $table->bigIncrements('from_sub_cut_overs_id');
            $table->integer('from_sub_cut_overs_no');
            $table->string('from_sub_cut_overs_detail');
            $table->timestamps();
        });
    }

  
}
