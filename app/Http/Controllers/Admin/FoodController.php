<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::with('category')->latest()->paginate(10);
        return view('admin.foods.index', compact('foods'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.foods.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'is_available' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['is_available'] = $request->has('is_available') ? true : false;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/foods'), $filename);
            $data['image'] = 'images/foods/' . $filename;
        }

        Food::create($data);
        return redirect()->route('admin.foods.index')->with('success', 'Taom qo\'shildi!');
    }

    public function edit(Food $food)
    {
        $categories = Category::all();
        return view('admin.foods.edit', compact('food', 'categories'));
    }

    public function update(Request $request, Food $food)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'is_available' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['is_available'] = $request->has('is_available') ? true : false;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/foods'), $filename);
            $data['image'] = 'images/foods/' . $filename;
        } else {
            unset($data['image']);
        }

        $food->update($data);
        return redirect()->route('admin.foods.index')->with('success', 'Taom yangilandi!');
    }

    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('admin.foods.index')->with('success', 'Taom o\'chirildi!');
    }
}
