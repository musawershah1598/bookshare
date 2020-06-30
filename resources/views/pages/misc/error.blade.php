@extends('layouts.app')

@section('styles')
<style>
    .image {
        text-align: center;
    }

    .image img {
        height: 50%;
        width: 50%;
    }

    .content {
        text-align: center;
        color: red;
    }

    .success {
        text-align: center;
        color: #5FCC6C
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            @if($status >= 400)
            <div class="image">
                <img src="{{asset('images/page-not-found.png')}}" alt="not found image">
            </div>
            <div class="content">
                @if($status == 404)
                <h1>User not found.</h1>
                @else
                <h1>Email Already Verified</h1>
                @endif
            </div>

            @else
            <div class="image">
                <img src="{{asset('images/success.png')}}" alt="success">
            </div>
            <div class="success">
                <h1>Email Verified</h1>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection