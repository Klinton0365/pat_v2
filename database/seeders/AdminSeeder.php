<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // we still use User model

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create a User for Admin
        $userId = User::insertGetId([
            'first_name' => 'Super',
            'last_name'  => 'Admin',
            'email'      => 'klinton.dev@gmail.com',
            'phone'      => '7339047488',
            'password'   => Hash::make('Notnilk'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert into admins table using DB facade
        DB::table('admins')->insert([
            'user_id'     => $userId,
            'role'        => 'super_admin',
            'is_active'   => true,
            'permissions' => json_encode(['manage_users', 'manage_roles', 'view_reports']),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
