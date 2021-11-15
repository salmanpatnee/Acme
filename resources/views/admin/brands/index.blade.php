@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4">

            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Add New Brand</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control  @error('name')  is-invalid @enderror" name="name"
                                placeholder="Name" required>

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="file" name="image" class="form-control  @error('image')  is-invalid @enderror"
                                required>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>All Brands</h2>
                </div>
                <div class="card-body">


                    @if (count($brands))
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr
                                        class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                        <th class="px-4 py-3">Name</th>
                                        <th class="px-4 py-3">Image</th>
                                        <th class="px-4 py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($brands as $brand)
                                        <tr class="text-gray-700">
                                            <td class="px-4 py-3 border">{{ $brand->name }}</td>
                                            <td class="px-4 py-3 border">
                                                <img src="{{ $brand->thumbnail }}" class="img-thumbnail mx-auto"
                                                    width="100">
                                            </td>
                                            <td>
                                                <a href="{{ route('brands.edit', $brand->id) }}"
                                                    class="btn btn-secondary ">
                                                    <span class="mdi mdi-circle-edit-outline"></span>
                                                </a>
                                                <form class="d-inline"
                                                    action="{{ route('brands.destroy', $brand->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger ">
                                                        <span class="mdi mdi-trash-can"></span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $brands->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center mt-3" role="alert">
                            No brands found.
                        </div>
                    @endif
                </div>
            </div>


        </div>
    </div>
@endsection
