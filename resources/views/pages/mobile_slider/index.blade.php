@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('css/pages/mobile_slider/index.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<style>
    .img-thumbnail {
        height: 5vw;
        width: 5vw;
    }
</style>
@endsection

@section('content')
<div class="container" id="main-container">
    <div class="card">
        <div class="card-body">
            <h3 class="d-inline-block">Mobile Slider Settings</h3>
            <a href="{{route('mobile.slider.create')}}" class="btn btn-primary float-right hvr-shadow">
                <i class="fas fa-plus"></i> Add New Image
            </a>
            <hr>
            @include("flash::message")
            @if(count($images) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach($images as $image)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>
                                <a class="slider-image" href="{{asset('storage/slider_images/'.$image->photo)}}"
                                    data-fancybox data-caption="slider image">
                                    <img src="{{asset('storage/slider_images/'.$image->photo)}}" alt="image"
                                        class="img-thumbnail" />
                                </a>
                            </td>
                            <td>
                                <a href="{{route('mobile.slider.edit',$image->id)}}"
                                    class="btn btn-primary btn-sm hvr-shadow">
                                    <i class="far fa-edit"></i> Show
                                </a>
                                <form action="{{route('mobile.slider.delete',$image->id)}}" class="d-inline-block mt-2"
                                    onsubmit="return confirm('Are you sure want to delete this image?');" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger btn-sm hvr-shadow">
                                        <i class="far fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="not-found">No image added yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $("a.slide-image").fancybox();
    })
</script>
@endsection