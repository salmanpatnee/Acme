@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>All Slides</h2>
                    <a href="{{ route('slides.create') }}" class="mb-1 btn-sm btn btn-info">
                        <i class=" mdi mdi-image-plus mr-1"></i> Add New Slide</a>
                </div>
                <div class="card-body">


                    @if (count($slides))
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr
                                        class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                        <th class="px-4 py-3">Title</th>
                                        <th class="px-4 py-3">Caption</th>
                                        <th class="px-4 py-3">Image</th>
                                        <th class="px-4 py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($slides as $slide)
                                        <tr class="text-gray-700">
                                            <td class="px-4 py-3 border">{{ $slide->title }}</td>
                                            <td class="px-4 py-3 border">{{ Str::limit($slide->caption, 40) }}</td>
                                            <td class="px-4 py-3 border">
                                                <img src="{{ $slide->bannerUrl }}" class="img-thumbnail mx-auto"
                                                    width="200">
                                            </td>
                                            <td>
                                                <a href="{{ route('slides.edit', $slide->id) }}"
                                                    class="btn btn-secondary ">
                                                    <span class="mdi mdi-circle-edit-outline"></span>
                                                </a>
                                                <form class="d-inline"
                                                    action="{{ route('slides.destroy', $slide->id) }}" method="post">
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
                            {{ $slides->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center mt-3" role="alert">
                            No slides found.
                        </div>
                    @endif
                </div>
            </div>


        </div>
    </div>
@endsection
