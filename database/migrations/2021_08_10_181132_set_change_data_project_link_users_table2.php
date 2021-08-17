<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetChangeDataProjectLinkUsersTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_link_users', function (Blueprint $table) {
            $table->dropColumn('id');	
        });

        Schema::table('project_link_users', function (Blueprint $table) {
            $table->bigIncrements('project_link_users_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
