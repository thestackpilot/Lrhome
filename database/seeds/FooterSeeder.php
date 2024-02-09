<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('footers')->insert(
            [
                [
                  'name'=>'column1'
                ],
                [
                    'name'=>'column2'
                ],
                [
                    'name'=>'column3'
                ],
                [
                    'name'=>'social-media'
                ]
            ]
        );
    }
}
