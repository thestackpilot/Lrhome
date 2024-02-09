<?php

use Illuminate\Database\Seeder;
use App\Page;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert(
            [
            'name' => 'main',
            'slug' => 'main'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'home',
                'slug' => 'home'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'about',
                'slug' => 'about'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'contact',
                'slug' => 'contact'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'careers',
                'slug' => 'careers'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'showrooms',
                'slug' => 'showrooms'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'become a dealer',
                'slug' => 'become-a-dealer'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'create account',
                'slug' => 'create-account'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'steelyard',
                'slug' => 'steelyard'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'trends',
                'slug' => 'trends'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'feedback',
                'slug' => 'feedback'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'faq',
                'slug' => 'faq'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'login',
                'slug' => 'login'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'special buys',
                'slug' => 'special-buys'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'new additions',
                'slug' => 'new-additions'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'bedding',
                'slug' => 'bedding'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'pillows',
                'slug' => 'pillows'
            ]
        );
        DB::table('pages')->insert(
            [
                'name' => 'throws',
                'slug' => 'throws'
            ]
        );
    }
}
