@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('dist/jquery-filestyle.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/toastr.min.css')}}">
<style>
    #avatar-img {
        width: 6vw;
        height: 6vw;
        margin: 0 auto;
        border-radius: 50%;
        object-fit: contain;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="d-inline-block">Edit Author</h3>
            <a href="{{route('author.index')}}" class="btn btn-primary hvr-shadow float-right">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
            <hr>

            <form action="{{route('author.update',$author)}}" class="mt-3" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <div class="row mt-3">
                    @if($author->avatar)
                    <img src='{{asset("storage/author_images/$author->avatar")}}' alt="user image" id="avatar-img">
                    @else
                    <img src="{{asset("images/not-found.svg")}}" alt="not found image" id="avatar-img">
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">Author Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="enter author name" value="{{$author->name}}">
                        @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="designation">Designation</label>
                        <input type="text" class="form-control @error('designation') is-invalid @enderror"
                            name="designation" placeholder="enter author designation" value="{{$author->designation}}">
                        @error('designation')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="education">Education</label>
                        <input type="text" class="form-control @error('education') is-invalid @enderror"
                            placeholder="enter author education" name="education" value="{{$author->education}}">
                        @error('education')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="enter author email" name="email" value="{{$author->email}}">
                        @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="phone">Phone No</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                            placeholder="enter author phone number" name="phone" value="{{$author->phone}}">
                        @error('phone')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                            placeholder="enter author address" name="address" value="{{$author->address}}">
                        @error('address')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="about">About</label>
                    <textarea name="about" id="about" cols="30" rows="7"
                        class="form-control @error('about') is-invalid @enderror">{{$author->description}}</textarea>
                    @error('about')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="avatar">Profile Image</label>
                        <input type="file" name="avatar" id="avatar" accept="image/*"
                            class="jfilestyle @error('avatar') is-invalid @enderror">
                        @error('avatar')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary hvr-shadow">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('dist/jquery-filestyle.min.js')}}"></script>
<script src="{{asset('dist/toastr.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#avatar").on('change',function(){
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "svg" || ext == "png" || ext == "jpeg" || ext == "jpg")){
                var reader = new FileReader();
                reader.onload = function(e){
                    $("#avatar-img").attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }else{
                var not_found = "{!! asset('images/not-found.svg') !!}"
                $("#avatar-img").attr('src',not_found);
                toastr.error("Invalid file is given as an image",'Error',{
                    timeOut: 4000,
                    positionClass: "toast-bottom-center"
                })
            }
        })
    })
</script>
@endsection