<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert(
            [
                'name' => 'New Arrivals',
                'page_id' => '2'
            ]
        );
        DB::table('sections')->insert(
            [
                'name' => 'New Additions',
                'page_id' => '2'
            ]
        );
        DB::table('sections')->insert(
            [
                'name' => 'Our Products',
                'page_id' => '2'
            ]
        );
        DB::table('sections')->insert(
            [
                'name' => 'Learn More',
                'page_id' => '2'
            ]
        );
        DB::table('sections')->insert(
            [
                'name' => 'About Rizzy',
                'page_id' => '2'
            ]
        );
        DB::table('sections')->insert(
            [
                'name' => 'rizzyhome',
                'page_id' => '2'
            ]
        );
    }
}
