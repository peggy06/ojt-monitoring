<?php

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
        'section'   => '4A'
        ]);

        DB::table('sections')->insert([
        'section'   => '4B'
        ]);

        DB::table('sections')->insert([
        'section'   => '4C'
        ]);

        DB::table('sections')->insert([
        'section'   => '4D'
        ]);

        DB::table('sections')->insert([
        'section'   => '4E'
        ]);
    }
}
