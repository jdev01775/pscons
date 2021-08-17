<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColFormsSubInstallments2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forms_sub_installments', function (Blueprint $table) {
            $table->foreignId('forms_installments_id')->references('forms_installments_id')->on('forms_installments')->onDelete('cascade');
        });
    }

    
}
