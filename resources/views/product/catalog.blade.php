@extends('index')
@section('title', 'Catalog')

@section('content')
    <h3>Catalog</h3>
    <div class="d-flex gap-3 my-3">
        <div class="w-25 p-1">Product filter</div>
        <select class="form-select">
            <option selected>Product category</option>
            <option>Laser printer</option>
            <option>Ink-jet printer</option>
            <option>Thermal printer</option>
        </select>
        <select class="form-select">
            <option selected>Sort by</option>
            <option>Production year</option>
            <option>Name</option>
            <option>Price</option>
        </select>
    </div>
    <div class="d-flex flex-wrap gap-3">
        @foreach(\App\Models\Product::all() as $product)
        <div class="card" style="width: 18rem;">
            <img onclick="window.location.href='{{route('product', ['product'=>$product->id])}}'" src="{{asset('/storage/app/public/'.$product->image)}}" class="card-img-top" alt="Product">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h5 class="card-title">{{$product->name}}</h5>
                </div>
                <div>
                    <p class="card-text">Price: {{$product->price}} ₽</p>
                    <div class="d-inline">
                        <a href="{{route('product', ['product'=>$product->id])}}" class="btn btn-warning @guest w-100 @endguest">Product card</a>
                        @auth
                            @if(session()->has('basket'))
                                @if(isset(session('basket')[$product->id]))
                                    <a href="{{ route('order.basket') }}" class="btn btn-dark" type="button">Basket</a>
                                @else
                                    <a href="{{ route('order.addToBasket', ['productId' => $product->id]) }}" class="btn btn-success" type="button">Add to basket</a>
                                @endif
                            @else
                                <a href="{{ route('order.addToBasket', ['productId' => $product->id]) }}" class="btn btn-success" type="button">Add to basket</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
