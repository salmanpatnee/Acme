@extends('admin.layouts.app')
@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Inquiry</h2>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $inquiry->name }}</p>
                    <hr>
                    <p><strong>Email:</strong> {{ $inquiry->email }}</p>
                    <hr>
                    <p><strong>Subject:</strong> {{ $inquiry->subject }}</p>
                    <hr>
                    <p><strong>Message:</strong> {{ $inquiry->message }}</p>
                    <hr>
                    <a class="mb-1 btn btn-info" href="{{ route('inquiries.index') }}">Back</a>
                </div>
            </div>


        </div>
    </div>
@endsection
