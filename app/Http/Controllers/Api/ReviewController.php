<?php

namespace App\Http\Controllers\Api;
use App\Review;
use App\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

class ReviewController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'content'=>"required|min: 5",
            'stars'=>"required",
            "book_id"=>"required"
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->all(),422);
        }else{
            $user = Auth::user();
            $book = Book::where('id',$request->book_id)->first();
            $review = new Review;
            $review->content = $request->content;
            $review->rating = $request->stars;
            $review->user_id = $user->id;
            if($book){
                $book->reviews()->save($review);
                $success['message'] = "Review added successfully";
                return response()->json($success);
            }else{
                $success['message'] = "Book not found";
                return response()->json($success,404);
            }
        }
    }

    public function getReviews(Request $request){
        $book = Book::where('id',$request->book_id)->with('user')->first();
        if($book){
            $reviews = $book->reviews()->get();
            return response()->json(['reviews'=>$reviews]);
        }else{
            $success['message'] = "No book found";
            return response()->json($success,404);
        }
    }
}
