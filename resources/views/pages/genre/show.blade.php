@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h1 class="display-5">Genre Show</h1>
    <a href="{{route('genre.index')}}">Go back?</a>
    <hr>

    <h1 class="text-success">{{$genre->name}}</h1>
    <p><span class="text-danger">Description: </span>
        <span>{{$genre->description}}</span>
    </p>
    <h3>All Books</h3>
    @include("flash::message")

    @if(count($books) > 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-primary">
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Views</th>
                <th>Downloads</th>
                <th>Uploaded By</th>
                <th>Action</th>
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
                    <td>{{$book->user_id}}</td>
                    <td>
                        <a href="{{route('book.show',$book)}}" class="btn btn-info">
                            <i class="far fa-eye"></i> Show
                        </a>
                        <form action="{{route('book.destroy',$book)}}" class="d-inline-block mt-2" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$books->links()}}
    </div>

    @else
    <p>No books found in the category.</p>
    @endif

</div>
@endsection
