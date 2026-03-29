<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $customerRole = Role::create(['name' => 'customer']);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@restoran.uz',
            'password' => Hash::make('admin123'),
            'role_id' => $adminRole->id,
            'phone' => '+998901234567',
        ]);
        
        User::create([
            'name' => 'Test Customer',
            'email' => 'customer@restoran.uz',
            'password' => Hash::make('customer123'),
            'role_id' => $customerRole->id,
            'phone' => '+998901234568',
        ]);
    }
}
