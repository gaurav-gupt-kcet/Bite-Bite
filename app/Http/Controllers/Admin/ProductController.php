<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{

public function index(){

$products = Product::with('category')->get();

return view('admin.products',compact('products'));

}

public function create(){

$categories = Category::all();

return view('admin.add-product',compact('categories'));

}

public function store(Request $request){

$image = $request->file('image')->store('products','public');

Product::create([

'name'=>$request->name,
'description'=>$request->description,
'price'=>$request->price,
'image'=>$image,
'category_id'=>$request->category_id

]);

return redirect('/admin/products');

}

public function edit($id){
    
    $product = Product::findOrFail($id);
    $categories = Category::all();
    
    return view('admin.edit-product', compact('product', 'categories'));
    
}

public function update(Request $request, $id){
    
    $product = Product::findOrFail($id);
    
    if($request->hasFile('image')){
        $image = $request->file('image')->store('products','public');
        $product->image = $image;
    }
    
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->category_id = $request->category_id;
    $product->save();
    
    return redirect('/admin/products');
    
}

public function destroy($id){
    
    $product = Product::findOrFail($id);
    $product->delete();
    
    return redirect('/admin/products');
    
}

}