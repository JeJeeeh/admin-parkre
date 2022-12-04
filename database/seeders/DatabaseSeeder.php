<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'onsite', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'customer service', 'created_at' => now(), 'updated_at' => now()],
        ]);

        \App\Models\User::factory(20)->create();
        \App\Models\Staff::factory(20)->create();
        \App\Models\Mall::factory(20)->create();
        \App\Models\Segmentation::factory(30)->create();
        \App\Models\Announcement::factory(20)->create();
        \App\Models\Reservation::factory(20)->create();
        \App\Models\Transaction::factory(20)->create();
        \App\Models\Review::factory(20)->create();
    }
}
