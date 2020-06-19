<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class WelcomeController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function details($id){
        $book = Book::where('id',$id)->first();
        return view('pages.details')->with('book',$book);
    }
}
