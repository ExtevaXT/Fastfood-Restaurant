

@extends('index')

@section('content')
    <div class="mt-2">
        <h3>Basket</h3>
        @if(session()->has('errorCreate'))
            <div class="alert alert-danger mt-2">Basket is empty</div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Amount</th>
                <th scope="col">Full price</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @if(isset($products))
                @php($sum = 0)
                <form method="POST">
                    @csrf
                    @foreach($products as $product)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }} ₽</td>
                            <td><input type="number" name="productsIds[{{$product->id}}]" onchange="this.form.submit()" class="form-control" value="{{ session('basket')[$product->id] }}"></td>
                            <td>{{ $product->price*session('basket')[$product->id] }} ₽</td>
                            <td><a href="{{route('order.removeFromBasket',['productId'=>$product->id])}}"><button type="button" class="btn-close" aria-label="Close"></button></a></td>
                            @php($sum += ($product->price*session('basket')[$product->id]))
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="6">
                            Full price: {{ $sum }} ₽
                        </td>
                    </tr>
                </form>
                <form action="{{ route('order.createOrder') }}" method="POST">
                    @csrf
                    <tr>
                        <td colspan="6">
                            <button class="btn btn-warning w-100" type="submit">Make order</button>
                        </td>
                    </tr>
                </form>
            @else
                <tr>
                    <td colspan="6">Basket is empty</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
