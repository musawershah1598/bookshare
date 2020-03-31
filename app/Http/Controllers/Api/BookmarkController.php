<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Bookmarks;
use App\Book;

class BookmarkController extends Controller
{
    public function add(Request $request){
        $validator = Validator::make($request->all(),[
            'book_id'=>"required",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->all(),422);
        }else{
            $user = Auth::user();
            $isPresent = $user->bookmarks()->where('book_id',$request->book_id)->get();
            if(count($isPresent) > 0){
                return response()->json(['message'=>"Book already bookmarked"],400);
            }else{
                $book = Book::where('id',$request->book_id)->first();
                if(!$book){
                    return response()->json(['message'=>"Book not found"],404);
                }else{
                    $bookmark = new Bookmarks;
                    $bookmark->book_id = $request->book_id;
                    $user->bookmarks()->save($bookmark);
                    $success['message'] = "Book added to bookmark";
                    return response()->json($success);
                }
            }
        }
    }

    public function getbookmarks(){
        $user = Auth::user();
        $bookmarks = $user->bookmarks()->with('book')->get();
        return response()->json(['bookmarks'=>$bookmarks]);
    }

    public function removebookmark(Request $request){
        $validator = Validator::make($request->all(),[
            "id"=>"required"
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->all(),422);
        }else{
            $bookmark = Bookmarks::where('id',$request->id)->first();
            if($bookmark){
                $bookmark->delete();
                return response()->json(['message'=>"Bookmark removed."]);
            }else{
                return response()->json(['message'=>"Bookmark not found."],404);
            }
        }
    }
}
