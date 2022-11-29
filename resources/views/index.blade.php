<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Main page')</title>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.css')}}">
</head>
<body class="container">
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand text-warning fw-bold" href="/">PhpDonalds</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="/">About us</a></li>
            <li class="nav-item active"><a class="nav-link " href="{{route('catalog')}}">Catalog</a></li>
            <li class="nav-item active"><a class="nav-link " href="{{route('contact')}}">Our contacts</a></li>
            @guest()
                <li class="nav-item"><a class="nav-link " href="{{route('login')}}">Login</a></li>
                <li class="nav-item"><a class="nav-link " href="{{route('register')}}">Register</a></li>
            @endguest
            @auth()
                @if(Auth::user()->role=='Administrator')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin-panel
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('admin.product.index')}}">Products</a></li>
                            <li><a class="dropdown-item" href="{{route('admin.order.index')}}">Orders</a></li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item"><a class="nav-link" href="{{ route('order.basket') }}">Basket</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('order.orders') }}">Orders</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="{{ route('logout') }}">Logout</a></li>
            @endauth
        </ul>
    </div>
</nav>
<div class="container">
    @section('content')


    @show
</div>
<!-- JavaScript Bundle with Popper -->
<script src="{{asset('public/js/bootstrap.bundle.js')}}"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>--}}
</body>
</html>
