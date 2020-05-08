<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Genre;
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
            'genre_id'=>"required"
        ]);

        if($validate->fails()){
            return response()->json(['error'=>"Genre id is required"],422);
        }else{
            $books = Book::where('genre_id',$request->genre_id)->with('genre')->get();
            return response()->json(['books',$books]);
        }
    }
}
