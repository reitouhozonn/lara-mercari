<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SecondaryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('secondary_categories')->insert([
            'id'                  => 1,
            'name'                => 'トップス',
            'sort_no'             => 1,
            'primary_category_id' => 1,
        ]);
        DB::table('secondary_categories')->insert([
            'id'                  => 2,
            'name'                => 'ジャケット/アウター',
            'sort_no'             => 2,
            'primary_category_id' => 1,
        ]);
        DB::table('secondary_categories')->insert([
            'id'                  => 3,
            'name'                => 'パンツ',
            'sort_no'             => 3,
            'primary_category_id' => 1,
        ]);
        DB::table('secondary_categories')->insert([
            'id'                  => 4,
            'name'                => 'トップス',
            'sort_no'             => 4,
            'primary_category_id' => 2,
        ]);
        DB::table('secondary_categories')->insert([
            'id'                  => 5,
            'name'                => 'ジャケット/アウター',
            'sort_no'             => 5,
            'primary_category_id' => 2,
        ]);
        DB::table('secondary_categories')->insert([
            'id'                  => 6,
            'name'                => '靴',
            'sort_no'             => 6,
            'primary_category_id' => 2,
        ]);
        DB::table('secondary_categories')->insert([
            'id'                  => 7,
            'name'                => 'ベビー服（男の子用）',
            'sort_no'             => 7,
            'primary_category_id' => 3,
        ]);
        DB::table('secondary_categories')->insert([
            'id'                  => 8,
            'name'                => 'ベビー服（女の子用）',
            'sort_no'             => 8,
            'primary_category_id' => 3,
        ]);
        DB::table('secondary_categories')->insert([
            'id'                  => 9,
            'name'                => 'キッズ服（男の子用）',
            'sort_no'             => 9,
            'primary_category_id' => 3,
        ]);
        DB::table('secondary_categories')->insert([
            'id'                  => 10,
            'name'                => 'キッズ服（女の子用）',
            'sort_no'             => 10,
            'primary_category_id' => 3,
        ]);
        DB::table('secondary_categories')->insert([
            'id'                  => 11,
            'name'                => 'その他',
            'sort_no'             => 11,
            'primary_category_id' => 4,
        ]);

    }
}
