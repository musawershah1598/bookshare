@extends('layouts.admin')

@section('content')
<div class="container w-75">
    <div class="card">
        <div class="card-body">
            <h3 class="d-inline-block">Add Book</h3>

            <a href="{{route('book.index')}}" class="btn btn-primary btn-sm float-right hvr-shadow">
                <i class="fas fa-angle-double-left"></i> Back
            </a>

            <hr>


            <form action="{{route('book.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid  @enderror" name="title"
                                id="title" value="{{old('title')}}">
                            @error('title')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control @error('author') is-invalid  @enderror" name="author"
                                id="author" value="{{old('author')}}">
                            @error('author')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input type="text" class="form-control @error('isbn') is-invalid  @enderror" name="isbn"
                                id="isbn" value="{{old('isbn')}}">
                            @error('isbn')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="genre">Genre</label>
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
                </div>

                <div class="form-group">
                    <label for="no_of_pages">No of Pages</label>
                    <input type="number" class="form-control @error('no_of_pages') is-invalid  @enderror"
                        name="no_of_pages" id="no_of_pages" value="{{old('no_of_pages')}}">
                    @error('no_of_pages')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="book">Book File</label>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Book Image</label>
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
                </div>


                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="5"
                        class="form-control  @error('description') is-invalid  @enderror">{{old('description')}}</textarea>
                    @error('description')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary hvr-shadow">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection