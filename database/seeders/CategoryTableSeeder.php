<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                'title' => "телевизоры",
                 'slug' => "televisor" 
            ]
            
        );   
        DB::table('categories')->insert(
            
            [
                'title' => "инструменты",
                'slug' => "instrument"
            ]
        ); 
        DB::table('categories')->insert(
            
            [
                'title' => "одежда",
                'slug' => "odejda"
            ]
        );  
        DB::table('categories')->insert(
            
            [
                'title' => "продукты питания",
                'slug' => "produkt_pitanij"
            ]
        );  
    }
}
