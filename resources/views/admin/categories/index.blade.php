@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Add Category</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
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
                            <textarea name="description" class="form-control" placeholder="Description"></textarea>

                            @error('description')
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
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>All Categories</h2>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">All ({{ count($categories) }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Trash
                                ({{ count($trashedCategories) }})</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                            @if (count($categories))
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr
                                                class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                                <th class="px-4 py-3">Name</th>
                                                <th class="px-4 py-3">Slug</th>
                                                <th class="px-4 py-3">Description</th>
                                                <th class="px-4 py-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach ($categories as $category)
                                                <tr class="text-gray-700">
                                                    <td class="px-4 py-3 border">{{ $category->name }}</td>
                                                    <td class="px-4 py-3 border">{{ $category->slug }}</td>
                                                    <td class="px-4 py-3 text-ms  border">
                                                        {{ $category->description }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('categories.edit', $category->id) }}"
                                                            class="btn btn-secondary btn-sm">
                                                            <span class="mdi mdi-circle-edit-outline"></span>
                                                        </a>
                                                        <form class="d-inline"
                                                            action="{{ route('categories.destroy', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm">
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
                                    {{ $categories->links() }}
                                </div>
                            @else
                                <div class="alert alert-info text-center mt-3" role="alert">
                                    No categories found.
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @if (count($trashedCategories))
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr
                                                class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                                <th class="px-4 py-3">Name</th>
                                                <th class="px-4 py-3">Slug</th>
                                                <th class="px-4 py-3">Description</th>
                                                <th class="px-4 py-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach ($trashedCategories as $category)
                                                <tr class="text-gray-700">
                                                    <td class="px-4 py-3 border">{{ $category->name }}</td>
                                                    <td class="px-4 py-3 border">{{ $category->slug }}</td>
                                                    <td class="px-4 py-3 text-ms  border">
                                                        {{ $category->description }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('categories.restore', $category) }}"
                                                            class="btn btn-secondary btn-sm">
                                                            <i class="fa fa-window-restore" aria-hidden="true"></i>
                                                        </a>
                                                        <form class="d-inline"
                                                            action="{{ route('categories.forceDestroy', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"
                                                                    aria-hidden="true"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $trashedCategories->links() }}
                                </div>

                            @else
                                <div class="alert alert-info text-center mt-3" role="alert">
                                    No categories found in trash.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
