@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('dist/switcher.css')}}">
<link rel="stylesheet" href="{{asset('dist/toastr.min.css')}}">
<script src="{{asset('dist/toastr.min.js')}}"></script>
<style>
    #main-container .card {
        min-height: 50vh;
    }

    #search-table,
    #spinner {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="container-fluid" id="main-container">
    <div class="card">
        <div class="card-body">
            <h3 class="d-inline-block">Recommended Books</h3>


            {{-- <form class="mt-3" onsubmit="formSubmit(event)">
                <div class="input-group input-group-sm w-25">
                    <input type="text" class="form-control" id="search" placeholder="search for a book">
                </div>
            </form> --}}

            <div id="spinner" class="text-center">
                <div class="spinner-border text-primary text-center" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="mt-3 mb-3">
                @include("flash::message")
            </div>

            <h3 class="text-center" style="color: red;display: none;" id="not-found">No record found</h3>

            <div id="search-table" class="table-responsive">
                <br>
                <table class="table">
                    <thead>
                        <th>No #</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            @if(count($books) > 0)
            <div class="table-responsive" id="default-table">
                <br>
                <table class="table">
                    <thead>
                        <th>No #</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Recommended</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>{{$book->id}}</td>
                            <td><b>{{$book->title}}</b></td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->isbn}}</td>
                            <td>
                                <div class="form-switcher form-switcher-lg form-switcher-sm-phone">
                                    @if($book->recommended == 0)
                                    <input type="checkbox" name="recommended" class="recommended"
                                        onclick="handleRecommended({{$book->id}})" id="recommended{{$book->id}}">
                                    @else
                                    <input type="checkbox" name="recommended" class="recommended"
                                        onclick="handleRecommended({{$book->id}})" id="recommended{{$book->id}}"
                                        checked>
                                    @endif
                                    <label class="switcher" for="recommended{{$book->id}}"></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{route('book.show',$book)}}" class="btn btn-primary btn-sm hvr-shadow">
                                    <i class="far fa-edit"></i> Show
                                </a>
                                <form action="{{route('book.destroy',$book)}}" class="d-inline-block mt-2"
                                    onsubmit="return confirm('Are you sure want to delete this book?');" method="POST">
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
            <p>No book found yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
@include('js/book_index')
@endsection