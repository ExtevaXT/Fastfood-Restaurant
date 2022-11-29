@extends('index')
@section('title', 'Card')

@section('content')
    <div class="card w-100">
        <img src="{{asset('/storage/app/public/'.$product->image)}}" class="card-img-top w-50" alt="Product">
        <div class="card-body">
            <h2 class="card-title">{{$product->name}}</h2>
            <p class="card-text">{{$product->description}}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Calories: {{$product->calories}} cal.</li>
            <li class="list-group-item">Ingredients: {{$product->ingredients}}</li>
            <li class="list-group-item">Price: {{$product->price}} ₽</li>
            <li class="list-group-item">
                @auth
                    @if(session()->has('basket'))
                        @if(isset(session('basket')[$product->id]))
                            <a href="{{ route('order.basket') }}" class="btn btn-dark w-100" type="button">Basket</a>
                        @else
                            <a href="{{ route('order.addToBasket', ['productId' => $product->id]) }}" class="btn btn-warning w-100" type="button">Add to basket</a>
                        @endif
                    @else
                        <a href="{{ route('order.addToBasket', ['productId' => $product->id]) }}" class="btn btn-warning w-100" type="button">Add to basket</a>
                    @endif
                @endauth
            </li>
        </ul>

    </div>
@endsection
