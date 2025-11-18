@extends('admin.layouts.header')

@section('content')
    <div class="container-fluid">

        <h3 class="mb-4">General Website Settings</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="card mb-4">
                <div class="card-header">
                    <h5>Website Information</h5>
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Website Name</label>
                        <input type="text" name="website_name" class="form-control" value="{{ $settings->website_name }}">
                    </div>

                    {{-- Logo --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Website Logo</label>
                        <input type="file" name="logo" class="form-control">

                        @if($settings->logo)
                            <div class="mt-2">
                                <img src="{{ $settings->logo }}" alt="Logo" height="70">
                            </div>
                        @endif
                    </div>

                    {{-- Favicon --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Favicon</label>
                        <input type="file" name="favicon" class="form-control">

                        @if($settings->favicon)
                            <div class="mt-2">
                                <img src="{{ $settings->favicon }}" alt="Favicon" height="40">
                            </div>
                        @endif
                    </div>

                    {{-- Banner Image --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Background Banner Image</label>
                        <input type="file" name="banner_image" class="form-control">

                        @if($settings->banner_image)
                            <div class="mt-2">
                                <img src="{{ $settings->banner_image }}" alt="Banner" class="img-fluid rounded"
                                    style="max-height: 180px;">
                            </div>
                        @endif
                    </div>

                    {{-- Banner Video --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Background Banner Video (MP4 / WebM)</label>
                        <input type="file" name="banner_video" class="form-control">

                        @if($settings->banner_video)
                            <div class="mt-2">
                                <video width="320" controls>
                                    <source src="{{ $settings->banner_video }}">
                                </video>
                            </div>
                        @endif
                    </div>

                    <button class="btn btn-primary px-4">Save Settings</button>

                </div>
            </div>

        </form>

    </div>
@endsection