@extends('index')
@section('title', 'Contact')

@section('content')
    <div class="mx-5">
        <h3>Contacts</h3>
        <img class="my-4" src="{{asset('public/map.png')}}" alt="map">
        <div class="list-group">
            <a href="tel:88005553535" class="list-group-item list-group-item-action" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Telephone number</h5>
                    <small>+7 800 555-35-35</small>
                </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Address</h5>
                    <small class="text-muted">Chelyabinsk, Enthusiastov, 17</small>
                </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">E-Mail</h5>
                    <small class="text-muted">admin@admin.ru</small>
                </div>
            </a>
        </div>
    </div>
@endsection
