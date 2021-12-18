<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $flags_count = DB::table('flags')->count();
        if (empty($flags_count)) {
            DB::table('flags')->insert(
                [
                    ['name' => "просрочен"],
                    ['name' => "работает"],
                    ['name' => "премиум"]
                ]
            );
        }
    }
}
