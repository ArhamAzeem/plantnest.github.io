<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Add a product to the cart.
     */
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to add products to the cart.');
        }

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->input('quantity', 1);

        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // Check if the product is already in the cart
        if (isset($cart[$product->id])) {
            // Update quantity and check stock
            $newQuantity = $cart[$product->id]['quantity'] + $quantity;
            if ($newQuantity > $product->stock) {
                return redirect()->back()->with('error', 'Cannot add more than the available stock for this product.');
            }
            $cart[$product->id]['quantity'] = $newQuantity;
        } else {
            // Check stock before adding new product
            if ($quantity > $product->stock) {
                return redirect()->back()->with('error', 'Cannot add more than the available stock for this product.');
            }
            $cart[$product->id] = [
                'product_id' => $product->id, // Ensure product_id is included
                'name' => $product->name,
                'specie' => $product->category->type === 'plant' ? $product->species : null,
                'description' => $product->description,
                'image' => $product->image_path,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    /**
     * Display the cart items.
     */
    public function index()
    {
        $cartItems = session()->get('cart', []);
        
        // Calculate the subtotal
        $subtotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cartItems));

        // Calculate the total with a $30 addition
        $total = $subtotal + 30;

        return view('cart.index', compact('cartItems', 'subtotal', 'total'));
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $product = Product::findOrFail($id);

        if (isset($cart[$id])) {
            // Ensure new quantity does not exceed stock
            $newQuantity = $request->input('quantity');
            if ($newQuantity > $product->stock) {
                return redirect()->route('cart.index')->with('error', 'Quantity exceeds available stock.');
            }
            $cart[$id]['quantity'] = $newQuantity;
            session()->put('cart', $cart);
        } else {
            return redirect()->route('cart.index')->with('error', 'Product not found in the cart.');
        }

        return redirect()->route('cart.index');
    }

    /**
     * Remove a product from the cart.
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        } else {
            return redirect()->route('cart.index')->with('error', 'Product not found in the cart.');
        }

        return redirect()->route('cart.index');
    }
}
