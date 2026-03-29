<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::with(['foods' => function($q) {
            $q->where('is_available', true);
        }])->get();
        return view('menu', compact('categories'));
    }
}
