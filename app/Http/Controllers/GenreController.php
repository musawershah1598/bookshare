<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::paginate(10);
        return view('pages.genre.index')->with('genres',$genres);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.genre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name'=>"required",
            'description'=>"required|min: 10"
        ]);

        $genre = Genre::create($request->all());
        flash("Genre Created succesfully")->success();
        return redirect()->route('genre.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        $books = $genre->books()->paginate(10);
        return view('pages.genre.show',compact('genre','books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        flash("Genre Deleted succesfully")->error();
        return redirect()->route('genre.index');
    }

    public function search(Request $request){
        $term = $request->search;
        $genres = Genre::where('name',"LIKE",'%'.$term."%")->get();
        if(count($genres) > 0){
            $output = "";
            foreach($genres as $key=>$genre){
                $showRoute = route('genre.show',$genre);
                $deleteRoute = route('genre.destroy',$genre);
                $token = csrf_token();
                $output.="<tr>";
                $output.="<td>".($key + 1)."</td>";
                $output.= <<<_END
<td><b>$genre->name</b></td>
<td class="text-center">
    <a href="$showRoute" class="btn btn-primary hvr-shadow btn-sm"> <i
    class="far fa-eye"></i>
    <span>Show</span></a>
    <form method="POST" action="$deleteRoute" class="d-inline-block mt-2" onsubmit="return confirm('Are you sure want to delete this genre?')">
        <input type="hidden" name="_token" value="$token" />
        <input type="hidden" name="_method" value="DELETE" />
        <button type="submit" class="btn btn-danger btn-sm hvr-shadow">
            <i class="far fa-trash-alt"></i> Delete
        </button>
    </form>
</td>
_END;
            return response($output);
            }
        }else{
            return response()->json(['message'=>'not found'],404);
        }
    }
}
