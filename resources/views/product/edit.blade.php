@extends('home.parent')



@section('content')
    <div class="container">
        <div class="row">
            <h2>Edit</h2>

            <hr>

            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="inputName" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="inputNanme4" name="name" value="{{ $product->name }}">
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Image</label>
                    <input type="file" class="form-control" id="inputImage" name="image">
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Warna</label>
                    <input type="color" class="form-control" id="inputImage" name="warna">
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">price</label>
                    <input type="text" class="form-control" id="inputImage" name="price">
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('product.index') }}" class="btn btn-primary mx-3"><i
                            class="bi bi-arrow-left"></i>Back</a>
                    <button type="submit" class="btn btn-outline-warning">
                        <i class="bi bi-pencil-square">
                        </i>Update
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection
