@extends('home.parent')



@section('content')

<div class="container">
    <div class="ro">
        <h2>ini halaman edit</h2>

        <hr>

        <form action="{{route('honda.update', $honda->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-12">
                <label for="inputName" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="inputNanme4" name="name" value="{{ $honda->name }}">
            </div>
            <div class="col-12">
                <label for="inputEmail4" class="form-label">Image</label>
                <input type="file" class="form-control" id="inputImage" name="image">
            </div>


            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('honda.index') }}" class="btn btn-primary mx-3"><i class="bi bi-arrow-left"></i>Back</a>
                <button type="submit" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-square">
                    </i>Update
                </button>
            </div>

        </form>

    </div>
</div>

@endsection