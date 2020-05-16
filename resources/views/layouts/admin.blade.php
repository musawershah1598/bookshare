<!DOCTYPE html>
<html lang="en">

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/lib/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="{{ asset('js/lib/bootstrap.min.js')}}"></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9b4e0d0281.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/layouts/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/includes/admin-navbar.css')}}">
    @yield('styles')
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="sidebar">
                <ul class="list-group">
                    <li class="list-group-item text-center header">
                        <img src="https://iqonic.design/granth/public/storage/135/Untitled-1.png" alt="logo">
                        <h3>BookShare</h3>
                    </li>
                    <li class="list-group-item">
                        <img src="{{asset('icons/home.svg')}}" alt="home icon">
                        <a href="{{route('home')}}">
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <img src="{{asset('icons/user.svg')}}" alt="user icon">
                        <a href="{{route('user.index')}}">
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <img src="{{asset('icons/category.svg')}}" alt="category icon">
                        <a href="{{route('genre.index')}}">
                            <p>Category</p>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <img src="{{asset('icons/subcategory.svg')}}" alt="sub category">
                        <a href="{{route('subcategory.index')}}">
                            <p>Sub Category</p>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <img src="{{asset('icons/author.svg')}}" alt="author">
                        <a href="{{route('author.index')}}">
                            <p>Authors</p>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <img src="{{asset('icons/book.svg')}}" alt="book icon">
                        <a href="{{route('book.index')}}">
                            <p>Books</p>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <img src="{{asset('icons/recommended.svg')}}" alt="recommended">
                        <a href="{{route('book.recommended')}}">
                            <p>Recommended Books</p>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <img src="{{asset('icons/best-seller.svg')}}" alt="best seller">
                        <a href="{{route('book.bestselling')}}">
                            <p>Best Selling Books</p>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <img src="{{asset('icons/review.svg')}}" alt="reviews">
                        <a href="{{route('review.index')}}">
                            <p>Reviews</p>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <img src="{{asset('icons/profile.svg')}}" alt="profile image">
                        <a href="{{ route('profile') }}">
                            <p>Profile Settings</p>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-10">
                @include('includes.admin-navbar')
                <div class="container-fluid" id='content'>
                    @yield('content')
                </div>
                <div class="container m-5">
                    <p><span class="text-muted">&copy;2020</span> <b>BookShare</b></p>
                </div>
            </div>
        </div>
    </div>

    @yield('scripts')

    <script>
        $(".alert").not('.alert-important').delay(3000).fadeOut(1000);
        $(".dropdown").click(function(){
	console.log("temp");
});
    </script>
</body>

</html>