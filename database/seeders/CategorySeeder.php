<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'category' => "IT"
        ]);
        DB::table('categories')->insert([
            'category' => "Education"
        ]);
        DB::table('categories')->insert([
            'category' => "Sale"
        ]);
        DB::table('categories')->insert([
            'category' => "Doctor"
        ]);
        DB::table('categories')->insert([
            'category' => "Dilivery"
        ]);
    }
}
