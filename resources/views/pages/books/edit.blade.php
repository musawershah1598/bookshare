@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <div class="card">
        <div class="card-header">Update Book Details</div>
        <div class="card-body">
            <form action="{{route('book.update',$book)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                    <div class="col-md-6">
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror" value="{{$book->title}}">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="author" class="col-md-4 col-form-label text-md-right">Author</label>
                    <div class="col-md-6">
                        <input type="text" name="author" id="author" value="{{$book->author}}"
                            class="form-control @error('author') is-invalid @enderror">
                        @error('author')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="isbn" class="col-md-4 col-form-label text-md-right">ISBN</label>
                    <div class="col-md-6">
                        <input type="text" name="isbn" id="isbn" value="{{$book->isbn}}"
                            class="form-control @error('isbn') is-invalid @enderror">
                        @error('isbn')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="genre" class="col-md-4 col-form-label text-md-right">Genre</label>
                    <div class="col-md-6">
                        <select name="genre" id="genre" class="form-control @error('genre') is-invalid @enderror">
                            @foreach($genres as $genre)
                            @if($genre->id != $book->genre->id)
                            <option value="{{$genre->id}}">{{$genre->name}}</option>
                            @else
                            <option value="{{$genre->id}}" selected>{{$genre->name}}</option>
                            @endif

                            @endforeach
                        </select>
                        @error('genre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_of_pages" class="col-md-4 col-form-label text-md-right">No Of Pages</label>
                    <div class="col-md-6">
                        <input type="number" name="no_of_pages" id="no_of_pages" value="{{$book->pages}}"
                            class="form-control @error('no_of_pages') is-invalid @enderror">
                        @error('no_of_pages')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="book" class="col-md-4 col-form-label text-md-right">Book File</label>
                    <div class="col-md-6">
                        <input type="file" name="book" id="book"
                            class="form-control-file @error('book') is-invalid @enderror" accept=".pdf">
                        @error('book')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-right">Cover Image</label>
                    <div class="col-md-6">
                        <input type="file" name="image" id="image"
                            class="form-control-file @error('image') is-invalid @enderror" accept=".jpeg,.jpg,.png">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                    <div class="col-md-6">
                        <textarea name="description" id="description" cols="30" rows="5"
                            class="form-control @error('description') is-invalid @enderror">{{trim($book->description)}}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <a href="{{route('book.show',$book)}}" class="btn btn-outline-warning">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
