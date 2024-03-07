@extends('home.parent')


@section('content')

<div class="row">
    <div class="card p-4">
        <h3>Product Card</h3>
    </div>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-2">
            <label for="inputName" class="form-label"><i class="bi bi-text"></i> Name</label>
            <input type="text" class="form-control" id="inputNanme4" name="name" value="{{ old('name') }}">
        </div>
        <div class="mb-2">
            <label for="inputName" class="form-label">image</label>
            <input type="file" class="form-control" id="inputNanme4" name="image" value="{{ old('image') }}">
        </div>
        <div class="mb-3">
            <label class="col col-form-label">warna</label>
            <input type="color" class="form-control" id="inputNanme4" name="warna" value="{{ old('warna') }}">
        </div>

        <div class="mb-">
            <label class="col col-form-label">Price</label>
            <input type="text" name="price" class="form-control" id="inputName4">

        </div>

        <div class="d-flex justify-content-end mt-2">
            <button class="btn btn-primary" type="submit"><i class="bi bi-play"></i> Submit</button>
        </div>
        {{-- menggunakan checkeditro --}}




    </form>
</div>

@endsection