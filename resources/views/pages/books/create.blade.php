@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('dist/jquery-filestyle.min.css')}}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }
</style>
@endsection

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
                            <select name="author" id="author"
                                class="form-control @error('author') is-invalid @enderror">
                                <option value="">Select an author</option>
                                @if(count($authors) > 0)
                                @foreach($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}}</option>
                                @endforeach
                                @else
                                <option value="">
                                    No author found
                                </option>
                                @endif
                            </select>
                            @error('author')
                            <span class="invalid-feedback d-block" role="alert">
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
                            <input type="text" class="form-control @error('isbn') is-invalid  @enderror" name="isbn"
                                id="isbn" value="{{old('isbn')}}">
                            @error('isbn')
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
                            <label for="genre">Genre</label>
                            <select name="genre" id="genre" class="form-control @error('genre') is-invalid  @enderror"
                                onchange="getSubCategory(this)">
                                <option value="">Select Category</option>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subcategory">Sub Category</label>
                            <select name="subcategory" id="subcategory"
                                class="form-control @error('subcategory') is-invalid @enderror">
                            </select>
                            @error('subcategory')
                            <span class="invalid-feedback d-block">
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
                            <br>
                            <input type="file" name="book" id="book"
                                class="jfilestyle @error('book') is-invalid  @enderror" accept=".pdf"
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
                            <label for="image">Book Image</label><br>
                            <input type="file" name="image" id="image"
                                class="jfilestyle @error('image') is-invalid  @enderror" accept=".jpg,.jpeg,.png"
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

@section('scripts')
<script src="{{asset('dist/jquery-filestyle.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $("#author").select2();
        $("#genre").select2();
        $("#subcategory").select2();
    });
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