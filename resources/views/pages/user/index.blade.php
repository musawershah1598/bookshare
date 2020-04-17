@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('css/pages/user/index.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="card" id="main-content">
        <div class="card-body">
            <h4 class="d-inline-block">Users</h4>
            <hr>

            <form class="mt-3" onsubmit="formSubmit(event)">
                @csrf
                @method("DELETE")
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="search for user" id="search">
                </div>
            </form>

            <div class="progress mt-3" id="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>

            <div class="mt-3 mb-3">
                @include("flash::message")
            </div>

            <h3 class="text-center" style="color: red;display: none;" id="not-found">No record found</h3>

            <div class="table-responsive" id="search-table">
                <table class="table mt-4">
                    <thead>
                        <th>NO #</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

            <div class="table-responsive" id='default-table'>
                <table class="table mt-4">
                    <thead>
                        <th>NO #</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td><b>{{$user->name}}</b></td>
                            <td>{{$user->email}}</td>
                            @if($user->phone)
                            <td>{{$user->phone}}</td>
                            @else
                            <td>Not found</td>
                            @endif
                            @if($user->role == 'user')
                            <td>
                                <form action="{{route('user.destroy',[$user->id])}}" method="POST"
                                    onsubmit="return confirm('Are you sure want to delete this user?')">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                            @else
                            <td>Admin</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$users->links()}}
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
        $("#progress").css('display', "block");
        $.ajax({
            url: "{{route('user.search')}}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'search':input},
            success: function(val){
                console.log(val)
                    $("#search-table").css('display','block');
                    $("#default-table").css('display','none');
                    $("#progress").css('display', "none");
                    $('#search-table tbody').html(val);
            },
            error: function(error){
                if(error.status == 404){
                    $("#not-found").css('display','block');
                    $("#progress").css('display', "none");
                    setTimeout(()=>{
                        $("#not-found").css('display','none');
                    },4000)
                }
            }
        });
    }
</script>
@endsection