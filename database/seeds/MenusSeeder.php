<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert(
            [
                [
                    'name'=>'Main Menu'
                ],
                [
                    'name'=>'Category Menu'
                ],

            ]
        );
    }
}
