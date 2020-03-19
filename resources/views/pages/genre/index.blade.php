@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h1 class="display-5">All Genres</h1>
    <a href="{{route('home')}}">Go back?</a>

    @include("flash::message")
    <br>

    <h1>
        <a href="{{route('genre.create')}}" class="btn btn-primary float-right d-block">
            <i class="fa fa-plus"></i> CREATE
        </a>
    </h1>


    @if(count($genres) > 0)
    <div class="table-responsive">
        <br>
        <table class="table table-hover text-center">
            <thead class="table-primary">
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach($genres as $genre)
                <tr>
                    <td>{{$genre->id}}</td>
                    <td>{{$genre->name}}</td>
                    <td>{{$genre->description}}</td>
                    <td>
                        <a href="{{route('genre.show',$genre)}}" class="btn btn-info"> <i class="far fa-eye"></i>
                            <span>Show</span></a>
                        <form action="{{route('genre.destroy',$genre)}}" method="POST" class="d-inline-block mt-2"
                            onsubmit="return confirm('Are you sure want to delete this genre?');">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$genres->links()}}
    </div>
    @else
    <p>No genre present yet.</p>
    @endif
</div>
@endsection
