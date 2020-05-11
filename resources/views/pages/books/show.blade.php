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
                <a href="{{route('book.index')}}" class="ml-3 btn btn-primary btn-sm float-right hvr-shadow">
                    <i class="fas fa-angle-double-left"></i> Back
                </a>

                {{-- <a href="{{asset("storage/books/".$book->genre->name."/$book->link")}}"
                class="btn btn-primary btn-sm float-right hvr-shadow" target="_parent" download="{{$book->title}}">
                <i class="fas fa-eye"></i> Open PDF
                </a> --}}
                <button class="btn btn-primary btn-sm hvr-shadow float-right" data-toggle="modal"
                    data-target="#myModal">
                    <i class="far fa-eye"></i> Show
                </button>

                <h5 class="mt-5">Details</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><b>Author</b></td>
                            <td>{{$book->author}}</td>
                            <td><b>ISBN</b></td>
                            <td>{{$book->isbn}}</td>

                        </tr>
                        <tr>
                            <td><b>Pages</b></td>
                            <td>{{$book->pages}}</td>
                            <td><b>Downloads</b></td>
                            <td>{{$book->downloads}}</td>
                        </tr>
                        <tr>
                            <td><b>Category</b></td>
                            <td>{{$book->genre->name}}</td>
                            <td><b>Sub Category</b></td>
                            <td>{{$book->subcategory->name}}</td>
                        </tr>
                    </tbody>
                </table>

                <p class="mt-4">Description</p>
                <p class="text-muted">{{$book->description}}</p>

                <hr>
                <a href="{{route('book.edit',$book)}}" class="btn btn-primary btn-sm hvr-shadow">
                    <i class="far fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <embed src="{{asset("storage/books/".$book->genre->name."/$book->link")}}" type="application/pdf"
                    style="width: 100%; height: 70vh">
            </div>
        </div>
    </div>
</div>
@endsection