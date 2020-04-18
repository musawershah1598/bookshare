@extends('layouts.admin')
@section('content')
<div class="container w-75">
    <div class="card">
        <div class="card-body">
            <h3 class="d-inline-block">Create Genre</h3>
            <a href="{{route('genre.index')}}" class="btn btn-sm btn-primary float-right hvr-shadow">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
            <form action="{{route('genre.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Genre Name</label>
                    <input type="text" placeholder="enter genre name" name="name"
                        class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                    @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="5"
                        placeholder="description for a genre"
                        class="form-control @error('description') is-invalid  @enderror"
                        value="{{old('description')}}"></textarea>
                    @error('description')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary hvr-shadow">
                    Create
                </button>
        </div>
    </div>
    </form>
</div>
</div>
</div>
@endsection