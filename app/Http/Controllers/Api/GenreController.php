<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Genre;
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
            $genre = Genre::where('id',$request->genre_id)->first();
            if($genre){
                $genre['books'] = $genre->books;
                return response()->json(['genre'=>$genre]);
            }else{
                return response()->json(['books'=>[]],404);
            }
        }
    }
}
