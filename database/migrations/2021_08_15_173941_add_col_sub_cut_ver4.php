<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColSubCutVer4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forms_cut_overs', function (Blueprint $table) {
            $table->dropColumn(['from_cut_overs_no',
                                'from_cut_overs_amount_date_after_check',
                                ]);
            $table->integer('forms_cut_overs_no');
            $table->integer('forms_cut_amount_date_after_check');
        });
      
    }
 
}
