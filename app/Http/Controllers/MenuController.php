<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // Eager loading to avoid N+1 problem
        $query = Menu::with('category');

        // Filtering by category
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Pagination
        $menus = $query->paginate(10);

        // Load categories for dropdown
        $categories = Category::all();

        return view('menu.menus', compact('menus', 'categories'));
    }
}
