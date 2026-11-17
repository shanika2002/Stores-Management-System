<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::get();
        return view('admin.category.index',compact('category'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            'is_active' => 'sometimes',
        ]);

        Category::create([
            'name' => $request -> name,
            'description' => $request -> description,
            'is_active' => $request -> is_active == true ? 1:0,
        ]);

        return redirect('admin/category/create')->with('status','Category Created');

    }

    public function edit(int $id)
    {
        $category = Category::findOrFail($id);
        //return $category;
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            'is_active' => 'sometimes',
        ]);

        Category::findOrFail($id)->update([
            'name' => $request -> name,
            'description' => $request -> description,
            'is_active' => $request -> is_active == true ? 1:0,
        ]);

        return redirect()->back()->with('status','Category Updated');

    }

    public function destroy(int $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('status','Category Deleted');

    }
}
