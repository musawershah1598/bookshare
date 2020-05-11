@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="d-inline-block">Create Sub Category</h3>
            <a href="" class="btn btn-primary hvr-shadown float-right">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
            <hr>

            <form action="{{route('subcategory.store')}}" class="mt-4" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" placeholder="enter sub category name" name="name"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span class="invalid-feedback d-block">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group"><label for="category">Category</label>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                        <option value="" style="background: #ccc">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <span class="invalid-feedback d-block"><strong>{{$message}}</strong></span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary hvr-shadow">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection