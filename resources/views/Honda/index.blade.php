@extends('home.parent')


@section('content')
    <div class="row">
        @if (session('succes'))
            <div class="alert alert-success mt-3">
                <ul>
                    <i class="bi bi-check-circle">
                        {{ session('succes') }}
                    </i>
                </ul>
            </div>
        @endif
        <div class="card p-4">
            <div class="card-title d-flex justify-content-center"
                style="background-repeat: no-repeat; background-image: url({{ asset('admin/assets/img/card.jpg') }})">
                <h1>Honda</h1>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('honda.create') }}" class="btn btn-primary"> Create</a>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h5>Data Honda</h5>
                </div>
                <table class="table data-table">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($honda as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->slug }}</td>
                                <td><i class="bi bi-arrow-right"></i></td>
                                <td class="d-flex justify-content-evenly">
                                    <!-- Basic Modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#basicModal{{ $row->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    @include('home.includes.modal-show')
                                    <a href="{{ route('honda.edit', $row->id) }}" class="btn btn-warning "><i
                                            class="bi bi-pencil-square"></i></a>

                                    {{-- Button delet cateogry destroy  route destroy --}}

                                    <form action="{{ route('honda.destroy', $row->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </form>

                                    <!-- End Basic Modal-->
                                </td>
                            </tr>
                        @empty
                            <p>Belom ada data</p>
                        @endforelse
                    </tbody>
                </table>
                {{ $honda->links('pagination::bootstrap-5') }}

            </div>
        </div>
    @endsection
