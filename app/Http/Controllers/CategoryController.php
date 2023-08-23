<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        //
       return $category->all();
    }

    public function get_videos_in_categories($category)
    {
       return $cat = Category::find($category)-> video_testimonies;
       return $cat -> video_testimonies;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category;
        $category->categories = $request->categories;
        // get image

        $image =   $request->image;

        $image_extension = $image->extension();
        $path = $image->storeAs('storage', time().'.'.$image_extension);


        $category->image = $path;
        $category->save();
        return response([
            'categories'=> $category
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category)
    {

         $cat =  Category::find($category);


        Storage::delete($cat->image);
        $cat->delete();
        return response([
           'categories'=> $cat .'deleted',
        ]);
    }
}
