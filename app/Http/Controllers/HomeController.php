<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredFoods = Food::with('category')
            ->where('is_available', true)
            ->latest()
            ->take(4)
            ->get();

        $categories = Category::withCount(['foods' => fn($q) => $q->where('is_available', true)])
            ->whereHas('foods', fn($q) => $q->where('is_available', true))
            ->take(6)
            ->get();

        return view('home', compact('featuredFoods', 'categories'));
    }
}
