<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();
    
        // Regenerate the session to prevent fixation attacks
        $request->session()->regenerate();
    
        // Get the currently logged-in user
        $loggedInUser = $request->user();
        
        // Check if there is any review data in the session
        $reviewData = $request->session()->get('pending_review', null);
    
        // If review data exists, create the review
        if ($reviewData) {
            Review::create([
                'product_id' => $reviewData['product_id'],
                'email' => $loggedInUser->email,
                'rating' => $reviewData['rating'],
                'review' => $reviewData['review'],
                'customer_id' => $loggedInUser->id, // Assign the logged-in user ID as customer_id
            ]);
    
            // Clear the review data from the session
            $request->session()->forget('pending_review');
    
            // Optional: You might want to add a flash message indicating success
            $request->session()->flash('success', 'Review submitted successfully!');
        }
    
        // Admin check and redirect
        if ($loggedInUser->role == 1) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }
    
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
