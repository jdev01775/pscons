<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColFromSubInstallments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('from_sub_installments', function (Blueprint $table) {
            $table->foreignId('forms_installments_id')->references('forms_installments_id')->on('from_installments')->onDelete('cascade');
        });
    }

    
}
