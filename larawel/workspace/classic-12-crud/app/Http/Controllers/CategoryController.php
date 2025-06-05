<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        //$categories = Category::all();
        // $query = Category::query();
        
        //added to show the product count for each category
        // This loads the products count
        $query = Category::withCount('products');
        if (Request()->has("search") && $request->search) {
            $query = $query->where("name", "like", "%" . $request->search . "%");
        }
        $categories = $query->latest()->paginate(5);
        return view("category.category-list", compact("categories"));
    }

    public function create()
    {
       return view("category.create");
    }

    public function store(Request $request){
        $validated = $request->validate([
            "name" => "required | string ",
            "status" => "required",
        ]);
         
        Category::create($validated);
        return redirect()->route("category.index")->with("success","Category created successfully");

    }

    public function show($id){
        // $category = Category::find($id);
        $category = Category::withCount('products')->find($id);
        return view("category.show",compact("category"));
    }

    public function edit($id){
      
      $category = Category::find($id);
      return view("category.edit",compact("category","id"));
    }

    public function update(Request $request,$id){
        $validated = $request->validate([
            "name" => "required | string ",
            "status" => "required",
        ]);
         
        Category::find($id)->update($validated);
        return redirect()->route("category.index")->with("success","Category updated successfully");

    }

    public function destroy($id){
      Category::find($id)->delete();
      return redirect()->route("category.index")->with("success","Category trashed successfully");
        
    }

    public function trashedcategories(Request $request){

        //$categories = Category::onlyTrashed();
        // $query = Category::onlyTrashed();
         $query = Category::onlyTrashed()->withCount('products');
        if(Request()->has("search") && $request->search){
            $query = $query->where("name","like","%".$request->search."%");
        }
        $categories = $query->paginate();
        return view("category.deleted-categories",compact("categories"));
    }

    public function showTrashed($id){
        // $category = Category::onlyTrashed()->findOrFail($id);
        $category = Category::onlyTrashed()->withCount('products')->findOrFail($id);
        return view("category.show-trashed",compact("category"));

    }

    public function restoreCategory($id){
      $category = Category::onlyTrashed()->findOrFail($id);
      $category->restore();
      return redirect()->route('trashed.categories')->with("success","Category restored successfully");
    }

    public function destroyCategory($id){
      $category = Category::onlyTrashed()->findOrFail($id);

      $category->forceDelete();
      return redirect()->route('trashed.categories')->with("success","Category was force deleted successfully");
    }
}
