<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slider_images')->insert(
            [
                'caption_1' => 'Create your own',
                'caption_2' => 'Unique space',
                'image' => '#',
            ]
        );
        DB::table('slider_images')->insert(
            [
                'caption_1' => 'Create your own',
                'caption_2' => 'Unique space',
                'image' => '#',
            ]
        );
        DB::table('slider_images')->insert(
            [
                'caption_1' => 'Create your own',
                'caption_2' => 'Unique space',
                'image' => '#',
            ]
        );
    }
}
