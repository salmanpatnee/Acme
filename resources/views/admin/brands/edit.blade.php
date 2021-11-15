@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Edit brand
                </div>
                <div class="card-body">
                    <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="old_image" value="{{ $brand->image }}">

                        <div class="form-group">
                            <input type="text" class="form-control  @error('name')  is-invalid @enderror" name="name"
                                placeholder="Name" value="{{ old('name', $brand->name) }}" required>

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="file" name="image" class="form-control  @error('image')  is-invalid @enderror"
                                value="{{ old('image', $brand->thumbnail) }}">
                            <div class="mt-3">
                                <img src="{{ $brand->thumbnail }}" class="img-fluid img-thumbnail" alt="">
                            </div>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
