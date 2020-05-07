@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('dist/jquery-filestyle.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/toastr.min.css')}}">
<style>
    .avatar {
        border-right: 1px solid #ccc;
        text-align: center;
    }

    #avatar-img {
        width: 10vw;
        height: 10vw;
        border-radius: 50%;
        border: 1px solid #ccc;
    }

    .form-group {
        text-align: left;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card pb-5">
        <div class="card-body">
            <h3 class="d-inline-block">Profile Settings</h3>
            <a href="{{route('home')}}" class="btn btn-sm btn-primary hvr-shadow float-right">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
            <hr>


            <div class="mt-3">
                @include("flash::message")
            </div>

            <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                <div class="row">
                    <div class="col-md-3 avatar">
                        @if($user->avatar)
                        <img src='{{asset("profile_images/$user->avatar")}}' alt="user image" id="avatar-img">
                        @else
                        <img src="{{asset("images/not-found.svg")}}" alt="not found image" id="avatar-img">
                        @endif
                    </div>
                    <div class="col-md-9">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-sm-3 col-form-label">Name</label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" value="{{$user->name}}"
                                            class=" form-control @error('name') is-invalid @enderror"
                                            placeholder="enter your name" name="name">
                                        @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="email" class="col-md-3 col-sm-3 col-form-label">Email</label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" value="{{$user->email}}" class="form-control" name="email"
                                            placeholder="enter email" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="phone" class="col-md-3 col-sm-3 col-form-label">Phone</label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" value="{{$user->phone}}" class="form-control" name="phone"
                                            placeholder="enter phone number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-sm-3 col-form-label">Gender</label>
                                    <div class="col-md-9 col-sm-9">
                                        @if($user->gender == 'male')
                                        <input type="radio" name="gender" value="male" checked="checked"> Male
                                        <input type="radio" name="gender" value="female"> Female
                                        @else
                                        <input type="radio" name="gender" value="male"> Male
                                        <input type="radio" name="gender" value="female" checked="checked"> Female
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="avatar" class="col-md-3 col-sm-3 col-form-label">Choose Avatar</label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="file" name="avatar" id="avatar" class="jfilestyle"
                                            data-input="false" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" form-group float-right">
                    <button class="btn btn-primary hvr-shadow"><i class="far fa-save fa-lg"></i> Save
                        Changes</button>
                </div>
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
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")){
                var reader = new FileReader();
                reader.onload = function(e){
                    $("#avatar-img").attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }else{
                $("#avatar-img").attr('src','/images/not-found.svg');
                toastr.error("Invalid file is given as an image",'Error',{
                    timeOut: 4000,
                    positionClass: "toast-bottom-center"
                })
            }
        })
    })
</script>
@endsection