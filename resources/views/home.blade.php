@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="row numbers">
    <div class="col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <h5 class="card-title text-muted">Total Books</h5>
                        <h5 class="card-text">{{$totalBooks}}</h5>
                    </div>
                    <div class="col-sm-4">
                        <img src="{{asset('images/home/books.svg')}}" alt="books" class="image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <h5 class="card-title text-muted">Total Users</h5>
                        <h5 class="card-text">{{$totalUsers}}</h5>
                    </div>
                    <div class="col-sm-4">
                        <img src="{{asset('images/home/user.svg')}}" alt="user image" class="image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <h5 class="card-title text-muted">Genres</h5>
                        <h5 class="card-text">{{$totalGenres}}</h5>
                    </div>
                    <div class="col-sm-4">
                        <img src="{{asset('images/home/category.svg')}}" alt="category image" class="image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <h5 class="card-title text-muted">Total Reviews</h5>
                        <h5 class="card-text">{{$totalReviews}}</h5>
                    </div>
                    <div class="col-sm-4">
                        <img src="{{asset('images/home/rating.svg')}}" alt="user rating" class="image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- charts --}}

<div class="row mt-3 mb-4">
    <div class="col-md-6">
        <div class="card">
            <canvas id="user_chart"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <canvas id="book_chart"></canvas>
        </div>
    </div>
</div>


<div class="row mb-4" id="data-cards">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="d-inline-block">New Users</h5>
                <a href="{{route('user.index')}}" class="btn btn-sm btn-primary float-right">
                    See all
                </a>
                <hr>
                <table class="table mt-5">
                    <thead>
                        <th>No #</th>
                        <th>Name</th>
                        <th>Email</th>
                    </thead>
                    <tbody>
                        @foreach($fiveUserRecords as $user)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td><b>{{$user->name}}</b></td>
                            <td>{{$user->email}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="d-inline-block">New Books</h5>
                <a href="{{route('book.index')}}" class="btn btn-sm btn-primary float-right">
                    See all
                </a>
                <hr>
                <table class="table mt-5">
                    <thead>
                        <th>No #</th>
                        <th>Name</th>
                        <th>Author</th>
                    </thead>
                    <tbody>
                        @foreach($fiveBookRecords as $book)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td><b>{{$book->title}}</b></td>
                            <td>{{$book->author}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        var userCtx = $("#user_chart");
        var users = {!! json_encode($userPerMonth) !!}
        var userChart = new Chart(userCtx,{
            type: "line",
            options: {
                animation: {
                    duration: 4000
                },
            },
            data: {
                labels: ['Jan',"Feb",'Mar',"Apr",'May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{
                    label: "No Of Users Per Month",
                    fill: false,
                    borderColor: '#00E69F',
                    data: users
                }]
            }
        });

        var bookCtx = $("#book_chart");
        var books = {!! json_encode($bookPerMonth) !!}
        var bookChart = new Chart(bookCtx,{
            type: "bar",
            options: {
                animation: {
                    duration: 4000
                }
            },
            data: {
                labels: ['Jan',"Feb",'Mar',"Apr",'May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [
                    {
                        label: "No Of Books Per Month",
                        backgroundColor: "#548AFF",
                        barPercentage: 0.4,
                        data: books
                    }
                ]
            }
        });
    });
</script>
@endsection