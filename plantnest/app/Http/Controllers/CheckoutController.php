<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    // Display the checkout form
    public function showCheckoutForm()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Please log in to proceed with the checkout.');
        }

        $cartItems = Session::get('cart', []);
        $subTotal = array_sum(array_column($cartItems, 'price'));
        $total = $subTotal;

        return view('checkout.form', compact('cartItems', 'subTotal', 'total'));
    }

    // Place the order
    public function placeOrder(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Please log in to place an order.');
        }

        // Validate request data
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'regex:/^[A-Za-z]+$/', 'max:255'],
            'last_name' => ['required', 'string', 'regex:/^[A-Za-z]+$/', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'regex:/^\S+@\S+\.\S+$/'],
            'phone' => ['required', 'string', 'regex:/^\+?[0-9]{10,20}$/'],
            'street_address' => 'required|string|max:255',
            'city' => ['required', 'string', 'regex:/^[A-Za-z]+$/', 'max:255'],
            'state' => ['required', 'string', 'regex:/^[A-Za-z]+$/', 'max:255'],
            'country' => ['required', 'string', 'regex:/^[A-Za-z]+$/', 'max:255'],
            'postal_code' => 'required|string|max:10',
            'payment_method' => 'required|in:cash on delivery,card payment',
        ]);

        if ($request->payment_method === 'card payment') {
            $request->validate([
                'card_number' => ['required', 'regex:/^[0-9]{16}$/'],
                'cvv' => ['required', 'regex:/^[0-9]{3}$/'],
                'expiry_date' => 'required|date_format:Y-m',
            ]);
        }

        $user = Auth::user();
        $cartItems = session()->get('cart', []);

        // Ensure all products exist and are in stock
        foreach ($cartItems as $item) {
            if (!isset($item['product_id']) || !isset($item['quantity'])) {
                Log::error('Cart item missing product_id or quantity.', $item);
                return redirect()->route('checkout.form')
                    ->withErrors('There is an issue with the cart item data. Please review your cart.')
                    ->withInput();
            }

            $product = Product::find($item['product_id']);
            if (!$product) {
                Log::error('Product not found for cart item.', ['product_id' => $item['product_id']]);
                return redirect()->route('checkout.form')
                    ->withErrors('Product not found. Please review your cart.')
                    ->withInput();
            }
        }

        // Create or update customer record
        $customer = Customer::updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'street_address' => $request->street_address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'postal_code' => $request->postal_code,
            ]
        );

        $totalAmount = array_sum(array_column($cartItems, 'price'));

        // Create order
        $order = Order::create([
            'order_number' => Str::random(10),
            'customer_id' => $customer->id,
            'user_id' => $user->id,
            'amount' => $totalAmount,
            'payment_status' => $request->payment_method === 'cash on delivery' ? 'pending' : 'paid',
            'delivery_status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);

        // Add items to order and update product stock
        foreach ($cartItems as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_name' => $product->name,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Update stock
                $product->decrement('stock', $item['quantity']);
            } else {
                Log::error('Failed to find product while creating order item.', ['product_id' => $item['product_id']]);
            }
        }

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('checkout.thank-you', ['orderNumber' => $order->order_number]);
    }
}
