<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Reservation;
use App\Models\Food;
use App\Models\Table;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем тестовые заказы
        $customer = User::where('email', 'customer@restoran.uz')->first();
        $foods = Food::all();
        $tables = Table::all();

        // Создаем 10 случайных заказов за последние 30 дней
        for ($i = 0; $i < 10; $i++) {
            $orderFoods = $foods->random(rand(2, 5));
            $total = 0;
            $orderItems = [];

            foreach ($orderFoods as $food) {
                $quantity = rand(1, 3);
                $total += $food->price * $quantity;
                $orderItems[] = [
                    'food_id' => $food->id,
                    'quantity' => $quantity,
                    'price' => $food->price,
                ];
            }

            $order = Order::create([
                'user_id' => $customer->id,
                'table_id' => rand(0, 1) ? $tables->random()->id : null,
                'total_amount' => $total,
                'status' => collect(['pending', 'processing', 'completed'])->random(),
                'payment_status' => collect(['unpaid', 'paid'])->random(),
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
            ]);

            $order->orderItems()->createMany($orderItems);
        }

        // Создаем тестовые резервации
        for ($i = 0; $i < 15; $i++) {
            Reservation::create([
                'user_id' => $customer->id,
                'table_id' => $tables->random()->id,
                'reservation_date' => Carbon::now()->addDays(rand(0, 14))->format('Y-m-d'),
                'reservation_time' => collect(['10:00', '12:00', '14:00', '16:00', '18:00', '20:00'])->random(),
                'guests_count' => rand(2, 8),
                'status' => collect(['pending', 'confirmed', 'completed', 'cancelled'])->random(),
                'notes' => rand(0, 1) ? 'Birthday celebration' : null,
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
            ]);
        }
    }
}