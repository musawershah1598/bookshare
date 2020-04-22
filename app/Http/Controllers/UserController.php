<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('pages.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        flash("User deleted")->error();
        return redirect()->route('user.index');
    }

    public function search(Request $request){
        $term = $request->search;
        $users = User::where('name','LIKE',"%".$term."%")->orwhere('email',"LIKE","%".$term."%")->get();
        //return response()->json($users);
        if(count($users) > 0){
            $output = "";
            foreach($users as $key=>$user){
                $output.= "<tr>";
                $output.= "<td>".($key+1)."</td>";
                $output.="<td><b>$user->name</b></td>";
                $output.="<td>$user->email</td>";
                if($user->phone){
                    $output.="<td>$user->phone</td>";
                }else{
                    $output.="<td>not found</td>";
                }
                $route = route('user.destroy',[$user->id]);
                $token = csrf_token();
                if($user->role == 'user'){
                $output.=<<<_END
<td>
<form method="POST" action='$route' onsubmit="return confirm('Are you sure you want to delete this user?')">
    <input type="hidden" name="_token" value="$token" />
    <input type="hidden" name="_method" value="DELETE" />
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="far fa-trash-alt"></i> Delete
    </button>
</form>
</td>
_END;
                }else{
                    $output.="<td>Admin</td>";
                }
                $output.= "</tr>";
            }
            return response($output);
        }else{
            return response()->json(['message'=>'not found'],404);
        }
    }
}
