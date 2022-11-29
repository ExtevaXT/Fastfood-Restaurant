@extends('index')
@section('title', 'Catalog')

@section('content')
    <h3>All orders</h3>
    @if(session()->has('update'))
        <div class="alert alert-success">Edited successfully</div>
    @endif
    @if(session()->has('destroy'))
        <div class="alert alert-success">Deleted successfully</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Items</th>
                <th scope="col">Price</th>
                <th scope="col">Created at</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach(\App\Models\Order::all() as $order)
            <tr>
                @php($price=0)
                <th>{{$order->id}}</th>
                <td>{{$order->user->login}}</td>
                <td>
                    <ul class="list-group">
                        @foreach($order->items as $item)
                            <li class="list-group-item">{{$item->product->name}}, {{$item->count}}</li>
                            @php($price+=$item->price * $item->count)
                        @endforeach
                    </ul>
                </td>
                <td style="white-space: nowrap">{{$price}} ₽</td>
                <td style="white-space: nowrap">{{\Carbon\Carbon::parse($order->created_at)->tz('Asia/Yekaterinburg')->format('d M H:i')}}</td>
                <td>
                    <form method="POST" action="{{route('admin.order.update', ['order'=>$order->id])}}">
                        @csrf
                        @method('PUT')
                        <select class="form-select" name="status" onchange="this.form.submit()">
                            <option @if($order->status == 'New') selected @endif value="New">New</option>
                            <option @if($order->status == 'Finished') selected @endif value="Finished">Finished</option>
                            <option @if($order->status == 'Canceled') selected @endif value="Canceled">Canceled</option>
                        </select>
                    </form>
                </td>
                <td>
                    <a href=""
                       type="button"
                       class="btn btn-danger destroy"
                       data-bs-toggle="modal"
                       data-bs-target="#getOpenDestroyModalWindow"
                       data-id="{{$order->id}}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('components.destroyModal',['routeName' => 'admin.order.index'])
    <script>
        document.querySelectorAll('.destroy').forEach((element) => {
            element.addEventListener('click', (el)=>{
                document.querySelector('#getOpenDestroyModalWindow_context').innerHTML = 'Delete element with ID '+ element.dataset.id;
                document.querySelector('#getOpenDestroyModalWindow_operation').setAttribute('action', '{{route('admin.order.index')}}/'+element.dataset.id)
            })
        })
    </script>
@endsection
