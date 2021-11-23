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
                ['title' => "телевизоры"],
                ['title' => "инструменты"],
                ['title' => "климатическое оборудование"],
                ['title' => "одежда"],
                ['title' => "продукты питания"],
            ]
        );
    }
}
