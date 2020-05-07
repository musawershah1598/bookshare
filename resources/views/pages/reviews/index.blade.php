@extends('layouts.admin')

@section('styles')
<style>
    #main-card {
        min-height: 50vh;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="card" id="main-card">
        <div class="card-body">
            <h3 class="d-inline-block">User Reviews</h3>
            <a href="{{route('home')}}" class="btn btn-sm btn-primary hvr-shadow float-right">
                <i class="fas fa-angle-double-left"></i> Back
            </a>

            {{-- <form class="mt-3" onsubmit="formSubmit(event)">
                <div class="input-group input-group-sm w-25">
                    <input type="text" class="form-control" id="search" placeholder="search for a book">
                </div>
            </form> --}}

            <div class="m-3">
                @include("flash::message")
            </div>

            @if(count($reviews) > 0)
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <th>No #</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Book</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                        <tr>
                            <td>{{$review->id}}</td>
                            <td>{{$review->user->name}}</td>
                            <td>{{$review->user->email}}</td>
                            <td>{{$review->book->title}}</td>
                            <td>
                                <button class="btn btn-primary btn-sm hvr-shadow" data-toggle="modal"
                                    data-target="#myModal{{$review->id}}">
                                    <i class="far fa-eye"></i> Show
                                </button>
                                <form action="{{route('review.destroy',$review)}}" class="d-inline-block mt-1"
                                    method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger btn-sm hvr-shadow">
                                        <i class="far fa-trash-alt"></i> DELETE
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal{{$review->id}}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5 class="d-inline-block">Content</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <hr>
                                        <p class="text-muted">
                                            {{$review->content}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$reviews->links()}}
            @else
            <p>No Review Found</p>
            @endif
        </div>
    </div>
</div>
@endsection