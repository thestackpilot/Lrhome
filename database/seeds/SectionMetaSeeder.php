<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // content for section id 1 start
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'new_arrival_heading',
                'meta_value' => 'Explore New Arrivals',
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_left',
                'meta_value' => '#',
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_top_left',
                'meta_value' => '#',
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_top_right',
                'meta_value' => '#',
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_bottom',
                'meta_value' => '#',
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_left_url',
                'meta_value' => '#',
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_top_right_url',
                'meta_value' => '#',
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_top_left_url',
                'meta_value' => '#',
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_bottom_url',
                'meta_value' => '#',
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_left_title',
                'meta_value' => "See What's new",
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_top_left_title',
                'meta_value' => "Bestsellers",
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_top_right_title',
                'meta_value' => "The Nala Collection",
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_bottom_title',
                'meta_value' => "The Rayan Collection",
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_left_caption',
                'meta_value' => "2021",
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_top_left_caption',
                'meta_value' => "1124 Items",
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_top_right_caption',
                'meta_value' => "",
                'section_id' => '1'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_bottom_caption',
                'meta_value' => "",
                'section_id' => '1'
            ]
        );
        // content for section id 2 start
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'new_additions_heading',
                'meta_value' => 'New Additions',
                'section_id' => '2'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'new_additions_caption',
                'meta_value' => 'Follow our blog for the latest trends, home tips, and touching stories from Textile Talker, Teresa',
                'section_id' => '2'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'button_text',
                'meta_value' => 'FIND OUT MORE',
                'section_id' => '2'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'button_url',
                'meta_value' => '#',
                'section_id' => '2'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_right',
                'meta_value' => '#',
                'section_id' => '2'
            ]
        );
        // content for section id 3 start
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'products_title',
                'meta_value' => 'Our Products',
                'section_id' => '3'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'cat_1_image',
                'meta_value' => '#',
                'section_id' => '3'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'cat_1_url',
                'meta_value' => '#',
                'section_id' => '3'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'cat_1_title',
                'meta_value' => 'Rugs',
                'section_id' => '3'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'cat_2_image',
                'meta_value' => '#',
                'section_id' => '3'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'cat_2_url',
                'meta_value' => '#',
                'section_id' => '3'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'cat_2_title',
                'meta_value' => 'Bedding',
                'section_id' => '3'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'cat_3_image',
                'meta_value' => '#',
                'section_id' => '3'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'cat_3_url',
                'meta_value' => '#',
                'section_id' => '3'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'cat_3_title',
                'meta_value' => 'Pillows',
                'section_id' => '3'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'cat_4_image',
                'meta_value' => '#',
                'section_id' => '3'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'cat_4_url',
                'meta_value' => '#',
                'section_id' => '3'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'cat_4_title',
                'meta_value' => 'Throws',
                'section_id' => '3'
            ]
        );
        // content for section id 4 start
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'learn_more_para',
                'meta_value' => "We make rugs for the thoughtfully layered home. For spaces designed with intention. For people that know a good rug doesn’t just tie the room together—it sets the home apart.",
                'section_id' => '4'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'button_title',
                'meta_value' => "Learn More",
                'section_id' => '4'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'button_url',
                'meta_value' => "#",
                'section_id' => '4'
            ]
        );
        // content for section id 5 start
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'about_rizy_heading_top',
                'meta_value' => "About",
                'section_id' => '5'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'about_rizy_heading_bottom',
                'meta_value' => "Rizzy Home",
                'section_id' => '5'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'about_rizy_para',
                'meta_value' => "The direct result of collaboration between two entrepreneurial brothers, Rizzy Home is the combined effort of Rizwan and Shamsu Ansari. Originally started as Rizzy Rugs and Home Texco, Rizzy Home now offers an extensive assortment of rugs.",
                'section_id' => '5'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'video_url',
                'meta_value' => "#",
                'section_id' => '5'
            ]
        );
        // content for section id 6 start
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'rizzy_home_heading',
                'meta_value' => "@rizzyhome",
                'section_id' => '6'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_1',
                'meta_value' => "#",
                'section_id' => '6'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_2',
                'meta_value' => "#",
                'section_id' => '6'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_3',
                'meta_value' => "#",
                'section_id' => '6'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_4',
                'meta_value' => "#",
                'section_id' => '6'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_5',
                'meta_value' => "#",
                'section_id' => '6'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_1_url',
                'meta_value' => "#",
                'section_id' => '6'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_2_url',
                'meta_value' => "#",
                'section_id' => '6'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_3_url',
                'meta_value' => "#",
                'section_id' => '6'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_4_url',
                'meta_value' => "#",
                'section_id' => '6'
            ]
        );
        DB::table('section_meta')->insert(
            [
                'meta_key' => 'image_5_url',
                'meta_value' => "#",
                'section_id' => '6'
            ]
        );
    }
}
