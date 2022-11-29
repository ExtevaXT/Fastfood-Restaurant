@extends('index')
@section('title', 'Login')

@section('content')
    <h3>Authorization</h3>
    @auth
        <div class="alert alert-success">You are authorized</div>
    @endauth
    @if(session()->has('register'))
        <div class="alert alert-success">Registered successfully</div>
    @endif
    @guest
        <form method="POST" action="{{ route('login') }}">
            @csrf
            @include('components.input', ['input' => ['name' => 'login', 'label' => 'Login']])
            @include('components.input', ['input' => ['name' => 'password', 'label' => 'Password', 'type' => 'password' ]])
            <button type="submit" class="btn btn-warning w-100">Login</button>
        </form>
    @endguest
@endsection
