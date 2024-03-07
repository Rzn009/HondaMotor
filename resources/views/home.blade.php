{{-- @extends('layouts.app') --}}
@extends('home.parent')



@section('content')
    <div class="container">
        <div class="row card p-4">
            <h1>
                Welcome {{ Auth::user()->name }}
            </h1>
            <hr>
            <div class="card p-3">
                <div class="card-title d-flex justify-content-center rounded"
                    style="background-image: url({{ asset('admin/assets/img/card.jpg') }})">
                    <h1>Detail Email</h1>
                </div>
                <ul class="list-group">
                    <li class="list-group-item" aria-current="true">Name Account: <strong>{{ Auth::user()->name }}</strong>
                    </li>
                    <li class="list-group-item">E-mail Account: {{ Auth::user()->email }}</li>
                    <li class="list-group-item">Role Account : {{ Auth::user()->role }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection



