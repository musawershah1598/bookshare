<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Book;

class BookController extends Controller
{
    // getting 10 books
    public function getbooks(){
        $books = Book::with("genre")->limit(10)->get();
        if($books){
            return response()->json($books,200);
        }else{
            $error['status'] = 404;
            $error['message'] = "No book found";
            return response()->json($error,404);
        }
    }

    // get a single book
    public function getbook(Request $request){
        $id = $request->id;
        if(!$id){
            $error['status'] = 400;
            $error['message'] = "No id is provided";
            return response()->json($error,400);
        }
        $book = Book::where('id',$id)->with("genre")->first();
        if($book){
            return response()->json($book,200);
        }else{
            $error['status'] = 404;
            $error['message'] = "No book found";
            return response()->json($error,404);
        }
    }

    public function search(Request $request){
        $term = $request->term;
        $books = Book::where('title',"LIKE","%".$term."%")->orWhere('author',"LIKE","%".$term."%")->with('genre')->get();
        if(count($books) > 0){
            return response()->json($books,200);
        }else{
            $error['message'] = "No book or author found";
            return response()->json($error,404);
        }
    }
}
