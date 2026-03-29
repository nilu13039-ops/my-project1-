<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create()
    {
        $tables = Table::where('status', 'available')->get();
        return view('reservation', compact('tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'guests_count' => 'required|integer|min:1|max:20',
            'notes' => 'nullable|string',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),
            'table_id' => $request->table_id,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'guests_count' => $request->guests_count,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->route('reservation.create')->with('success', 'Joyingiz muvaffaqiyatli band qilindi! Tez orada siz bilan bog\'lanamiz.');
    }
}
