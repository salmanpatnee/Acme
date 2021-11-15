@extends('admin.layouts.app')

@push('styles')
    {{-- <style tr.unread td { font-weight: bold; color: #000; } </style> --}}
    @endpush @section('content') <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>All Inquiries</h2>
                </div>
                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <strong>{{ session('message') }}</strong><button type="button" class="close"
                                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;
                                </span></button>
                        </div>@endif @if (count($inquiries))<div class="table-responsive"><table class="table"><thead><tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600"><th class="px-4 py-3">Name</th><th class="px-4 py-3">Email</th><th class="px-4 py-3">Subject</th><th class="px-4 py-3">Action</th></tr></thead><tbody class="bg-white">@foreach ($inquiries as $inquiry)<tr class="text-gray-700 @if (!$inquiry->read_at) unread @endif"><td class="px-4 py-3 border">
                            {{ $inquiry->name }}</td>
                        <td class="px-4 py-3 border">{{ $inquiry->email }}</td>
                        <td class="px-4 py-3 border">{{ $inquiry->subject }}</td>
                        <td><a href="{{ route('inquiries.show', $inquiry->id) }}" class="btn btn-secondary "><span
                                    class="mdi mdi-eye"></span></a>
                            <form class="d-inline" action="{{ route('inquiries.destroy', $inquiry->id) }}"
                                method="post">@csrf @method('DELETE') <button class="btn btn-danger "><span
                                        class="mdi mdi-trash-can"></span></button></form>
                        </td>
                        </tr>
                    @endforeach </tbody>
                    </table>
            </div>{{-- <div class="mt-3">
                            {{ inquiries->links() }}
                        </div> --}} @else <div class="alert alert-info text-center mt-3" role="alert">No brands
                    found. </div>
                @endif
            </div>
        </div>
    </div>
</div>@endsection
