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
        $cat = ['телевизоры' => 'televisor', 'инструменты' => 'instrument', 'одежда' => 'odejda', 'продукты питания' => 'produkt_pitanij'];
        $category_count = DB::table('categories')->count();
        if(empty($category_count)){
            foreach ($cat as $key => $value) {
             DB::table('categories')->insert(
                 [
                     'title' => $key,
                     'slug' => $value
                 ]
                 );
             }  
        }
    }   
}
