<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        // Fetch reviews with their related product data
        $reviews = Review::with('product')->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function store(Request $request, $productId)
    {
        if (!Auth::check()) {
            // Store the intended review data in the session
            $request->session()->put('review_data', [
                'product_id' => $productId,
                'rating' => $request->input('rating'),
                'review' => $request->input('review'),
            ]);
    
            return redirect()->route('login')->with('info', 'Please log in to submit your review.');
        }
    
        // If user is logged in, create the review
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);
    
        Review::create([
            'product_id' => $productId,
            'user_id' => Auth::id(), // Make sure the user_id column exists in your reviews table
            'rating' => $request->input('rating'),
            'review' => $request->input('review'),
        ]);
    
        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    public function destroy(Review $review)
    {
        // Ensure the review belongs to the user if needed (e.g., authorization check)
        if (Auth::check() && Auth::id() === $review->user_id) {
            $review->delete();
            return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
        }
        
        return redirect()->route('admin.reviews.index')->with('error', 'Unauthorized action.');
    }
}
