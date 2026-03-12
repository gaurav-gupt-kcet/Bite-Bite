<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{

public function show($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();
    
    $products = Product::where('category_id', $category->id)->get();

    return view('frontend.category',compact('category','products'));

}

}