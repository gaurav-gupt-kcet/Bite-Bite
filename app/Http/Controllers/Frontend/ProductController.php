<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Review;

class ProductController extends Controller
{

public function home()
{

$products = Product::latest()->get();

$sliders = Slider::where('status', true)->orderBy('order')->get();

$categories = Category::all();

return view('frontend.home',compact('products', 'sliders', 'categories'));

}

public function index()
{

$products = Product::latest()->get();

$categories = Category::all();

return view('frontend.products',compact('products', 'categories'));

}

public function show($id)
{

$product = Product::with('category')->findOrFail($id);

$relatedProducts = Product::where('category_id', $product->category_id)
    ->where('id', '!=', $product->id)
    ->take(4)
    ->get();

$reviews = Review::where('product_id', $id)
    ->where('status', 'approved')
    ->latest()
    ->get();

return view('frontend.product', compact('product', 'relatedProducts', 'reviews'));

}

}