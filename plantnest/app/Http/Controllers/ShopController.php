<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Fetch all products with filters and sorting
    public function index(Request $request)
    {
        $query = Product::query();

        // Search filter
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Price range filter
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
    
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }
    
    // Filter by category
    if ($request->has('category')) {
        $categories = $request->input('category');

        // Apply category filters
        if (in_array('all', $categories)) {
            // Show all products
        } else {
            if (in_array('plant', $categories)) {
                $query->whereHas('category', function($q) {
                    $q->where('type', 'plant');
                });
            }

            if (in_array('accessory', $categories)) {
                $query->whereHas('category', function($q) {
                    $q->where('type', 'accessory');
                });
            }
        }
    }

        // Sub-category filter (category in this case)
        if ($request->has('sub_category')) {
            $query->where('category_id', $request->sub_category);
        }

        // Sorting
        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort == 'name_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($request->sort == 'name_desc') {
                $query->orderBy('name', 'desc');
            }
        }

        // Get filtered and sorted products
        $products = $query->paginate(12);

        // Get all categories for filtering
        $categories = Category::all();

        return view('shop.index', compact('products', 'categories'));
    }

    // Show single product details
    public function show($category, $type, $product)
    {
        $category = Category::where('name', $category)->where('type', $type)->firstOrFail();
        
        // Fetch product along with reviews
        $product = Product::where('name', $product)
            ->where('category_id', $category->id)
            ->with('reviews') // Include reviews
            ->firstOrFail();
        
        $similarProducts = Product::whereHas('category', function ($query) use ($type) {
            $query->where('type', $type);
        })
        ->where('id', '!=', $product->id)
        ->limit(4)
        ->get();
                   
        return view('shop.show', compact('product', 'category', 'similarProducts'));
    }
    
}
