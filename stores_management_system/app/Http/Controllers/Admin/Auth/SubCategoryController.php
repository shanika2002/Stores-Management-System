<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function index()
    {
        $category = Category::all(); // Retrieve all categories
        $sub_category = SubCategory::with('category')->get();
        return view('admin.subCategory.index', compact('sub_category'));

    }

    public function create()
    {
        // Retrieve all categories to populate the dropdown
        $category = Category::all();

        return view('admin.subCategory.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'subCategory_id' => 'required|max:255|string',
            'name' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            'category_id' => 'required|exists:category,category_id',
            'is_active' => 'sometimes',
        ]);

        SubCategory::create([
            // 'subCategory_id' => $request -> subCategory_id,
            'name' => $request -> name,
            'description' => $request -> description,
            'category_id' => $request -> category_id,
            'is_active' => $request -> is_active == true ? 1:0,
        ]);

        return redirect('admin/sub_category/create')->with('status','Sub Category Created');

    }

   
    public function edit(int $subCategory_id)
    {
    // Retrieve the subcategory to be edited
    $sub_category = SubCategory::find($subCategory_id);

    if (!$sub_category) {
        return redirect()->back()->with('error', 'SubCategory not found!');
    }

    // Retrieve all categories for the dropdown
    $category = Category::all();

    // Pass both $sub_category and $categories to the view
    return view('admin.subCategory.edit', compact('sub_category', 'category'));
    }


    public function update(Request $request, int $subCategory_id)
    {
        $request->validate([
            //'subCategory_id' => 'required|max:255|string',
            'name' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            'category_id' => 'required|exists:category,category_id',
            'is_active' => 'sometimes',
        ]);

        SubCategory::findOrFail($subCategory_id)->update([
            //'subCategory_id' => $request -> subCategory_id,
            'name' => $request -> name,
            'description' => $request -> description,
            'category_id' => $request -> category_id,
            'is_active' => $request -> is_active == true ? 1:0,
        ]);

        return redirect()->back()->with('status','Sub Category Updated');

    }

   

    public function destroy(int $subCategory_id)
    {
    try {
        $sub_category = SubCategory::findOrFail($subCategory_id); // Find subcategory by ID
        $sub_category->delete(); // Delete subcategory
        return redirect()->back()->with('success', 'Subcategory deleted successfully!');
    } catch (Exception $e) {
        // Log the error and return a failure message
        Log::error('Delete Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to delete subcategory!');
    }
    }

}
