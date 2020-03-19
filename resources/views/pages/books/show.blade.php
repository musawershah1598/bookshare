@extends('layouts.app')

@section('styles')
<style>
    #book-details .card {
        width: 70%;
        border-radius: 15px !important;
        margin: 0 auto;
    }
</style>
@endsection


@section('content')
<div class="container-fluid py-5">
    <h1 class="display-5">Book Details</h1>
    <a href="{{route('book.index')}}">Go back?</a>

    <div class="container-fluid" id='book-details'>
        <div class="card">
            <div class="card-body">
                @include("flash::message")
                <h3>{{$book->title}}</h3>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>Author: <span class="text-muted">{{$book->author}}</span></p>
                        <p class="mb-0">Pages: <span class="text-muted">{{$book->pages}}</span></p>
                        <p class="mb-0">Views: <span class="text-muted">{{$book->views}}</span></p>
                        <p>Downloads: <span class="text-muted">{{$book->downloads}}</span></p>
                    </div>
                    <div class="col-md-4 cover-photo">
                        <h5>Cover Photo</h5>
                        <img src='{{asset("storage/book_images/".$book->genre->name."/$book->photo")}}'
                            class="img-fluid d-block" />
                        <a href="{{asset("storage/books/".$book->genre->name."/$book->link")}}" class="mt-3">View
                            Link</a>
                    </div>
                </div>

                <p class="mt-4">Description</p>
                <p class="text-muted">{{$book->description}}</p>
                <hr>
                <a href="{{route('book.edit',$book)}}" class="btn btn-outline-warning">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection
