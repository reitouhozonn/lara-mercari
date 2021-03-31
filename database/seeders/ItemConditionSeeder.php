<?php

namespace Database\Seeders;

use App\Models\ItemCondition;
use Illuminate\Database\Seeder;

class ItemConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ItemCondition::factory()->create();
    }
}
