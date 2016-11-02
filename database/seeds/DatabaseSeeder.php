<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AppKeySeeder::class);
         $this->call(CoursesSeeder::class);
         $this->call(SectionSeeder::class);
         $this->call(OjtHoursSeeder::class);
    }
}
