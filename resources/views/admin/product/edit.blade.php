@extends('index')
@section('title', 'Edit')

@section('content')
    <div class="container">
        <div>
            <h1>Editing {{ $product->name }}</h1>
            <form method="POST" action="{{ route('admin.product.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('components.input', ['input' => ['name' => 'name', 'label' => 'Name', 'default' => $product->name]])
                @include('components.input', ['input' => ['name' => 'price', 'label' => 'Price', 'type' => 'number', 'default' => $product->price]])
                @include('components.input', ['input' => ['name' => 'calories', 'label' => 'Calories', 'type' => 'number', 'default' => $product->calories]])
                @include('components.input', ['input' => ['name' => 'ingredients', 'label' => 'Ingredients', 'default' => $product->ingredients]])
                @include('components.input', ['input' => ['name' => 'description', 'label' => 'Description', 'default' => $product->description]])
                @include('components.input', ['input' => ['name' => 'image', 'label' => 'Image', 'type' => 'file']])
                <button type="submit" class="btn btn-warning w-100">Edit</button>
            </form>
        </div>
    </div>
@endsection
