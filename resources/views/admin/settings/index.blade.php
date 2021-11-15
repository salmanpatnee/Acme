@php
use App\Models\Setting;
@endphp
@extends('admin.layouts.app')
@section('content')
    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Site Settings</h2>
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
                            <input type="hidden" name="old_logo" value="{{ $settings->logo }}">
                            <input type="file" name="logo" id="logo"
                                class="form-control  @error('logo')  is-invalid @enderror">

                            @error('logo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        @if ($settings->logo)
                            <div class="preview mb-3">
                                <img src="{{ asset($settings->logo) }}" alt="Logo" class="img-fluid img-thumbnail">
                            </div>
                        @endif

                        <div class="form-group">
                            <input type="text" name="site_title" id="site_title" placeholder="Site Title"
                                class="form-control  @error('site_title')  is-invalid @enderror"
                                value="{{ old('site_title', $settings->site_title) }}">


                            @error('site_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea name="map" id="map" placeholder="Google Map"
                                class="form-control  @error('map')  is-invalid @enderror">{{ old('map', $settings->map) }}</textarea>

                            @error('map')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="address" id="address" placeholder="Address"
                                class="form-control  @error('address')  is-invalid @enderror"
                                value="{{ old('address', $settings->address) }}">


                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" id="email" placeholder="Email"
                                class="form-control  @error('email')  is-invalid @enderror"
                                value="{{ old('email', $settings->email) }}">


                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="tel" name="phone" id="phone" placeholder="Phone"
                                class="form-control  @error('phone')  is-invalid @enderror"
                                value="{{ old('phone', $settings->phone) }}">


                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="copyright" id="copyright" placeholder="Copyright"
                                class="form-control  @error('copyright')  is-invalid @enderror"
                                value="{{ old('copyright', $settings->copyright) }}">


                            @error('copyright')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>

                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
