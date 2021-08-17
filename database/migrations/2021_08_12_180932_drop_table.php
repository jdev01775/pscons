<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('from_sub_cut_overs');
        Schema::drop('from_cut_overs');
        Schema::drop('from_link_projects');
    }
 
}
