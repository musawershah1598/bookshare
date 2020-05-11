@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="d-inline-block">Update Sub Category</h3>
            <a href="{{route('subcategory.index')}}" class="btn btn-primary float-right hvr-shadow">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
            <hr>

            <form action="{{route('subcategory.update',$subcategory)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" placeholder="enter sub category name" name="name" value="{{$subcategory->name}}"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span class="invalid-feedback d-block">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group"><label for="category">Category</label>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                        <option value="">Select Category</option>
                        @foreach($categories as $item)
                        @if($item->id == $subcategory->genre_id)
                        <option value="{{$item->id}}" style="background: #283267;color: white" selected>{{$item->name}}
                        </option>
                        @else
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('category')
                    <span class="invalid-feedback d-block"><strong>{{$message}}</strong></span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary hvr-shadow">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection