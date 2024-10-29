@extends('admin.dashboard')
@section('title', 'Dashboard')

@section('main_content')
<h1>Dashboard</h1>

<?php
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\User; // Make sure to include this if you are using the User model

// Fetch last month's total earnings
$totalEarningsLastMonth = Order::where('created_at', '>=', now()->subDays(30))
->sum('amount');

// Fetch total number of orders
$totalOrders = Order::count();

// Fetch total number of customers
$totalCustomers = Customer::count();

// Fetch total number of users
$totalUsers = User::count(); // Assuming you have a User model

// Fetch top 10 customers by total amount spent
$topCustomers = DB::table('customers')
    ->select(DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) as full_name"), DB::raw('SUM(orders.amount) as total_spent'))
    ->join('orders', 'customers.id', '=', 'orders.customer_id')
    ->groupBy('customers.id', 'full_name')
    ->orderBy('total_spent', 'desc')
    ->limit(10)
    ->get();

// Fetch top 10 products by quantity sold
$topProducts = DB::table('order_items')
    ->select('product_name', DB::raw('SUM(quantity) as total_sold'))
    ->groupBy('product_name')
    ->orderBy('total_sold', 'desc')
    ->limit(10)
    ->get();

// Fetch last 5 feedbacks
$lastFiveFeedbacks = DB::table('feedback')
    ->orderBy('created_at', 'desc')
    ->limit(5)
    ->get();

// Fetch last 5 reviews
$lastFiveReviews = DB::table('reviews')
    ->orderBy('created_at', 'desc')
    ->limit(5)
    ->get();
?>

<div class="container">
    <div class="row">
        <!-- Last Month's Earnings Widget -->
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Earnings (Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            ${{ number_format($totalEarningsLastMonth, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Customers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalCustomers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <!-- Top 10 Customers Table -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Top 10 Customers by Amount Spent</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Total Spent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topCustomers as $customer)
                                <tr>
                                    <td>{{ $customer->full_name }}</td>
                                    <td>${{ number_format($customer->total_spent, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Top 10 Products Table -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Top 10 Products by Quantity Sold</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity Sold</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topProducts as $product)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->total_sold }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Last 5 Feedbacks Table -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Last 5 Feedbacks</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lastFiveFeedbacks as $feedback)
                                <tr>
                                    <td>{{ $feedback->email }}</td>
                                    <td>{{ $feedback->message }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Last 5 Reviews Table -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Last 5 Reviews</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Product</th>
                                <th>Review</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lastFiveReviews as $review)
                                <tr>
                                    <td>{{ $review->user_id }}</td>
                                    <td>{{ $review->product_id }}</td>
                                    <td>{{ $review->review }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
