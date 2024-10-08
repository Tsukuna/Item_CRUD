<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{

    public function search(Request $request){
        $categories = Category::all();
        $query = $request->input('query');
        $items = Item::where('title','LIKE',"%{$query}%")->get();

        return view('item.index',compact('items','categories'));
    }

    public function searchDetail(Request $request){

        $categories = Category::all();
        $min = $request->input('min');
        $max = $request->input('max');
        $category = $request->input('category_id');

        $items = Item::where('price','>=',$min)
                        ->where('price','<=',$max)
                        ->where('category_id',$category)
                        ->get();

         return view('item.index',compact('items','categories'));

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        $categories = Category::all();
        return view('item.index',compact('items','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('item.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        // return $request;

        if($request->image){
            $file = $request->image;
            $imageName = "item_image" . uniqid() . "." . $file->extension();
            $file->storeAs("public/itemImage",$imageName);
        }


        $item = new Item();
        $item->title = $request->title;
        $item->category_id = $request->category_id;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->description = $request->description;
        $item->image = $imageName;

        $item->save();

        return redirect()->route('item.index')->with('store','Item Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        // return $item;
        $categories = Category::all();
        if($item){
            return view('item.edit',compact('item','categories'));
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        // return $request;


        $item->title = $request->title;
        $item->category_id = $request->category_id;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->description = $request->description;

        /** Important Note updating item */
        if($request->image){
            $file = $request->image;
            $imageName = "item_image" . uniqid() . "." . $file->extension();
            $file->storeAs("public/itemImage",$imageName);
            $item->image = $imageName; /** This is key point */
        }


        $item->update();

        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        if($item){

            $image = $item->image;
            if($image){
                Storage::delete('public/itemImage/'.$image);
            }
            $item->delete();
            return redirect()->back();
        }
    }
}
