<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'name' => "required",
            'email' => "required|email",
            'password' => "required|min:3",
            'confirm_password' => 'required|same:password',
        ]);
        if ($validators->fails()) {
            return response()->json(['error' => $validators->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken("Laravel")->accessToken;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(["email" => $request->get('email'), 'password' => $request->get('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken("Laravel")->accessToken;
			$success['user_id'] = $user->id;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => "Unauthorized access"], 401);
        }
    }

    public function getUser(Request $request)
    {
        $success['user'] = Auth::user();
        return $request->user();
    }
}
