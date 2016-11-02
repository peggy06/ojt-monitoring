<?php

use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'name'      => 'Bachelor Of Science In Information Technology',
            'shortname' => 'Information Technology',
            'code'      => 'IT',
            'available' => 1
        ]);

        DB::table('courses')->insert([
            'name'      => 'Bachelor Of Industrial Technology',
            'shortname' => 'Industrial Technology',
            'code'      => 'BIT',
            'available' => 0
        ]);

        DB::table('courses')->insert([
            'name'      => 'Bachelor Of Science In Secondary Education',
            'shortname' => 'Education',
            'code'      => 'BSED',
            'available' => 0
        ]);

        DB::table('courses')->insert([
            'name'      => 'Bachelor Of Elementary Education',
            'shortname' => 'Education',
            'code'      => 'BEED',
            'available' => 0
        ]);

        DB::table('courses')->insert([
            'name'      => 'Bachelor Of Science In Hotel And Restaurant Management',
            'shortname' => 'HRM',
            'code'      => 'HRM',
            'available' => 0
        ]);

        DB::table('courses')->insert([
            'name'      => 'Bachelor Of Business Administration',
            'shortname' => 'Business Administration',
            'code'      => 'BAM',
            'available' => 0
        ]);
    }
}
