@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <h1 class="display-5">All Books</h1>
    <a href="{{route('home')}}">Go back?</a>
    @include("flash::message")
    <br>

    <a href="{{route('book.create')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Create</a>

    @if(count($books) > 0)
    <div class="table-responsive">
        <br>
        <table class="table table-hover text-center">
            <thead class="table-primary">
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Views</th>
                <th>Downloads</th>
                <th>Genre</th>
                <th>Pages</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{$book->id}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->author}}</td>
                    <td>{{$book->isbn}}</td>
                    <td>{{$book->views}}</td>
                    <td>{{$book->downloads}}</td>
                    <td>{{$book->genre->name}}</td>
                    <td>{{$book->pages}}</td>
                    <td>
                        <a href="{{route('book.show',$book)}}" class="btn btn-info">
                            <i class="far fa-eye"></i> Show
                        </a>
                        <form action="{{route('book.destroy',$book)}}" class="d-inline-block mt-2"
                            onsubmit="return confirm('Are you sure want to delete this book?');" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger">
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
@endsection
