<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    DB::table('users')->insert([

        'name'=> 'mostafa jehad ',
        'email'=> 'mostfa@jehad.ps' ,
        'password'=>Hash::make('password'),
    ]);
    }
}
