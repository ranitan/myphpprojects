<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //$products=Product::all(); before search functionality is added
        $query = Product::query();
        if(request()->has("search") && $request->search){
            $query = $query->where("name","like","%".$request->search."%")
                        ->orWhere('description','like',"%".$request->search."%");
        }
        //the latest function is in laravel 12 //check appserviceprovider->for boot
        $products = $query->latest()->paginate(5);
        return view('product.product-list', compact('products'));
    }

    public function create()
    {
        //to display the categories in category field dropdown
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string",
            "description" => "nullable|string",
            "price" => "required|numeric",
            "quantity" => "required|numeric",
            "status" => "required",
            "category_id" => "required",
            "image" => "nullable|image|mimes:jpg,png",

        ]);
        if ($request->hasFile("image")) {
            $validated["image"] = $request->file("image")->store("products", "public");
        }
        //to display the created product in the product-list table
        Product::create($validated);

        return redirect()->route("product.index")->with("success", "product added successfully");
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('product.show', compact("product"));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);

        return view('product.edit', compact("product", "categories", "id"));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "required|string",
            "description" => "nullable|string",
            "price" => "required|numeric",
            "quantity" => "required|numeric",
            "status" => "required",
            "category_id" => "required",
            "image" => "nullable|image|mimes:jpg,png",
        ]);

        if ($request->hasFile("image")) {
            if ($request->image && Storage::disk("public")->exists($request->image)) {
                //will delete the present image and update with new img
                Storage::disk("public")->delete($request->image);
            }
            $validated["image"] = $request->file("image")->store("products", "public");
        }

        Product::find($id)->update($validated);

        return redirect()->route("product.index")->with("success", "product updated successfully!");
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route("product.index")->with("success", "product Trashed successfully!");

    }

    public function trashedProducts(Request $request){
        $query = Product::query()->onlyTrashed();
        if(request()->has("search") && $request->search){
            $query = $query->where("name","like","%".$request->search."%")
                        ->orWhere('description','like',"%".$request->search."%");
        }
        $products = $query->paginate(5);
        return view("product.deleted-products",compact("products"));
    }

    public function showTrashed($id){
        $product = Product::onlyTrashed()->findOrFail($id);
        return view("product.show-trashed",compact("product"));
    }

    public function restoreProduct($id){
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route("product.index")->with("success","product restored successfully");
    }

    public function destroyProduct($id){
        $product = Product::onlyTrashed()->findOrFail($id);
        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }
        $product->forceDelete();

        return redirect()->route("product.index")->with("success","product was force deleted successfully!");
    }


}
