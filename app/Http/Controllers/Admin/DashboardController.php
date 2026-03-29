<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Table;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $today = Carbon::today();

        $stats = [
            'today_revenue'          => Order::where('payment_status', 'paid')
                                             ->whereDate('created_at', $today)
                                             ->sum('total_amount'),
            'today_orders'           => Order::whereDate('created_at', $today)->count(),
            'today_reservations'     => Reservation::whereDate('reservation_date', $today)->count(),
            'available_tables'       => Table::where('status', 'available')->count(),
            'total_orders'           => Order::count(),
            'pending_orders'         => Order::where('status', 'pending')->count(),
            'processing_orders'      => Order::where('status', 'processing')->count(),
            'total_reservations'     => Reservation::count(),
            'pending_reservations'   => Reservation::where('status', 'pending')->count(),
            'total_users'            => User::where('role_id', 2)->count(),
            'occupied_tables'        => Table::where('status', 'occupied')->count(),
        ];

        $recentOrders = Order::with(['user', 'table'])
            ->latest()
            ->take(5)
            ->get();

        $recentReservations = Reservation::with(['user', 'table'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'recentReservations'));
    }
}
