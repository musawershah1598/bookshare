@extends('layouts.app')

@section('styles')
<style>
    .card {
        height: 25vh;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Add New Book</h3>
                    <p>Here you can add a new book</p>
                    <a href="{{route('book.create')}}">Click here</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>All Books</h3>
                    <p>Here you can handle all the books that are uploaded.</p>
                    <a href="{{route('book.index')}}">Click here</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>All Users</h3>
                    <p>Here you can handle all the users.</p>
                    <a href="">Click here</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Create New Genre</h3>
                    <p>Here you can create a new genre of books</p>
                    <a href="{{route('genre.create')}}">Click here</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>All Genre</h3>
                    <p>Here you can handle all the genres.</p>
                    <a href="{{route('genre.index')}}">Click here</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
