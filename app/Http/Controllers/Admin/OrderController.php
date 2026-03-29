<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Food;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['user', 'table'])->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::where('status', '!=', 'occupied')->get();
        $foods = Food::where('is_available', true)->with('category')->get();
        return view('admin.orders.create', compact('tables', 'foods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'table_id'       => 'nullable|exists:tables,id',
            'payment_status' => 'required|in:unpaid,paid',
            'items'          => 'required|array|min:1',
            'items.*.food_id'  => 'required|exists:foods,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Calculate total from food prices
        $total = 0;
        $itemsToCreate = [];

        foreach ($data['items'] as $item) {
            $food = Food::find($item['food_id']);
            $price = $food->price;
            $quantity = $item['quantity'];
            $total += $price * $quantity;

            $itemsToCreate[] = [
                'food_id'  => $item['food_id'],
                'quantity' => $quantity,
                'price'    => $price,
            ];
        }

        // Create order
        $order = Order::create([
            'table_id'       => $data['table_id'] ?? null,
            'total_amount'   => $total,
            'status'         => 'pending',
            'payment_status' => $data['payment_status'],
        ]);

        // Create order items
        $order->orderItems()->createMany($itemsToCreate);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Zakaz muvaffaqiyatli yaratildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'table', 'orderItems.food']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return redirect()->route('admin.orders.show', $order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status'         => 'sometimes|in:pending,processing,completed,cancelled',
            'payment_status' => 'sometimes|in:unpaid,paid',
        ]);

        $order->update($request->only(['status', 'payment_status']));

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Zakaz yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Zakaz o\'chirildi!');
    }
}
