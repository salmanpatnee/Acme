@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Add New Slide</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('slides.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input type="file" name="image" id="image"
                                class="form-control  @error('image')  is-invalid @enderror" required>

                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control  @error('title')  is-invalid @enderror" name="title"
                                placeholder="Title" value="{{ old('title') }}">

                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea name="caption" id="caption" placeholder="Caption"
                                class="form-control  @error('caption')  is-invalid @enderror">{{ old('caption') }}</textarea>

                            @error('caption')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
