<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => ['required', 'string', function ($attribute, $value, $fail) {
                $validTypes = ['plant', 'accessory'];
                if (!in_array($value, $validTypes)) {
                    $fail("The $attribute is invalid.");
                }
            }],
        ]);

        DB::table('categories')->insert([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }

        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => ['required', 'string', function ($attribute, $value, $fail) {
                $validTypes = ['plant', 'accessory'];
                if (!in_array($value, $validTypes)) {
                    $fail("The $attribute is invalid.");
                }
            }],
        ]);

        $updated = DB::table('categories')->where('id', $id)->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
        ]);

        if ($updated) {
            return redirect()->route('categories.index')->with('success', 'Category updated successfully');
        } else {
            return redirect()->route('categories.index')->with('error', 'Failed to update category');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleted = DB::table('categories')->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
        } else {
            return redirect()->route('categories.index')->with('error', 'Failed to delete category');
        }
    }
}
