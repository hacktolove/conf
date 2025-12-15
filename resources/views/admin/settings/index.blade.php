@extends('admin.layouts.app')
@section('title', 'Settings')
@section('page-title', 'Site Settings')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h5 class="mb-4">General Settings</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Site Name</label>
                        <input type="text" class="form-control" name="settings[site_name]" value="{{ App\Models\SiteSetting::get('site_name', 'Evenza') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Site Tagline</label>
                        <input type="text" class="form-control" name="settings[site_tagline]" value="{{ App\Models\SiteSetting::get('site_tagline') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Site Description</label>
                        <textarea class="form-control" name="settings[site_description]" rows="2">{{ App\Models\SiteSetting::get('site_description') }}</textarea>
                    </div>
                </div>
            </div>

            <h5 class="mb-4 mt-4">Contact Information</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="settings[contact_email]" value="{{ App\Models\SiteSetting::get('contact_email') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="settings[contact_phone]" value="{{ App\Models\SiteSetting::get('contact_phone') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="settings[contact_address]" rows="2">{{ App\Models\SiteSetting::get('contact_address') }}</textarea>
                    </div>
                </div>
            </div>

            <h5 class="mb-4 mt-4">Social Links</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Facebook</label>
                        <input type="url" class="form-control" name="settings[social_facebook]" value="{{ App\Models\SiteSetting::get('social_facebook') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Twitter</label>
                        <input type="url" class="form-control" name="settings[social_twitter]" value="{{ App\Models\SiteSetting::get('social_twitter') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Instagram</label>
                        <input type="url" class="form-control" name="settings[social_instagram]" value="{{ App\Models\SiteSetting::get('social_instagram') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">LinkedIn</label>
                        <input type="url" class="form-control" name="settings[social_linkedin]" value="{{ App\Models\SiteSetting::get('social_linkedin') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">YouTube</label>
                        <input type="url" class="form-control" name="settings[social_youtube]" value="{{ App\Models\SiteSetting::get('social_youtube') }}">
                    </div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </div>
</div>
@endsection
