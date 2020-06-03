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
        $newest = Book::with('genre:id,name')
                    ->select('id','title','photo','genre_id')
                    ->limit(10)
                    ->orderBy("created_at","DESC")
                    ->get();
        $recommended = Book::with('genre:id,name')
                        ->select('id','title','photo','genre_id')
                        ->where('recommended',1)
                        ->orderBy("created_at","DESC")
                        ->get();
        $best_selling = Book::with('genre:id,name')
                        ->select('id','title','photo','genre_id')
                        ->where('best_selling',1)
                        ->orderBy('created_at',"DESC")
                        ->get();
        $authors = Author::select('id','name','avatar')
                    ->orderBy('created_at',"DESC")
                    ->get();
        $subcategories = SubCategory::select('id','name','genre_id','category_name')->get();
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
        $book = Book::where('id',$id)->with("genre:id,name")->first();
        if($book){
            $totalReviews = $book->reviews()->count();
            $topReviews = $book->reviews()->with("user:id,name,avatar")->limit(3)->orderBy("created_at","DESC")->get();
            $data['book'] = $book;
            $data['totalReviews'] = $totalReviews;
            $data['topReviews'] = $topReviews;
            return response()->json($data,200);
        }else{
            $error['status'] = 404;
            $error['message'] = "No book found";
            return response()->json($error,404);
        }
    }

    public function search(Request $request){
        $term = $request->term;
        if(!$term){
            return response()->json(['message'=>"provide a search term"],422);
        }
        $books = Book::where('title',"LIKE","%".$term."%")
                    ->orWhere('author',"LIKE","%".$term."%")
                    ->with('genre:id,name')
                    ->select("id",'title','author','genre_id','photo')
                    ->get();
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
    
    public function allBooks(Request $request){
        $type = $request->type;
        if($type == null){
            return response()->json(['message'=>'provide a type'],422);;
        }
        $books = [];
        switch($type){
            case "author":
                if($request->id == null){
                    return response()->json(['please provide author id'],422);
                }
                $author = Author::where('id',$request->id)->first();
                if($author == null){
                    return response()->json(['author not found'],422);
                }
                $books = $author->books()
                            ->with('genre:id,name')
                            ->select('id','title','author','genre_id','photo')
                            ->get();
            break;
            case "recommended":
                $books = Book::with('genre:id,name')
                            ->where('recommended',1)
                            ->orderBy('created_at',"DESC")
                            ->select('id','title','author','genre_id','photo')
                            ->get();
            break;
            case "best_selling":
                $books = Book::with('genre:id,name')
                            ->where('best_selling',1)
                            ->orderBy('created_at',"DESC")
                            ->select('id','title','author','genre_id','photo')
                            ->get();
            break;
            case 'newest':
                $books = Book::with('genre:id,name')
                            ->select('id','title','author','genre_id','photo')
                            ->orderBy('created_at',"DESC")
                            ->limit(30)
                            ->get();
            break;
        }
        return response()->json($books);
    }
}
