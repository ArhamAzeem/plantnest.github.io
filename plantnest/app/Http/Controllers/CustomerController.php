<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Display a list of customers
    public function index()
    {
        $customers = Customer::paginate(10); // Adjust the number to the desired per-page value
        return view('admin.customers.index', compact('customers'));
    }

    // Show details of a specific customer
    public function show($id)
    {
        $customer = Customer::findOrFail($id); // Fetch the customer by ID
        return view('admin.customers.show', compact('customer'));
    }

    // Delete a specific customer
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully');
    }
}
