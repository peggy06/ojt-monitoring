<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' =>  'Pedro',
            'lastname'  =>  'Abanador',
            'name'      =>  'Pedro Abanador',
            'email'     =>  'pedro@gmail.com',
            'password'  =>  bcrypt('password'),
            'role'      =>  1,
        ]);
    }
}
