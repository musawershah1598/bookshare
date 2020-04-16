<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Genre;
use App\Review;
use App\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalBooks = Book::count();
        $totalReviews = Review::count();
        $totalGenres = Genre::count();
        $userPerMonth = $this->getUsersPerMonth();
        $bookPerMonth = $this->getBooksPerMonth();
        $fiveUserRecords = User::orderBy('created_at','DESC')->take(5)->get();
        $fiveBookRecords = Book::orderBy('created_at',"DESC")->take(5)->get();
        return view('home',
            compact(
                'totalUsers',
                'totalBooks',
                'totalReviews',
                'totalGenres',
                'userPerMonth',
                'bookPerMonth',
                'fiveUserRecords',
                'fiveBookRecords'
            ));
    }


    private function getUsersPerMonth(){
        $users = User::select('id', 'created_at')
            ->get()
            ->groupBy(function($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($usermcount[$i])){
                $userArr[$i] = $usermcount[$i];    
            }else{
                $userArr[$i] = 0;    
            }
        }
        return array_values($userArr);
    }

    private function getBooksPerMonth(){
        $books = Book::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });
        
        $bookmcount = [];
        $bookArr = [];
        
        foreach ($books as $key => $value) {
            $bookmcount[(int)$key] = count($value);
        }
        
        for($i = 1; $i <= 12; $i++){
            if(!empty($bookmcount[$i])){
                $bookArr[$i] = $bookmcount[$i];    
            }else{
                $bookArr[$i] = 0;    
            }
        }
        return array_values($bookArr);
    }
}
