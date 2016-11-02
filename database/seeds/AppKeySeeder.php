<?php

use Illuminate\Database\Seeder;

class AppKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keys')->insert([
            'app_key'   => 'CL57321Q1753Q356'
        ]);
    }
}
