<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function create()
    {
        $tables = Table::where('status', '!=', 'occupied')->get();
        $foods = Food::with('category')
            ->where('is_available', true)
            ->latest()
            ->take(4)
            ->get();

        return view('order', compact('tables', 'foods'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'table_id' => 'nullable|exists:tables,id',
            'notes' => 'nullable|string|max:1000',
            'cart' => 'required|json',
        ]);

        $cart = json_decode($data['cart'], true);

        if (!is_array($cart) || empty($cart)) {
            throw ValidationException::withMessages([
                'cart' => 'Savat bo\'sh. Avval menyudan taom qo\'shing.',
            ]);
        }

        $itemsToCreate = [];
        $total = 0;

        foreach ($cart as $item) {
            $foodId = $item['id'] ?? $item['food_id'] ?? null;
            $quantity = (int) ($item['qty'] ?? $item['quantity'] ?? 0);

            if (!$foodId || $quantity < 1) {
                throw ValidationException::withMessages([
                    'cart' => 'Savatdagi ma\'lumotlar noto\'g\'ri.',
                ]);
            }

            $food = Food::where('is_available', true)->find($foodId);

            if (!$food) {
                throw ValidationException::withMessages([
                    'cart' => 'Tanlangan taomlardan biri hozircha mavjud emas.',
                ]);
            }

            $price = (float) $food->price;
            $total += $price * $quantity;

            $itemsToCreate[] = [
                'food_id' => $food->id,
                'quantity' => $quantity,
                'price' => $price,
            ];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'table_id' => $data['table_id'] ?? null,
            'total_amount' => $total,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        $order->orderItems()->createMany($itemsToCreate);

        return redirect()
            ->route('order.create')
            ->with('success', 'Zakazingiz qabul qilindi! Oshxona uni tez orada tayyorlashni boshlaydi.')
            ->with('clear_cart', true);
    }
}
