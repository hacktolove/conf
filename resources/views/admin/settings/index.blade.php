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
                        <label class="form-label">Site Name (English)</label>
                        <input type="text" class="form-control" name="settings[site_name]" value="{{ App\Models\SiteSetting::get('site_name', 'Evenza') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Site Name (Arabic)</label>
                        <input type="text" class="form-control" name="settings_ar[site_name]" value="{{ App\Models\SiteSetting::where('key', 'site_name')->first()->value_ar ?? '' }}" dir="rtl">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Site Tagline (English)</label>
                        <input type="text" class="form-control" name="settings[site_tagline]" value="{{ App\Models\SiteSetting::get('site_tagline') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Site Tagline (Arabic)</label>
                        <input type="text" class="form-control" name="settings_ar[site_tagline]" value="{{ App\Models\SiteSetting::where('key', 'site_tagline')->first()->value_ar ?? '' }}" dir="rtl">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Site Logo</label>
                        <input type="file" class="form-control" name="settings[site_logo]" accept="image/*">
                        @if($logo = App\Models\SiteSetting::get('site_logo'))
                        <div class="mt-2">
                            @php
                                $logoUrl = url('/storage/' . $logo);
                            @endphp
                            <img src="{{ $logoUrl }}" alt="Current Logo" style="max-height: 60px; max-width: 200px;" class="img-thumbnail">
                            <p class="text-muted small mt-1">Current logo path: {{ $logo }}</p>
                            <p class="text-muted small">Full URL: {{ $logoUrl }}</p>
                        </div>
                        @endif
                        <small class="text-muted">Recommended size: 200x60px or similar aspect ratio. Supported formats: JPG, PNG, GIF, SVG</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Site Description (English)</label>
                        <textarea class="form-control" name="settings[site_description]" rows="2">{{ App\Models\SiteSetting::get('site_description') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Site Description (Arabic)</label>
                        <textarea class="form-control" name="settings_ar[site_description]" rows="2" dir="rtl">{{ App\Models\SiteSetting::where('key', 'site_description')->first()->value_ar ?? '' }}</textarea>
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
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Address (English)</label>
                        <textarea class="form-control" name="settings[contact_address]" rows="2">{{ App\Models\SiteSetting::get('contact_address') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Address (Arabic)</label>
                        <textarea class="form-control" name="settings_ar[contact_address]" rows="2" dir="rtl">{{ App\Models\SiteSetting::where('key', 'contact_address')->first()->value_ar ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <h5 class="mb-4 mt-4">Mission, Vision & Goal</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Mission (English)</label>
                        <textarea class="form-control" name="settings[mission]" rows="3">{{ App\Models\SiteSetting::get('mission') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Mission (Arabic)</label>
                        <textarea class="form-control" name="settings_ar[mission]" rows="3" dir="rtl">{{ App\Models\SiteSetting::where('key', 'mission')->first()->value_ar ?? '' }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Vision (English)</label>
                        <textarea class="form-control" name="settings[vision]" rows="3">{{ App\Models\SiteSetting::get('vision') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Vision (Arabic)</label>
                        <textarea class="form-control" name="settings_ar[vision]" rows="3" dir="rtl">{{ App\Models\SiteSetting::where('key', 'vision')->first()->value_ar ?? '' }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Goal (English)</label>
                        <textarea class="form-control" name="settings[goal]" rows="3">{{ App\Models\SiteSetting::get('goal') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Goal (Arabic)</label>
                        <textarea class="form-control" name="settings_ar[goal]" rows="3" dir="rtl">{{ App\Models\SiteSetting::where('key', 'goal')->first()->value_ar ?? '' }}</textarea>
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

            <h5 class="mb-4 mt-4">Speaker Reveal Settings</h5>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> <strong>Note:</strong> The speaker will be automatically revealed on the home page when there is less than 1 hour remaining until the reveal date. Before that time, only a countdown timer will be displayed.
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Speaker Reveal Date & Time</label>
                        <input type="datetime-local" class="form-control" name="settings[speaker_reveal_date]" value="{{ App\Models\SiteSetting::get('speaker_reveal_date') ? date('Y-m-d\TH:i', strtotime(App\Models\SiteSetting::get('speaker_reveal_date'))) : '' }}">
                        <small class="text-muted">When the speaker will be revealed on the home page. The speaker details will automatically appear when less than 1 hour remains.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Upcoming Speaker</label>
                        <select class="form-control" name="settings[speaker_reveal_speaker_id]">
                            <option value="">-- Select Speaker --</option>
                            @foreach(\App\Models\Speaker::active()->orderBy('name')->get() as $speaker)
                                <option value="{{ $speaker->id }}" {{ App\Models\SiteSetting::get('speaker_reveal_speaker_id') == $speaker->id ? 'selected' : '' }}>
                                    {{ $speaker->name }} @if($speaker->title) - {{ $speaker->title }} @endif
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Select the speaker to be revealed (will show automatically when less than 1 hour remains)</small>
                    </div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </div>
</div>
@endsection
