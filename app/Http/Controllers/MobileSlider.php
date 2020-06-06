<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MobileSlider extends Controller
{
    public function index(){
        $images = DB::table("mobile_image_slider")->get();
        return view('pages.mobile_slider.index')->with('images',$images);
    }

    public function create(){
        return view('pages.mobile_slider.create');
    }
    public function store(Request $request){
        $request->validate([
            'image'=>"required|mimes:jpeg,jpg,png"
        ]);

        $new_name = rand().".".$request->image->extension();
        $path = \Storage::putFileAs("public/slider_images/",$request->file('image'),$new_name);
        $image = DB::table('mobile_image_slider')->insert(
            ['photo'=>$new_name]
        );
        flash("Image added successfully")->success();
        return redirect()->route('mobile.slider');
    }

    public function edit($id){
        $image = DB::table('mobile_image_slider')->where('id',$id)->first();
        return view('pages.mobile_slider.edit')->with('image',$image);
    }

    public function update(Request $request,$id){
        $request->validate([
            'image'=>"required|mimes:jpeg,jpg,png"
        ]);
        $image = DB::table('mobile_image_slider')->where('id',$id)->first();
        $new_name = rand().".".$request->image->extension();
        unlink(public_path("storage/slider_images/".$image->photo));
        \Storage::putFileAs("public/slider_images/",$request->file('image'),$new_name);
        DB::table('mobile_image_slider')->where('id',$id)->update([
            'photo'=>$new_name
        ]);
        flash("Image updated successfully")->warning();
        return redirect()->route('mobile.slider');
    }

    public function delete($id){
        DB::table('mobile_image_slider')->where('id',$id)->delete();
        flash("Image deleted")->error();
        return redirect()->route('mobile.slider');
    }
}
