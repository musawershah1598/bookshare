@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('dist/jquery-filestyle.min.css')}}">
@endsection

@section('content')
<div class="container w-75">
    <div class="card">
        <div class="card-body">
            <h3 class="d-inline-block">Update Details</h3>
            <a href="{{route('book.show',$book)}}" class="btn btn-sm btn-primary float-right hvr-shadow">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
            <hr>
            <form action="{{route('book.update',$book)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror" value="{{$book->title}}">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" id="author" value="{{$book->author}}"
                                class="form-control @error('author') is-invalid @enderror">
                            @error('author')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input type="text" name="isbn" id="isbn" value="{{$book->isbn}}"
                                class="form-control @error('isbn') is-invalid @enderror">
                            @error('isbn')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="genre">Genre</label>
                            <select name="genre" id="genre" class="form-control @error('genre') is-invalid @enderror"
                                onchange="getSubCategory(this)">
                                @foreach($genres as $genre)
                                @if($genre->id != $book->genre->id)
                                <option value="{{$genre->id}}">{{$genre->name}}</option>
                                @else
                                <option value="{{$genre->id}}" style="background: #ccc" selected>{{$genre->name}}
                                </option>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subcategory">Sub Category</label>
                            <select name="subcategory" id="subcategory" class="form-control">
                                @foreach($book->genre->subcategories as $item)
                                @if($item->id != $book->subcategory_id)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @else
                                <option value="{{$item->id}}" style="background: #ccc" selected>{{$item->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="no_of_pages">No Of Pages</label>
                    <input type="number" name="no_of_pages" id="no_of_pages" value="{{$book->pages}}"
                        class="form-control @error('no_of_pages') is-invalid @enderror">
                    @error('no_of_pages')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="book">Book File</label>
                            <input type="file" name="book" id="book"
                                class="jfilestyle @error('book') is-invalid @enderror" accept=".pdf">
                            @error('book')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Cover Image</label>
                            <input type="file" name="image" id="image"
                                class="jfilestyle @error('image') is-invalid @enderror" accept=".jpeg,.jpg,.png">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="5"
                        class="form-control @error('description') is-invalid @enderror">{{trim($book->description)}}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary hvr-shadow">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('dist/jquery-filestyle.min.js')}}"></script>

<script>
    function getSubCategory(event){
        var catId = event.value;
        var url = "{{route('subcategory.get')}}";
        $.ajax({
            url: url,
            method: "GET",
            data: {
                catId: catId
            },
            success: function(val){
                $("#subcategory").html(val);
            }
        });
    }
</script>
@endsection