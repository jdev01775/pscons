<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFormsSubCutOvers2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forms_sub_cut_overs', function (Blueprint $table) {
            $table->foreignId('from_cut_overs_id')->references('from_cut_overs_id')->on('forms_cut_overs')->onDelete('cascade');
        });
    }
 
}
