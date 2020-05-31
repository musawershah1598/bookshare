<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Book;
use App\Author;
use App\SubCategory;

class BookController extends Controller
{
    // getting 10 books
    public function getbooks(){
        // $books = Book::with("genre")->limit(10)->get();
        $newest = Book::with('genre')->limit(10)->orderBy("created_at","DESC")->get();
        $recommended = Book::with('genre')->where('recommended',1)->orderBy("created_at","DESC")->get();
        $best_selling = Book::with('genre')->where('best_selling',1)->orderBy('created_at',"DESC")->get();
        $authors = Author::orderBy('created_at',"DESC")->get();
        $subcategories = SubCategory::all();
        $data = [
            'newest'=>$newest,
            'recommended'=>$recommended,
            'best_selling'=>$best_selling,
            'authors'=>$authors,
            'subcategories'=>$subcategories
        ];
        return response()->json($data);
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
	
	public function addview(Request $request){
		$book = Book::where('id',$request->id)->first();
		$book->views = $book->views + 1;
		$book->save();
		return response()->json(['message'=>'working'],200);
	}
	
	public function adddownload(Request $request){
		$book = Book::where('id',$request->id)->first();
		$book->downloads = $book->downloads + 1;
		$book->save();
		return response()->json(['message'=>'working'],200);
	}
}
