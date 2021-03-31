<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();


        DB::table('users')->insert([
            'name' => 'root',
            'email' => 'hogehoge@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'),
        ]);
        // factory(App\User::class, 10)->create();
        
    }
}
