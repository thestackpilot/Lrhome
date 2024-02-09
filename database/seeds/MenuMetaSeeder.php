<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_metas')->insert(
            [
                [
                    'meta_key'=>'title',
                    'meta_value' => 'New Additions',
                    'menu_id' => 1
                ],
                [
                    'meta_key'=>'url',
                    'meta_value' => '#',
                    'menu_id' => 1
                ],
                [
                    'meta_key'=>'title',
                    'meta_value' => 'Catalog',
                    'menu_id' => 1
                ],
                [
                    'meta_key'=>'url',
                    'meta_value' => '#',
                    'menu_id' => 1
                ],
                [
                    'meta_key'=>'title',
                    'meta_value' => 'Become a Dealer',
                    'menu_id' => 1
                ],
                [
                    'meta_key'=>'url',
                    'meta_value' => '#',
                    'menu_id' => 1
                ],

            ]
        );
    }
}
