@extends('index')
@section('title', 'Login')

@section('content')
    <h3>Registration</h3>
    @auth
        <div class="alert alert-success">You are authorized</div>
    @endauth
    @guest
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            @include('components.input', ['input' => ['name' => 'login', 'label' => 'Login']])
            @include('components.input', ['input' => ['name' => 'name', 'label' => 'Name']])
            @include('components.input', ['input' => ['name' => 'phone', 'label' => 'Phone']])

            @include('components.input', ['input' => ['name' => 'password', 'label' => 'Password', 'type' => 'password' ]])
            @include('components.input', ['input' => ['name' => 'password_confirmation', 'label' => 'Password Confirmation', 'type' => 'password' ]])
            <button type="submit" class="btn btn-warning w-100">Register</button>
        </form>
    @endguest
@endsection
