<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::latest()->paginate(15);
        $statusCounts = [
            'available' => Table::where('status', 'available')->count(),
            'reserved'  => Table::where('status', 'reserved')->count(),
            'occupied'  => Table::where('status', 'occupied')->count(),
        ];
        return view('admin.tables.index', compact('tables', 'statusCounts'));
    }

    public function create()
    {
        return view('admin.tables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'capacity' => 'required|integer|min:1|max:50',
            'location' => 'nullable|string|max:255',
            'status'   => 'required|in:available,reserved,occupied',
        ]);

        Table::create($request->only('name', 'capacity', 'location', 'status'));

        return redirect()->route('admin.tables.index')->with('success', 'Stol muvaffaqiyatli qo\'shildi!');
    }

    public function show(string $id)
    {
        return redirect()->route('admin.tables.edit', $id);
    }

    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    public function update(Request $request, Table $table)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'capacity' => 'required|integer|min:1|max:50',
            'location' => 'nullable|string|max:255',
            'status'   => 'required|in:available,reserved,occupied',
        ]);

        $table->update($request->only('name', 'capacity', 'location', 'status'));

        return redirect()->route('admin.tables.index')->with('success', 'Stol muvaffaqiyatli yangilandi!');
    }

    public function destroy(Table $table)
    {
        $table->delete();
        return redirect()->route('admin.tables.index')->with('success', 'Stol o\'chirildi!');
    }
}
