<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrimaryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primary_categories')->insert([
            'id'      => 1,
            'name'    => 'レディース',
            'sort_no' => 1,
        ]);
        DB::table('primary_categories')->insert([
            'id'      => 2,
            'name'    => 'メンズ',
            'sort_no' => 2,
        ]);
        DB::table('primary_categories')->insert([
            'id'      => 3,
            'name'    => 'ベビー・キッズ',
            'sort_no' => 3,
        ]);
        DB::table('primary_categories')->insert([
            'id'      => 4,
            'name'    => 'その他',
            'sort_no' => 4,
        ]);
    }
}
