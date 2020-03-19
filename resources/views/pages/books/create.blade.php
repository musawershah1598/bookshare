@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Add New Book</div>
        <div class="card-body">
            <form action="{{route('book.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('title') is-invalid  @enderror" name="title"
                            id="title" value="{{old('title')}}">
                        @error('title')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="author" class="col-md-4 col-form-label text-md-right">Author</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('author') is-invalid  @enderror" name="author"
                            id="author" value="{{old('author')}}">
                        @error('author')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="form-group row">
                    <label for="isbn" class="col-md-4 col-form-label text-md-right">ISBN</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('isbn') is-invalid  @enderror" name="isbn"
                            id="isbn" value="{{old('isbn')}}">
                        @error('isbn')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="form-group row">
                    <label for="genre" class="col-md-4 col-form-label text-md-right">Genre</label>
                    <div class="col-md-6">
                        <select name="genre" id="genre" class="form-control @error('genre') is-invalid  @enderror">
                            <option value=""></option>
                            @foreach($genres as $genre)
                            <option value="{{$genre->id}}">{{$genre->name}}</option>
                            @endforeach
                        </select>
                        @error('genre')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="form-group row">
                    <label for="no_of_pages" class="col-md-4 col-form-label text-md-right">No of Pages</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control @error('no_of_pages') is-invalid  @enderror"
                            name="no_of_pages" id="no_of_pages" value="{{old('no_of_pages')}}">
                        @error('no_of_pages')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="row form-group">
                    <label for="book" class="col-md-4 col-form-label text-md-right">Book File</label>
                    <div class="col-md-6">
                        <input type="file" name="book" id="book"
                            class="form-control-file @error('book') is-invalid  @enderror" accept=".pdf"
                            value="{{old('book')}}">
                        @error('book')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="row form-group">
                    <label for="image" class="col-md-4 col-form-label text-md-right">Book Image</label>
                    <div class="col-md-6">
                        <input type="file" name="image" id="image"
                            class="form-control-file @error('image') is-invalid  @enderror" accept=".jpg,.jpeg,.png"
                            value="{{old('image')}}">
                        @error('image')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="row form-group">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                    <div class="col-md-6">
                        <textarea name="description" id="description" cols="30" rows="5"
                            class="form-control  @error('description') is-invalid  @enderror">{{old('description')}}</textarea>
                        @error('description')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <a href="{{route('book.index')}}" class="btn btn-outline-warning">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
