<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.manage_category', compact('categories'));
    }

    public function create()
    {
        return view('admin.add_category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_image' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        
        if ($request->hasFile('category_image')) {
            $file = $request->file('category_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/categories'), $filename);
            $category->category_image = 'upload/categories/' . $filename;
        }

        $category->status = $request->status ?? 'active';
        $category->save();

        Alert::success('Success', 'Category added successfully.');
        return redirect('/manage_category');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.edit_category', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required',
            'category_image' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $category->category_name = $request->category_name;
        
        if ($request->hasFile('category_image')) {
            // Delete old image if exists
            if ($category->category_image && file_exists(public_path($category->category_image))) {
                unlink(public_path($category->category_image));
            }

            $file = $request->file('category_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/categories'), $filename);
            $category->category_image = 'upload/categories/' . $filename;
        }

        $category->status = $request->status ?? 'active';
        $category->save();

        Alert::success('Success', 'Category updated successfully.');
        return redirect('/manage_category');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Delete image if exists
        if ($category->category_image && file_exists(public_path($category->category_image))) {
            unlink(public_path($category->category_image));
        }
        
        $category->delete();

        Alert::success('Success', 'Category deleted successfully.');
        return redirect('/manage_category');
    }
}
