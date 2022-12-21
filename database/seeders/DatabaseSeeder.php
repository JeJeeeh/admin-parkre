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
        \App\Models\Vehicle::factory(20)->create();
        \App\Models\Staff::factory(20)->create();
        \App\Models\Mall::factory(20)->create();
        \App\Models\Segmentation::factory(30)->create();
        \App\Models\Announcement::factory(20)->create();
        \App\Models\Reservation::factory(20)->create();
        \App\Models\Transaction::factory(20)->create();
        \App\Models\Review::factory(20)->create();

        // Demo Admin
        DB::table('staffs')->insert([
            'name' => 'Demo Admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'address' => 'Jl. Demo Admin',
            'phone' => '081234567890',
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Demo Staff
        DB::table('staffs')->insert([
            'name' => 'Demo Staff',
            'username' => 'staff',
            'password' => bcrypt('staff'),
            'address' => 'Jl. Demo Staff',
            'phone' => '081234567890',
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Demo Customer
        DB::table('users')->insert([
            'name' => 'Demo Customer',
            'email' => 'customer@mail.com',
            'password' => bcrypt('customer'),
            'address' => 'Jl. Demo Customer',
            'phone' => '081234567890',
            'fcm_token' => 'fcm_token',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
