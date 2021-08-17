<?php

use Illuminate\Database\Seeder;

class PremissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission')->insert([
            'permission_name' => Int::random(10),
            'main_menu_id' => Str::random(10),
        ]);
    }
}
