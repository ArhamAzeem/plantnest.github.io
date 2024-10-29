<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users using a raw SQL query
        $users = DB::select('SELECT * FROM users');
        // Pass users to the view
        return view('admin.users', ['users' => $users]);
    }

    public function destroy($id)
    {
        // Delete the user using a raw SQL query
        DB::delete('DELETE FROM users WHERE id = ?', [$id]);
        // Redirect back with success message
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

}
