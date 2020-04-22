@extends('layouts.admin')

@section('styles')
<style>
    #search-table,
    #spinner {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="d-inline-block">All Books</h3>
            <a href="{{route('book.create')}}" class="btn btn-primary btn-sm float-right hvr-shadow"><i
                    class="fas fa-plus"></i>
                Create</a>

            <form class="mt-3" onsubmit="formSubmit(event)">
                <div class="input-group input-group-sm w-25">
                    <input type="text" class="form-control" id="search" placeholder="search for a book">
                </div>
            </form>

            <div id="spinner" class="text-center">
                <div class="spinner-border text-primary text-center" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="mt-3 mb-3">
                @include("flash::message")
            </div>

            <h3 class="text-center" style="color: red;display: none;" id="not-found">No record found</h3>

            <div id="search-table" class="table-responsive">
                <br>
                <table class="table">
                    <thead>
                        <th>No #</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            @if(count($books) > 0)
            <div class="table-responsive" id="default-table">
                <br>
                <table class="table">
                    <thead>
                        <th>No #</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>{{$book->id}}</td>
                            <td><b>{{$book->title}}</b></td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->isbn}}</td>
                            <td class="text-center">
                                <a href="{{route('book.show',$book)}}" class="btn btn-primary btn-sm hvr-shadow">
                                    <i class="far fa-edit"></i> Show
                                </a>
                                <form action="{{route('book.destroy',$book)}}" class="d-inline-block mt-2"
                                    onsubmit="return confirm('Are you sure want to delete this book?');" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger btn-sm hvr-shadow">
                                        <i class="far fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>No book found yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $("#search").on('keyup',function(e){
        if(e.which == 13){
            formSubmit(e);
        }else{
            var input = $(this).val();
            if(input == ""){
                $('#default-table').css('display','block');
                $("#search-table").css('display','none');
            }
        }
    });
    function formSubmit(event){
        event.preventDefault();
        var input = $("#search").val();
        $("#spinner").css('display', "block");
        $.ajax({
            url: "{{route('book.search')}}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'search':input},
            success: function(val){
                console.log(val)
                    $("#search-table").css('display','block');
                    $("#default-table").css('display','none');
                    $("#spinner").css('display', "none");
                    $('#search-table tbody').html(val);
            },
            error: function(error){
                console.log(error)
                if(error.status == 404){
                    $("#not-found").css('display','block');
                    $("#spinner").css('display', "none");
                    setTimeout(()=>{
                        $("#not-found").css('display','none');
                    },4000)
                }
            }
        });
    }
</script>
@endsection