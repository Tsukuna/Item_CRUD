<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function search(Request $request){

        $query = $request->input('query');
        $categories = Category::where('name','LIKE',"%{$query}%")->paginate(3);
        return view('category.index',compact('categories'));
    }



    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $categories = Category::paginate(3);
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // return $request;
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('category.index')->with('success','Stored Successfully!');
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

        if($category){
            return view('category.create',compact('category'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->description = $request->description;
        $category->update();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category){
            $category->delete();

        }
        return redirect()->back();

    }
}
