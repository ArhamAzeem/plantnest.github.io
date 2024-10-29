<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.maindashboard'); // Ensure you have 'maindashboard.blade.php' in 'resources/views/admin'
    }
}