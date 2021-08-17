<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColSubCutOff4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forms_cut_overs', function (Blueprint $table) {
            $table->integer('from_sub_cut_amount_date_after_check');
        });
    }

    
}
