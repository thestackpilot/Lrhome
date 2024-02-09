<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             PagesSeeder::class,
             SectionsSeeder::class,
             SectionMetaSeeder::class,
             SliderSeeder::class,
             SliderImagesSeeder::class,
             UserSeeder::class,
             FooterSeeder::class,
             FooterMetaSeeder::class,
             BasicSettingSeeder::class,
             MenusSeeder::class,
             MenuMetaSeeder::class,
             RoleSeeder::class
         ]);
    }
}
