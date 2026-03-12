<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.sliders', compact('sliders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.add-slider', compact('products'));
    }

    public function store(Request $request)
    {
        $image = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $image,
            'product_id' => $request->product_id,
            'link' => $request->link,
            'order' => $request->order ?? 0,
            'status' => $request->status ?? true
        ]);

        return redirect('/admin/sliders');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $products = Product::all();
        return view('admin.edit-slider', compact('slider', 'products'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('sliders', 'public');
            $slider->image = $image;
        }

        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->product_id = $request->product_id;
        $slider->link = $request->link;
        $slider->order = $request->order ?? 0;
        $slider->status = $request->status ?? true;
        $slider->save();

        return redirect('/admin/sliders');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();

        return redirect('/admin/sliders');
    }
}
