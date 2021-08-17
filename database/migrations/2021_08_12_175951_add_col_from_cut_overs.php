<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColFromCutOvers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('from_cut_overs', function (Blueprint $table) {
            $table->foreignId('forms_id')->references('forms_id')->on('forms')->onDelete('cascade');
        });
    }

   
}
