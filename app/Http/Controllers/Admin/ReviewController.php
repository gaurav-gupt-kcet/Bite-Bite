<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display all reviews.
     */
    public function index()
    {
        $reviews = Review::with('product')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.reviews', compact('reviews'));
    }

    /**
     * Update review status.
     */
    public function updateStatus(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->status = $request->status;
        $review->save();

        return redirect('/admin/reviews')->with('success', 'Review status updated!');
    }

    /**
     * Delete review.
     */
    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return redirect('/admin/reviews')->with('success', 'Review deleted!');
    }
}
