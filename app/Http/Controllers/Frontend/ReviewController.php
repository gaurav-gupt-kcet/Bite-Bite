<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Submit a review for a product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::check() ? Auth::user()->id : null,
            'name' => $request->name,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending', // Reviews need admin approval
        ]);

        return redirect()->back()->with('success', 'Thank you for your review! It will be visible after approval.');
    }
}
