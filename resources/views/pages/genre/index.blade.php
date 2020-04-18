@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('css/pages/genre/index.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="d-inline-block">All Genres</h4>

            <a href="{{route('genre.create')}}" class="btn btn-primary btn-sm float-right hvr-shadow">
                <i class="fa fa-plus"></i> CREATE
            </a>

            <form class="mt-3" onsubmit="formSubmit(event)">
                <div class="input-group input-group-sm w-25">
                    <input type="text" class="form-control" id="search" placeholder="search for a genre">
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
                        <th>ID</th>
                        <th>Name</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>


            @if(count($genres) > 0)
            <div class="table-responsive" id="default-table">
                <br>
                <table class="table">
                    <thead>
                        <th>No #</th>
                        <th>Name</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                        @foreach($genres as $genre)
                        <tr>
                            <td>{{$genre->id}}</td>
                            <td><b>{{$genre->name}}</b></td>
                            <td class="text-center">
                                <a href="{{route('genre.show',$genre)}}" class="btn btn-primary btn-sm hvr-shadow"> <i
                                        class="far fa-eye"></i>
                                    <span>Show</span></a>
                                <form action="{{route('genre.destroy',$genre)}}" method="POST"
                                    class="d-inline-block mt-2"
                                    onsubmit="return confirm('Are you sure want to delete this genre?');">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-danger btn-sm hvr-shadow"><i class="far fa-trash-alt"></i>
                                        Delete</button>
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
            url: "{{route('genre.search')}}",
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