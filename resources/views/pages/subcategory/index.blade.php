@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="d-inline-block">Sub Category</h3>
            <a href="{{route('subcategory.create')}}" class="btn btn-primary hvr-shadow float-right">
                <i class="fas fa-plus"></i>
                Create New</a>
            <hr>

            <div class="mt-5">
                @include("flash::message")
            </div>

            @if(count($subcategories) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach($subcategories as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td><b>{{$item->name}}</b></td>
                            <td>{{$item->category_name}}</td>
                            <td>
                                <a href="{{route('subcategory.edit',$item)}}" class="btn btn-primary hvr-shadow">
                                    <i class="far fa-eye"></i> Edit
                                </a>
                                <form action="{{route('subcategory.delete',$item)}}" class="d-inline-block mt-1"
                                    method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger hvr-shadow">
                                        <i class="far fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$subcategories->links()}}
            @else
            <p>No Sub Category found.</p>
            @endif
        </div>
    </div>
</div>
@endsection