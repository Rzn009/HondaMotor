@extends('home.parent')


@section('content')
    <div class="row">
        <div class="card p-4">
            <h3>Product</h3>
            <div class="d-flex justify-content-end ">
                <a href="{{ route('product.create') }}" class="btn btn-primary rounded ml-3 mx-2"> <i
                        class="bi bi-plus-circle mx-2"></i>Create </a>
            </div>
        </div>
        <div class="container">
            <div class="card p-3">
                <h5 class="card-title p-3">
                    Data News
                </h5>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($product as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->warna }}</td>
                                <td>
                                    <img src="{{ $row->image }}" alt="" class="img-thumbnail" width="60px">
                                </td>
                                <td>{{ $row->price }}</td>
                                <td>
                                    <button class="btn btn-info"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            @empty
                                <p>masih kosong</p>
                        @endforelse
                        </tr>
                    </tbody>
                </table>
                {{ $product->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
