<?php

namespace App\Http\Controllers;

use App\Book;
use App\Genre;
use App\SubCategory;
use App\Author;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('pages.books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        $authors = Author::all();
        return view('pages.books.create',compact('authors','genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>"required|min:3",
            'author_type'=>"required",
            'author'=>"required",
            'isbn'=>"required",
            'genre'=>"required",
            'subcategory'=> "required",
            'no_of_pages'=>"required|numeric",
            "book"=>"required|mimes:pdf,epub",
            'image'=>"required|mimes:jpeg,jpg,png",
            "description"=>"required|min: 10"
        ]);
        $book = new Book;
        $book->title = $request->title;

        $book->author_type = $request->author_type;
        if($request->author_type == 0){
            $book->author = $request->author;
            $book->author_id = 0;
        }else if($request->author_type == 1){
            $author = Author::where('id',$request->author)->first();
            $book->author_id = $author->id;
            $book->author = $author->name;
        }

        $book->description = $request->description;
        $book->isbn = $request->isbn;
        $book->subcategory_id = $request->subcategory;
        $book->user_id = Auth::user()->id;
        $book->pages = $request->no_of_pages;
        // storing book
        $new_name = rand().".".$request->book->extension();
        $genre = Genre::where('id',$request->genre)->first();
        $path = \Storage::putFileAs("public/books/$genre->name/",$request->file('book'),$new_name);
        $book->link = $new_name;
        // storing image
        $new_name = rand().".".$request->image->extension();
        $path = \Storage::putFileAs("public/book_images/$genre->name/",$request->file('image'),$new_name);
        $book->photo = $new_name;
        
        $genre->books()->save($book);
        flash("Book added succesfully")->success();
        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('pages.books.show')->with('book',$book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $genres = Genre::all();
        $authors = Author::all();
        return view('pages.books.edit')->with(['book'=>$book,'genres'=>$genres,'authors'=>$authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(),[
            "title"=>"required|min:3",
            "author"=>"required",
            "isbn"=>"required",
            'genre'=>"required",
            'subcategory'=>"required",
            'no_of_pages'=>"required",
            "description"=>"required|min:10"
        ]);
        $validator->sometimes('book','mimes:pdf,epub',function($input){
            return $input->book != null ? true: false;
        });
        $validator->sometimes('image',"mimes:jpg,jpeg,png",function($input){
            return $input->image != null ? true: false;
        });
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            $beforeBook = clone $book;
            $book->title = $request->title;
            // author
            if($book->author_type == 0){
                $book->author = $request->author;
            }else{
                $author = Author::where('id',$request->author)->first();
                $book->author = $author->name;
                $book->author_id = $author->id;
            }
            
            $book->isbn = $request->isbn;
            if($book->genre_id != $request->genre){
                $genre = Genre::where('id',$request->genre)->first();
                \Storage::move("public/books/".$beforeBook->genre->name."/".$beforeBook->link,"public/books/".$genre->name."/".$book->link);
                \Storage::move("public/book_images/".$beforeBook->genre->name."/".$beforeBook->photo,"public/book_images/".$genre->name."/".$book->photo);
            }
            $book->genre_id = $request->genre;
            $book->subcategory_id = $request->subcategory;
            $book->pages = $request->no_of_pages;
            $book->description = $request->description;
            if($request->exists('book')){
                $new_name = rand().".".$request->book->extension();
                $genre = Genre::where('id',$request->genre)->first();
                \Storage::putFileAs('public/books/'.$genre->name."/",$request->file('book'),$new_name);
                $book->link = $new_name;
                unlink(public_path("storage/books/".$beforeBook->genre->name."/".$beforeBook->link));
            }
            if($request->exists('image')){
                $new_name = rand().".".$request->image->extension();
                $genre = Genre::where('id',$request->genre)->first();
                \Storage::putFileAs("public/book_images/".$genre->name."/",$request->file('image'),$new_name);
                $book->photo = $new_name;
                unlink(public_path("storage/book_images/".$beforeBook->genre->name."/".$beforeBook->photo));
            }
            $book->save();
            flash("Book updated successfully")->warning();
            return redirect()->route('book.show',$book);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        unlink(public_path("storage/books/".$book->genre->name."/".$book->link));
        unlink(public_path("storage/book_images/".$book->genre->name."/".$book->photo));
        $book->delete();
        flash("Book Deleted succesfully")->error();
        return redirect()->back();
    }

    public function search(Request $request){
        $term = $request->search;
        $books = Book::where('title',"LIKE",'%'.$term."%")->orwhere('author','LIKE','%'.$term."%")->get();
        if(count($books) > 0){
            $output = "";
            foreach($books as $key=>$book){
                $showRoute = route('book.show',$book);
                $deleteRoute = route('book.destroy',$book);
                $token = csrf_token();
                $output.="<tr>";
                $output.="<td>.".$book->id."</td>";
                $output.=<<<_END
<td><b>$book->title</b></td>
<td>$book->author</td>
<td>$book->isbn</td>
<td class="text-center">
    <a href="$showRoute" class="btn btn-primary btn-sm">
        <i class="far fa-eye"></i> Show
    </a>
    <form action="$deleteRoute" class="d-inline-block mt-2"
        onsubmit="return confirm('Are you sure want to delete this book?');" method="POST">
        <input type="hidden" name="_token" value="$token" />
        <input type="hidden" name="_method" value="DELETE" />
        <button type="submit" class="btn btn-danger btn-sm">
            <i class="far fa-trash-alt"></i> Delete
        </button>
    </form>
</td>
_END;
            }
            return response($output);
        }else{
            return response()->json(['message'=>'not found'],404);
        }
    }

    public function handleRecommended(Request $request){
        $book = Book::where('id',$request->book_id)->first();
        $book->recommended = $request->val;
        $book->save();
        return response()->json(['working'=>$book->recommended]);
    }
    public function handleBestSelling(Request $request){
        $book = Book::where('id',$request->book_id)->first();
        $book->best_selling = $request->val;
        $book->save();
        return response()->json(['working'=>$book->best_selling]);
    }

    public function recommended(){
        $books = Book::where('recommended',1)->paginate(10);
        return view('pages.books.recommended',compact('books'));
    }

    public function bestselling(){
        $books = Book::where('best_selling',1)->paginate(10);
        return view('pages.books.bestselling',compact('books'));
    }
}
