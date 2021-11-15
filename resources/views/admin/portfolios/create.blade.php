@extends('admin.layouts.app')
@section('content')
    <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data">
        <div class="row">

            @csrf
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Add New Portfolio</h2>
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <input type="file" name="image" id="image"
                                class="form-control  @error('image')  is-invalid @enderror">

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
                            <textarea name="description" id="description" placeholder="Description"
                                class="form-control  @error('description')  is-invalid @enderror">{{ old('description') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control  @error('client')  is-invalid @enderror" name="client"
                                placeholder="Client" value="{{ old('client') }}">

                            @error('client')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="date" class="form-control  @error('date')  is-invalid @enderror" name="date"
                                placeholder="Date" value="{{ old('date') }}">

                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="url" class="form-control  @error('url')  is-invalid @enderror" name="url"
                                placeholder="URL" value="{{ old('url') }}">

                            @error('url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>

                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Categories</h2>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            @foreach ($categories as $category)
                                <label class="control control-checkbox">{{ $category->name }}
                                    <input type="checkbox" value="{{ $category->id }}" name="category_id[]"
                                        {{ is_array(old('category_id')) && in_array($category->id, old('category_id')) ? ' checked' : '' }}>
                                    <div class="control-indicator"></div>
                                </label>
                            @endforeach
                            @error('category_id[]')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </form>
@endsection
