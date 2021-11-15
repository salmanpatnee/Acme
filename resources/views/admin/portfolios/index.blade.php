@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>All Portfolios</h2>
                    <a href="{{ route('portfolios.create') }}" class="mb-1 btn-sm btn btn-info">
                        <i class=" mdi mdi-image-plus mr-1"></i> Add New Portfolio</a>
                </div>
                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (count($portfolios))
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr
                                        class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                        <th class="px-4 py-3">Title</th>
                                        <th class="px-4 py-3">Category</th>
                                        <th class="px-4 py-3">Image</th>
                                        <th class="px-4 py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($portfolios as $portfolio)

                                        <tr class="text-gray-700">
                                            <td class="px-4 py-3 border">{{ $portfolio->title }}</td>
                                            <td class="px-4 py-3 border">
                                                {{ $portfolio->categoriesList }}</td>
                                            <td class="px-4 py-3 border">
                                                <img src="{{ $portfolio->image }}" class="img-thumbnail mx-auto"
                                                    width="60">
                                            </td>
                                            <td>
                                                <a href="{{ route('portfolios.edit', $portfolio->id) }}"
                                                    class="btn btn-secondary ">
                                                    <span class="mdi mdi-circle-edit-outline"></span>
                                                </a>
                                                <form class="d-inline"
                                                    action="{{ route('portfolios.destroy', $portfolio->id) }}"
                                                    method="post">
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
                            {{ $portfolios->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center mt-3" role="alert">
                            No portfolios found.
                        </div>
                    @endif
                </div>
            </div>


        </div>
    </div>
@endsection
