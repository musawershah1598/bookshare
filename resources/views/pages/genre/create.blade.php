@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Create New Genre
        </div>
        <div class="card-body">
            <form action="{{route('genre.store')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Genre Name</label>
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{old('name')}}">
                        @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                    <div class="col-md-6">
                        <textarea name="description" id="description" cols="30" rows="5"
                            class="form-control @error('description') is-invalid  @enderror"
                            value="{{old('description')}}"></textarea>
                        @error('description')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <a href="{{url()->previous()}}" class="btn btn-outline-warning">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
