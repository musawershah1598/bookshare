@extends('layouts.admin')

@section('styles')
<style>
    .card {
        min-height: 50vh;
    }
</style>
@endsection

@section('content')
<div class="container w-50">
    <div class="card">
        <div class="card-body">
            <h2 class="d-inline-block">{{$genre->name}}</h2>
            <a href="{{route('genre.index')}}" class="btn btn-primary btn-sm hvr-shadow float-right">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
            <hr>
            <p>{{$genre->description}}</p>
        </div>
    </div>
</div>
@endsection