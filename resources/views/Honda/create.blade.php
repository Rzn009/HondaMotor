@extends('home.parent')

@section('content')

<div class="row">

    <div class="card p-4">
        <h3>Honda create</h3>

        <form action="{{ route('honda.index') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="col-12">
                <label for="inputName" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="inputNanme4" name="name" value="{{ old('name') }}">
            </div>
            <div class="col-12">
                <label for="inputEmail4" class="form-label">Image</label>
                <input type="file" class="form-control" id="inputImage" name="image">
            </div>


            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save">
                    </i>
                </button>
            </div>
        </form>
    </div>

</div>

@endsection