<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Genre;
use App\SubCategory;
use App\Book;
use Validator;

class GenreController extends Controller
{
    public function index(){
        $genres = Genre::all();
        return response()->json($genres);
    }
    public function books(Request $request){
        $validate = Validator::make($request->all(),[
            'category_id'=>"required"
        ]);

        if($validate->fails()){
            return response()->json(['error'=>"category id is required"],422);
        }else{
            $subcategory = SubCategory::where('id',$request->category_id)->first();
            if(!$subcategory){
                return response()->json(['error'=>"category not found"],422);
            }
            $books = $subcategory->books()->select('id','title','author','photo')->get();
            return response()->json($books);
        }
    }
}
