<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->where('status', 1)->where('is_parent', 0)->get();
        return view('backend.pages.categories.manage', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = Category::orderBy('name', 'asc')->where('is_parent', 0)->get();
        return view('backend.pages.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category;

        $category->name          = $request->name;
        $category->description   = $request->description;
        $category->is_parent     = $request->is_parent;
        $category->status        = $request->status;

        // dd($brand);
        // exit();
        $category->save();
        $notification = array (
            'message' => 'Category Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('category.manage')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function trash()
    {
        $categories = Category::orderBy('name', 'asc')->where('status', 0)->get();
        return view('backend.pages.categories.trash', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if( !is_null( $category ) ) {
            $parentCategories = Category::orderBy('name', 'asc')->where('is_parent', 0)->get();
            return view('backend.pages.categories.edit', compact('parentCategories', 'category'));
        }
        else {
            // 404 Page not Found
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if( !is_null( $category ) ) {
            $category->name          = $request->name;
            $category->description   = $request->description;
            $category->is_parent     = $request->is_parent;
            $category->status        = $request->status;

            // dd($brand);
            // exit();
            $category->save();
            $notification = array (
                'message' => 'Category Information Updated!',
                'alert-type' => 'info',
            );
            return redirect()->route('category.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if( !is_null( $category ) ) {
            // Image Deleted

            // Content Deleted
            // $brand->delete();

            // Soft Deleted
            $category->status = 0;
            $category->save();
            $notification = array (
                'message' => 'Category Removed!',
                'alert-type' => 'error',
            );
            return redirect()->route('category.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }
}
