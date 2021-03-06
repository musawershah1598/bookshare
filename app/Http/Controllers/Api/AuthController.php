<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Storage;
use File;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'name' => "required",
            'email' => "required|email|unique:users,email",
            'password' => "required|min:3",
            'confirm_password' => 'required|same:password',
        ]);
        if ($validators->fails()) {
            return response()->json($validators->errors()->all(), 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        \Mail::to($user->email)->send(new \App\Mail\MobileEmailVerification($user));
        $success['token'] = $user->createToken("Laravel")->accessToken;
        $success['message']="Account Created Successfully";
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function login(Request $request)
    {
        $validators = Validator::make($request->all(),[
            'email'=>"required|email",
            "password"=>"required"
        ]);
        if($validators->fails()){
            return response()->json($validators->errors()->all(),400);
        }
        if (Auth::attempt(["email" => $request->get('email'), 'password' => $request->get('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken("Laravel")->accessToken;
			$success['user_id'] = $user->id;
            return response()->json($success, $this->successStatus);
        } else {
            return response()->json(['error' => "Unauthorized access"], 401);
        }
    }

    public function resendEmail(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => "required|email"
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->all(),422);
        }else{
            $user = User::where('email',$request->email)->first();
            if(!$user){
                return response()->json(['message'=>"User not found"],404);
            }else{
                if($user->email_verified_at){
                    return response()->json(['message'=>"Email Already verified"],400);
                }else{
                    \Mail::to($user->email)->send(new \App\Mail\MobileEmailVerification($user));
                    return response()->json(['message'=>"Email Resend Successfully"]);
                }
            }
        }
    }

    public function verify(Request $request){
        $token = $request->token;
        $user = User::where('id',$token)->first();
        if($user){
            if($user->email_verified_at){
                $message = 'Email already verified';
                $status = 422;
                return view('pages.misc.error',compact('message','status'));
            }else{
                $user->email_verified_at = date("Y-m-d H:i:s");
                $user->save();
                $message = "Email Verified Successfully";
                $status = 200;
                return view('pages.misc.error',compact('message','status'));
            }
        }else{
            $message = 'User not found';
            $status = 404;
            return view('pages.misc.error',compact('message','status'));
        }
    }

    public function getUser(Request $request)
    {
        $success['user'] = Auth::user();
        return $request->user();
    }

    public function updateUser(Request $request){
        $validators = Validator::make($request->all(),[
            "user_id"=>"required",
            "name"=>"required|min:3",
            "email"=>"required|email",
            "phone"=>"required",
            "gender"=>"required"
        ]);
        if($validators->fails()){
            return response()->json($validators->errors()->all(),422);
        }else{
            $user = User::find($request->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->save();
            $success['message'] = "Details Updated Successfully";
            return response()->json($success,200);
        }
    }

    public function uploadimage(Request $request){
        $validation = Validator::make($request->all(),[
            'user_id'=>'required',
            'image'=>"required"
        ]);
        if($validation->fails()){
            return response()->json($validation->errors()->all(),422);
        }else{
            $user = User::where('id',$request->get('user_id'))->first();
            if($user->avatar){
                if(is_file(public_path("/profile_images/".$user->avatar))){
                    unlink(public_path("/profile_images/".$user->avatar));
                }
            }
            $file = $request->image;
            $new_name = rand()."."."jpg";
            File::put(public_path("/profile_images/").$new_name,\file_get_contents($file));
            $user->avatar = $new_name;
            $user->save();
            $success['message'] = "Profile image updated successfully";
            $success['url'] = public_path("/profile_images/".$user->avatar);
            return response()->json($success,200);
        }
    }


}
