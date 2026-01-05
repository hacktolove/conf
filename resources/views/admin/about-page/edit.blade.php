@extends('admin.layouts.app')
@section('title', 'About Page')
@section('page-title', 'Edit About Page')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.about-page.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h5 class="mb-4">Page Header</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Page Title (English)</label>
                        <input type="text" class="form-control" name="about_page_title" value="{{ App\Models\SiteSetting::get('about_page_title', __('messages.about_us_title')) }}">
                        <small class="text-muted">Leave empty to use default translation</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Page Title (Arabic)</label>
                        <input type="text" class="form-control" name="about_page_title_ar" value="{{ App\Models\SiteSetting::where('key', 'about_page_title')->first()->value_ar ?? '' }}" dir="rtl">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Page Subtitle (English)</label>
                        <input type="text" class="form-control" name="about_page_subtitle" value="{{ App\Models\SiteSetting::get('about_page_subtitle', __('messages.about_us_subtitle')) }}">
                        <small class="text-muted">Leave empty to use default translation</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Page Subtitle (Arabic)</label>
                        <input type="text" class="form-control" name="about_page_subtitle_ar" value="{{ App\Models\SiteSetting::where('key', 'about_page_subtitle')->first()->value_ar ?? '' }}" dir="rtl">
                    </div>
                </div>
            </div>

            <h5 class="mb-4 mt-4">About Image</h5>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">About Page Image</label>
                        <input type="file" class="form-control" name="about_page_image" accept="image/*">
                        @if($image = App\Models\SiteSetting::get('about_page_image'))
                        <div class="mt-2">
                            @php
                                $imageUrl = url('/storage/' . $image);
                            @endphp
                            <img src="{{ $imageUrl }}" alt="Current About Image" style="max-height: 300px; max-width: 100%;" class="img-thumbnail">
                            <p class="text-muted small mt-1">Current image path: {{ $image }}</p>
                        </div>
                        @else
                        <div class="mt-2">
                            <p class="text-muted small">No image uploaded. Default: images/about.jpg</p>
                        </div>
                        @endif
                        <small class="text-muted">Recommended size: 800x600px or similar aspect ratio. Supported formats: JPG, PNG, GIF</small>
                    </div>
                </div>
            </div>

            <h5 class="mb-4 mt-4">About Section Badge</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Badge Text (English)</label>
                        <input type="text" class="form-control" name="about_badge_text" value="{{ App\Models\SiteSetting::get('about_badge_text', __('messages.who_we_are')) }}">
                        <small class="text-muted">Leave empty to use default translation</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Badge Text (Arabic)</label>
                        <input type="text" class="form-control" name="about_badge_text_ar" value="{{ App\Models\SiteSetting::where('key', 'about_badge_text')->first()->value_ar ?? '' }}" dir="rtl">
                    </div>
                </div>
            </div>

            <h5 class="mb-4 mt-4">Values Section</h5>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> <strong>Note:</strong> Configure the three value cards displayed on the about page. Each card has a title, description, and icon.
            </div>

            <!-- Innovation Card -->
            <div class="card mb-4">
                <div class="card-header bg-primary-subtle">
                    <h6 class="mb-0"><i class="bi bi-lightbulb"></i> Innovation Card</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title (English)</label>
                                <input type="text" class="form-control" name="about_value_innovation_title" value="{{ App\Models\SiteSetting::get('about_value_innovation_title', __('messages.innovation')) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title (Arabic)</label>
                                <input type="text" class="form-control" name="about_value_innovation_title_ar" value="{{ App\Models\SiteSetting::where('key', 'about_value_innovation_title')->first()->value_ar ?? '' }}" dir="rtl">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Description (English)</label>
                                <textarea class="form-control" name="about_value_innovation_description" rows="3">{{ App\Models\SiteSetting::get('about_value_innovation_description', __('messages.innovation_description')) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Description (Arabic)</label>
                                <textarea class="form-control" name="about_value_innovation_description_ar" rows="3" dir="rtl">{{ App\Models\SiteSetting::where('key', 'about_value_innovation_description')->first()->value_ar ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Icon (Bootstrap Icons class)</label>
                                <input type="text" class="form-control" name="about_value_innovation_icon" value="{{ App\Models\SiteSetting::get('about_value_innovation_icon', 'bi-lightbulb') }}" placeholder="e.g., bi-lightbulb">
                                <small class="text-muted">Use Bootstrap Icons class name (e.g., bi-lightbulb, bi-people, bi-award)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Community Card -->
            <div class="card mb-4">
                <div class="card-header bg-primary-subtle">
                    <h6 class="mb-0"><i class="bi bi-people"></i> Community Card</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title (English)</label>
                                <input type="text" class="form-control" name="about_value_community_title" value="{{ App\Models\SiteSetting::get('about_value_community_title', __('messages.community')) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title (Arabic)</label>
                                <input type="text" class="form-control" name="about_value_community_title_ar" value="{{ App\Models\SiteSetting::where('key', 'about_value_community_title')->first()->value_ar ?? '' }}" dir="rtl">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Description (English)</label>
                                <textarea class="form-control" name="about_value_community_description" rows="3">{{ App\Models\SiteSetting::get('about_value_community_description', __('messages.community_description')) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Description (Arabic)</label>
                                <textarea class="form-control" name="about_value_community_description_ar" rows="3" dir="rtl">{{ App\Models\SiteSetting::where('key', 'about_value_community_description')->first()->value_ar ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Icon (Bootstrap Icons class)</label>
                                <input type="text" class="form-control" name="about_value_community_icon" value="{{ App\Models\SiteSetting::get('about_value_community_icon', 'bi-people') }}" placeholder="e.g., bi-people">
                                <small class="text-muted">Use Bootstrap Icons class name (e.g., bi-lightbulb, bi-people, bi-award)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Excellence Card -->
            <div class="card mb-4">
                <div class="card-header bg-primary-subtle">
                    <h6 class="mb-0"><i class="bi bi-award"></i> Excellence Card</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title (English)</label>
                                <input type="text" class="form-control" name="about_value_excellence_title" value="{{ App\Models\SiteSetting::get('about_value_excellence_title', __('messages.excellence')) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title (Arabic)</label>
                                <input type="text" class="form-control" name="about_value_excellence_title_ar" value="{{ App\Models\SiteSetting::where('key', 'about_value_excellence_title')->first()->value_ar ?? '' }}" dir="rtl">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Description (English)</label>
                                <textarea class="form-control" name="about_value_excellence_description" rows="3">{{ App\Models\SiteSetting::get('about_value_excellence_description', __('messages.excellence_description')) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Description (Arabic)</label>
                                <textarea class="form-control" name="about_value_excellence_description_ar" rows="3" dir="rtl">{{ App\Models\SiteSetting::where('key', 'about_value_excellence_description')->first()->value_ar ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Icon (Bootstrap Icons class)</label>
                                <input type="text" class="form-control" name="about_value_excellence_icon" value="{{ App\Models\SiteSetting::get('about_value_excellence_icon', 'bi-award') }}" placeholder="e.g., bi-award">
                                <small class="text-muted">Use Bootstrap Icons class name (e.g., bi-lightbulb, bi-people, bi-award)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Save About Page Content</button>
        </form>
    </div>
</div>
@endsection

