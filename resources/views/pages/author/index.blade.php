@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h3 class="d-inline-block">Authors</h3>
            <a href="{{route('author.create')}}" class="btn btn-primary hvr-shadow float-right">
                <i class="fas fa-plus"></i> Create Author
            </a>
            <hr>

            <div class="mt-4">
                @include("flash::message")
            </div>

            @if(count($authors) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>No #</th>
                        <th>Author Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Education</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach($authors as $author)
                        <tr>
                            <td>{{$author->id}}</td>
                            <td>{{$author->name}}</td>
                            <td>{{$author->designation}}</td>
                            <td>{{$author->email}}</td>
                            <td>{{$author->education}}</td>
                            <td>{{$author->phone}}</td>
                            <td>
                                <a href="{{route('author.edit',$author)}}" class="btn btn-primary hvr-shadow">
                                    <i class="far fa-eye"></i> Edit
                                </a>
                                <form action="{{route('author.destroy',$author)}}" class="d-inline-block" method="POST"
                                    onsubmit="return confirm('Are you sure want to delete this author?');">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-danger hvr-shadow" type="submit">
                                        <i class="far fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$authors->links()}}
            </div>
            @else
            <p>No Author found.</p>
            @endif
        </div>
    </div>
</div>
@endsection