@extends('index')
@section('title', 'Catalog')

@section('content')
    <h3>All products</h3>
    @if(session()->has('store'))
        <div class="alert alert-success">Created successfully</div>
    @endif
    @if(session()->has('update'))
        <div class="alert alert-success">Edited successfully</div>
    @endif
    @if(session()->has('destroy'))
        <div class="alert alert-success">Deleted successfully</div>
    @endif
    <a href="{{route('admin.product.create')}}" class="btn btn-warning w-100 my-3">Create</a>
    <div class="d-flex flex-wrap gap-3">
        @foreach(\App\Models\Product::all() as $product)
            <div class="card" style="width: 18rem;">
                <img src="{{asset('/storage/app/public/'.$product->image)}}" class="card-img-top" alt="Product">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <div>
                        <p class="card-text">Price: {{$product->price}} ₽</p>
                        <a href="{{route('product', ['product'=>$product->id])}}" class="btn btn-warning">Product card</a>
                        <a href="{{route('admin.product.edit', ['product'=>$product->id])}}" class="btn btn-success">Edit</a>
                        <a href=""
                           type="button"
                           class="btn btn-danger destroy"
                           data-bs-toggle="modal"
                           data-bs-target="#getOpenDestroyModalWindow"
                           data-id="{{$product->id}}">Delete</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @include('components.destroyModal',['routeName' => 'admin.product.index'])
    <script>
        document.querySelectorAll('.destroy').forEach((element) => {
            element.addEventListener('click', (el)=>{
                document.querySelector('#getOpenDestroyModalWindow_context').innerHTML = 'Delete element with ID '+ element.dataset.id;
                document.querySelector('#getOpenDestroyModalWindow_operation').setAttribute('action', '{{route('admin.product.index')}}/'+element.dataset.id)
            })
        })
    </script>
@endsection
