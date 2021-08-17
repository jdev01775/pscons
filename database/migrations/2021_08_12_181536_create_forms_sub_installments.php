<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsSubInstallments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms_sub_installments', function (Blueprint $table) {
            $table->bigIncrements('forms_sub_installments_id');
            $table->integer('forms_sub_installments_no');
            $table->string('forms_sub_installments_detail');
            $table->float('forms_sub_installments_percent',8,2);
            $table->integer('forms_sub_installments_operation_cost');
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
        Schema::dropIfExists('forms_sub_installments');
    }
}
