@extends('index')
@section('title', 'Create')

@section('content')
    <div class="container">
        <div>
            <h1>Product creation</h1>
            <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                @csrf
                @include('components.input', ['input' => ['name' => 'name', 'label' => 'Name']])
                @include('components.input', ['input' => ['name' => 'price', 'label' => 'Price', 'type' => 'number']])
                @include('components.input', ['input' => ['name' => 'calories', 'label' => 'Calories', 'type' => 'number']])
                @include('components.input', ['input' => ['name' => 'ingredients', 'label' => 'Ingredients']])
                @include('components.input', ['input' => ['name' => 'description', 'label' => 'Description']])
                @include('components.input', ['input' => ['name' => 'image', 'label' => 'Image', 'type' => 'file']])
                <button type="submit" class="btn btn-warning w-100">Create</button>
            </form>
        </div>
    </div>
@endsection
