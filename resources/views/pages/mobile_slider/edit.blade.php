@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('dist/jquery-filestyle.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/toastr.min.css')}}">
<script src="{{asset('dist/toastr.min.js')}}"></script>
<style>
    #main-content .card {
        min-height: 50vh;
    }

    #slider-image {
        width: 10vw;
        border-radius: 15px;
    }
</style>
@endsection

@section('content')
<div class="container" id="main-content">
    <div class="card">
        <div class="card-body">
            <h3 class="d-inline-block">Edit Image</h3>
            <a href="" class="btn btn-primary float-right hvr-shadow">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
            <hr>

            <form action="{{route('mobile.slider.update',$image->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="image">Browse Image</label><br>
                    <input type="file" class="jfilestyle @error('image') is-invalid @enderror" name="image" id="image"
                        accept="image/*">
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <img src="{{asset('storage/slider_images/'.$image->photo)}}" alt="uploaded image"
                        class="slider-image" id="slider-image">
                </div>
                <button class="btn btn-primary hvr-shadow" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('dist/jquery-filestyle.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#image").on('change',function(){
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")){
                var reader = new FileReader();
                reader.onload = function(e){
                    $("#slider-image").attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }else{
                var not_found = "{!! asset('storage/slider_images/'.$image->photo) !!}"
                $("#slider-image").attr('src',not_found);
                toastr.error("Invalid file is given as an image",'Error',{
                    timeOut: 4000,
                    positionClass: "toast-bottom-center"
                })
            }
        })
    })
</script>
@endsection