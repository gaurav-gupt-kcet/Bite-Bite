<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

public function index()
{
    $categories = Category::all();
    return view('admin.categories', compact('categories'));
}

public function create()
{
    return view('admin.add-category');
}

public function store(Request $request)
{
    Category::create([
        'name' => $request->name
    ]);

    return redirect('/admin/categories');
}

public function edit($id)
{
    $category = Category::findOrFail($id);
    return view('admin.edit-category', compact('category'));
}

public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);
    $category->name = $request->name;
    $category->save();
    
    return redirect('/admin/categories');
}

public function destroy($id)
{
    $category = Category::findOrFail($id);
    $category->delete();
    
    return redirect('/admin/categories');
}

}