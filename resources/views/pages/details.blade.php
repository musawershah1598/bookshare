@extends('layouts.app')

@section('styles')
<style>
    #main-container {
        color: #283267;
    }

    .notFound {
        text-align: center;
    }

    .notFound img {
        width: 50%;
        height: 50%;
    }

    .book-image {
        width: 12vw;
        height: 15vw;
    }

    .table {
        color: #283267;
    }

    .center {
        text-align: center;
    }

    .center img {
        width: 6vw;
        height: 6vw;
    }

    @media only screen and (min-width: 768) {
        .book-image {
            width: 30vw;
            height: 34vw;
        }
    }

    @media only screen and (max-width: 600px) {
        .book-image {
            width: 40vw;
            height: 44vw;
        }

        .center img {
            width: 10vw;
            height: 10vw;
        }
    }
</style>
@endsection

@section('content')
<div class="container" id="main-container">
    <div class="card mb-5">
        <div class="card-body">
            <h3>Book Details</h3>
            <hr>
            @if(isset($book))
            <div class="row">
                <div class="col-md-4">
                    <img src="{{asset("storage/book_images/".$book->genre->name."/$book->photo")}}" alt="book image"
                        class="img-thumbnail book-image">
                </div>
                <div class="col-md-8">
                    <h4>Book Details</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td><strong>Title</strong></td>
                                <td>{{$book->title}}</td>
                                <td><strong>Author</strong></td>
                                <td>{{$book->author}}</td>
                            </tr>
                            <tr>
                                <td><strong>Category</strong></td>
                                <td>{{$book->genre->name}}</td>
                                <td><strong>Sub Category</strong></td>
                                <td>{{$book->subcategory->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>Pages</strong></td>
                                <td>{{$book->pages}}</td>
                                <td><strong>Uploaded At</strong></td>
                                <td>{{$book->created_at->todatestring()}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <div class="center">
                <h1>For More:</h1>
                <a href="#">
                    <img src="{{asset('images/playstore.png')}}" alt="playstore">
                </a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#">
                    <img src="{{asset('images/appstore.png')}}" alt="app store">
                </a>
            </div>
            @else
            <div class="notFound">
                <img src="{{asset('images/page-not-found.png')}}" alt="not found image">
                <h1>Book Not Found</h1>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection