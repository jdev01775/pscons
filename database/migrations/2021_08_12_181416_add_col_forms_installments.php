<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColFormsInstallments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forms_installments', function (Blueprint $table) {
            $table->foreignId('forms_id')->references('forms_id')->on('forms')->onDelete('cascade');
        });
    }

  
}
