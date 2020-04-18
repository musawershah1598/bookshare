@extends('layouts.admin')

@section('styles')
<style>
    img {
        border-radius: 15px;
    }
</style>
@endsection


@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="cover-photo">
                    <img src='{{asset("storage/book_images/".$book->genre->name."/$book->photo")}}'
                        class="img-fluid d-block" />
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3 class="d-inline-block">{{$book->title}}</h3>
                <a href="" class="ml-3 btn btn-primary btn-sm float-right hvr-shadow">
                    <i class="fas fa-angle-double-left"></i> Back
                </a>

                <a href="{{asset("storage/books/".$book->genre->name."/$book->link")}}"
                    class="btn btn-primary btn-sm float-right hvr-shadow" target="_blank">
                    <i class="fas fa-eye"></i> Open PDF
                </a>

                <h5 class="mt-5">Details</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><b>Author</b></td>
                            <td>{{$book->author}}</td>
                            <td><b>Pages</b></td>
                            <td>{{$book->pages}}</td>
                        </tr>
                        <tr>
                            <td><b>ISBN</b></td>
                            <td>{{$book->isbn}}</td>
                            <td><b>Downloads</b></td>
                            <td>{{$book->downloads}}</td>
                        </tr>
                        <tr>
                            <td><b>Category</b></td>
                            <td>{{$book->genre->name}}</td>
                            <td><b>Views</b></td>
                            <td>{{$book->views}}</td>
                        </tr>
                    </tbody>
                </table>

                <p class="mt-4">Description</p>
                <p class="text-muted">{{$book->description}}</p>
            </div>
        </div>
    </div>
</div>
@endsection