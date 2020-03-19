@extends('layouts.app')

@section('content')
<div class="jumbotron">
    @include("flash::message")
    <div class="container-fluid">
        <h1 class="display-3">Home Page</h1>
        <p>This is the welcome page for bookshare project</p>
        @if(Auth::check())
        <a href="{{route('home')}}" class="btn btn-primary">Dashboard</a>
        @else
        <a href="{{route('login')}}" class="btn btn-primary">Login</a>
        @endif
    </div>
</div>
@endsection


@section('scripts')
<script>
    $(document).ready(function(){
        $('.alert').not('.alert-important').delay(3000).fadeOut(300)
    })
</script>
@endsection
