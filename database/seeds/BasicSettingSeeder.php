<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasicSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('basic_settings')->insert(
            [
                [
                    'logo_light'=>'logo.png',
                    'logo_dark'=>'logo-dark.png',
                    'contact'=>'877 499 7847',
                    'email'=>'info@rizzyhome.com',
                    'address'=>'900 Marine Drive Calhoun, GA 30701',
                    'website'=>'www.rizzyhome.com'
                ],
            ]
        );
    }
}
