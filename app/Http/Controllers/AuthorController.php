<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::paginate(10);
        return view('pages.author.index')->with('authors',$authors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'name'=>"required|min:3",
            "designation"=>"required",
            "education"=>"required",
            "email"=>"required|email",
            "phone"=>"required",
            "address"=>"required",
            "about"=>"required|min: 10",
        ]);
        $validator->sometimes('avatar',"mimes:jpeg,png,svg,jpg",function($input){
            return $input->avatar != null ? true:false;
        });
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $author = new Author;
        $author->name = $request->name;
        $author->designation = $request->designation;
        $author->education = $request->education;
        $author->email = $request->email;
        $author->phone = $request->phone;
        $author->address = $request->address;
        $author->description = $request->about;
        
        if($request->avatar){
            $avatarName = rand().".".$request->avatar->extension();
            $path = \Storage::putFileAs("public/author_images/",$request->file('avatar'),$avatarName);
            $author->avatar = $avatarName;
        }else{
            $avatarName = rand()."."."svg";
            $notFound = public_path("images/not-found.svg");
            $path = \Storage::putFileAs("public/author_images/",$notFound,$avatarName);
            $author->avatar = $avatarName;
        }
        $author->save();
        flash("Author created successfully")->success();
        return redirect()->route('author.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('pages.author.edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $validator = \Validator::make($request->all(),[
            'name'=>"required|min:3",
            "designation"=>"required",
            "education"=>"required",
            "email"=>"required|email",
            "phone"=>"required",
            "address"=>"required",
            "about"=>"required|min: 10",
        ]);
        $validator->sometimes('avatar',"mimes:jpeg,jpg,png,svg",function($input){
            return $input->avatar != null ? true: false;
        });

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{
            $author->name = $request->name;
            $author->designation = $request->designation;
            $author->education = $request->education;
            $author->email = $request->email;
            $author->phone = $request->phone;
            $author->address = $request->address;
            $author->description = $request->about;
            // avatar
            if($request->exists('avatar')){
                $new_name = rand().".".$request->avatar->extension();
                $path = \Storage::putFileAs("public/author_images/",$request->file('avatar'),$new_name);
                unlink(public_path("storage/author_images/".$author->avatar));
                $author->avatar = $new_name;
            }

            $author->save();
            flash("Author updated successfully")->warning();
            return redirect()->route('author.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        flash("Author deleted successfully")->error();
        return redirect()->route("author.index");
    }
}
