@extends('admin.layouts.app')
@section('title', 'Add Pricing Plan')
@section('page-title', 'Add Pricing Plan')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pricing-plans.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Plan Name *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="price" class="form-label">Price *</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="currency" class="form-label">Currency</label>
                        <input type="text" class="form-control" id="currency" name="currency" value="{{ old('currency', 'USD') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration (e.g., Per Event, Monthly)</label>
                        <input type="text" class="form-control" id="duration" name="duration" value="{{ old('duration') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', 0) }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="2">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Features (one per line)</label>
                        <div id="features-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="features[]" placeholder="Feature">
                                <button type="button" class="btn btn-outline-secondary add-feature"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="button_text" class="form-label">Button Text</label>
                        <input type="text" class="form-control" id="button_text" name="button_text" value="{{ old('button_text', 'Buy Ticket') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="button_link" class="form-label">Button Link</label>
                        <input type="text" class="form-control" id="button_link" name="button_link" value="{{ old('button_link') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Featured</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.pricing-plans.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Plan</button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
document.querySelector('.add-feature').addEventListener('click', function() {
    const container = document.getElementById('features-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = '<input type="text" class="form-control" name="features[]" placeholder="Feature"><button type="button" class="btn btn-outline-danger remove-feature"><i class="bi bi-trash"></i></button>';
    container.appendChild(div);
    div.querySelector('.remove-feature').addEventListener('click', function() { div.remove(); });
});
</script>
@endpush
@endsection
