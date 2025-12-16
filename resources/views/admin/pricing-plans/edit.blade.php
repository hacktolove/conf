@extends('admin.layouts.app')
@section('title', 'Edit Pricing Plan')
@section('page-title', 'Edit Pricing Plan')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pricing-plans.update', $pricingPlan) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6"><div class="mb-3"><label class="form-label">Plan Name *</label><input type="text" class="form-control" name="name" value="{{ old('name', $pricingPlan->name) }}" required></div></div>
                <div class="col-md-3"><div class="mb-3"><label class="form-label">Price *</label><input type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $pricingPlan->price) }}" required></div></div>
                <div class="col-md-3"><div class="mb-3"><label class="form-label">Currency</label><input type="text" class="form-control" name="currency" value="{{ old('currency', $pricingPlan->currency) }}"></div></div>
                <div class="col-md-6"><div class="mb-3"><label class="form-label">Duration</label><input type="text" class="form-control" name="duration" value="{{ old('duration', $pricingPlan->duration) }}"></div></div>
                <div class="col-md-6"><div class="mb-3"><label class="form-label">Order</label><input type="number" class="form-control" name="order" value="{{ old('order', $pricingPlan->order) }}"></div></div>
                <div class="col-md-12"><div class="mb-3"><label class="form-label">Description</label><textarea class="form-control" name="description" rows="2">{{ old('description', $pricingPlan->description) }}</textarea></div></div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Features</label>
                        <div id="features-container">
                            @foreach($pricingPlan->features ?? [] as $feature)
                            <div class="input-group mb-2"><input type="text" class="form-control" name="features[]" value="{{ $feature }}"><button type="button" class="btn btn-outline-danger remove-feature"><i class="bi bi-trash"></i></button></div>
                            @endforeach
                            <div class="input-group mb-2"><input type="text" class="form-control" name="features[]" placeholder="Add feature"><button type="button" class="btn btn-outline-secondary add-feature"><i class="bi bi-plus"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"><div class="mb-3"><label class="form-label">Button Text</label><input type="text" class="form-control" name="button_text" value="{{ old('button_text', $pricingPlan->button_text) }}"></div></div>
                <div class="col-md-6"><div class="mb-3"><label class="form-label">Button Link</label><input type="text" class="form-control" name="button_link" value="{{ old('button_link', $pricingPlan->button_link) }}"></div></div>
                <div class="col-md-12">
                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured', $pricingPlan->is_featured) ? 'checked' : '' }}><label class="form-check-label">Featured</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $pricingPlan->is_active) ? 'checked' : '' }}><label class="form-check-label">Active</label></div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.pricing-plans.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Plan</button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
document.querySelectorAll('.remove-feature').forEach(btn => btn.addEventListener('click', function() { this.closest('.input-group').remove(); }));
document.querySelector('.add-feature').addEventListener('click', function() {
    const container = document.getElementById('features-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = '<input type="text" class="form-control" name="features[]"><button type="button" class="btn btn-outline-danger remove-feature"><i class="bi bi-trash"></i></button>';
    container.insertBefore(div, container.lastElementChild);
    div.querySelector('.remove-feature').addEventListener('click', function() { div.remove(); });
});
</script>
@endpush
@endsection
