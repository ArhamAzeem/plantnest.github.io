<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Fetch up to 4 products for the category type 'Plant'
        $plantProducts = Product::whereHas('category', function($query) {
            $query->where('type', 'Plant');
        })
        ->limit(4)
        ->get();
    
        // Fetch up to 4 products for the category type 'Accessory'
        $accessoryProducts = Product::whereHas('category', function($query) {
            $query->where('type', 'Accessory');
        })
        ->limit(4)
        ->get();
    
        // Return the view with both product collections
        return view('home', compact('plantProducts', 'accessoryProducts'));
    }    
}
