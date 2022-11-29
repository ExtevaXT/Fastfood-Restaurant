@extends('index')
@section('title', 'Catalog')

@section('content')
    <h3>Orders</h3>
    @if(session()->has('update'))
        <div class="alert alert-success">Canceled successfully</div>
    @endif
    @if(session()->has('store'))
        <div class="alert alert-success">Order made successfully</div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Items</th>
            <th scope="col">Price</th>
            <th scope="col">Created at</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\Models\Order::all()->where('user_id', Auth::user()->id) as $order)
            <tr>
                @php($price=0)
                <th>{{$order->id}}</th>
                <td>
                    <ul class="list-group">
                        @foreach($order->items as $item)
                            <li class="list-group-item">{{$item->product->name}}, {{$item->count}}</li>
                            @php($price+=$item->price * $item->count)
                        @endforeach
                    </ul>
                </td>
                <td style="white-space: nowrap">{{$price}} ₽</td>
                <td>{{\Carbon\Carbon::parse($order->created_at)->tz('Asia/Yekaterinburg')->format('d M H:i')}}</td>
                <td>{{$order->status}}</td>
                <td>
                    @if($order->status == 'New')
                    <form method="POST" action="{{route('order.cancelOrder',['id'=>$order->id])}}">
                        @csrf
                        <button type="submit" class="btn-outline-danger btn">Cancel</button>
                    </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
