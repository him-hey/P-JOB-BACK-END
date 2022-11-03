<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'firstname' => 'amdin',
            'lastname' => 'amdin',
            'gender' => 'male',
            'phone' => '09876533',
            'dateofbirth' => '2020-01-02',
            'email' => 'amdin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);
    }
}
