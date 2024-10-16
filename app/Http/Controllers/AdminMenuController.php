<?php

// app/Http/Controllers/AdminMenuController.php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $categories = Category::all();
        return view('admin.dashboard', compact('menus', 'categories')); 
    }

    public function edit(Menu $menu)
    {
        $menus = Menu::all();
        $categories = Category::all();
        return view('admin.dashboard', compact('menu', 'menus', 'categories')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        Menu::create($request->all());
        return redirect()->route('admin.menus.index');
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        $menu->update($request->all());
    
        return redirect()->route('admin.menus.index')->with('success', 'Menu updated successfully');
    }
    

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index');
    }
}
