<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\Genre;

class SubCategoryController extends Controller
{
    public function index(){
        $subcategories = SubCategory::paginate(10);
        return view('pages.subcategory.index',compact('subcategories'));
    }

    public function create(){
        $categories = Genre::all();
        return view('pages.subcategory.create',compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>"required",
            'category'=>"required"
        ]);
        $category = Genre::where('id',$request->category)->first();
        if($category){
            $subcategory = new SubCategory;
            $subcategory->name = $request->name;
            $subcategory->category_name = $category->name;
            $category->subcategories()->save($subcategory);
            flash("Sub Category Created Successfully")->success();
            return redirect()->route('subcategory.index');
        }else{
            flash("Sub Category not created")->error();
            return redirect()->route('subcategory.index');
        }
    }

    public function edit(SubCategory $subcategory){
        $categories = Genre::all();
        return view('pages.subcategory.edit',compact('subcategory','categories'));
    }

    public function update(Request $request,SubCategory $subcategory){
        $request->validate([
            'name'=>"required",
            'category'=>"required"
        ]);
        $category = Genre::where('id',$request->category)->first();
        $subcategory->name = $request->name;
        $subcategory->category_name = $category->name;
        $category->subcategories()->save($subcategory);
        flash("Sub Category updated successfully")->warning();
        return redirect()->route('subcategory.index');
    }

    public function delete(SubCategory $subcategory){
        $subcategory->delete();
        flash("Sub category deleted")->error();
        return redirect()->route('subcategory.index');
    }

    public function getsubcategory(Request $request){
        $category = Genre::where('id',$request->catId)->first();
        $subcategories = $category->subcategories()->get();
        $output = "";
        if(count($subcategories) > 0){
            $output .="<option value='' style='background: #ccc;'>Select Sub Category</option>";
            foreach($subcategories as $item){
                $output .= "<option value='".$item->id."'>".$item->name."</option>";
            }
        }else{
            $output .= "<option value=''>No Sub Category found.</option>";
        }
        return response($output);
    }
}
