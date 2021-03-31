<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\ItemCondition::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'root',
            'email' => 'hogehoge@example.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make('11111111'),
            ]);
    }
}
