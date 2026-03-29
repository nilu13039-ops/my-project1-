<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Table;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Table::create([
                'name' => 'Masa ' . $i,
                'capacity' => rand(2, 8),
                'location' => rand(0, 1) ? 'Inside' : 'Terrace',
                'status' => 'available',
            ]);
        }
        
        for ($i = 1; $i <= 10; $i++) {
            Table::create([
                'name' => 'VIP ' . $i,
                'capacity' => rand(4, 12),
                'location' => 'VIP Room',
                'status' => 'available',
            ]);
        }
    }
}
