@extends('admin.layouts.app')
@section('title', 'Add Sponsor')
@section('page-title', 'Add Sponsor')
@section('content')
<div class="card"><div class="card-body">
    <form action="{{ route('admin.sponsors.store') }}" method="POST" enctype="multipart/form-data">@csrf
        <div class="row">
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Name *</label><input type="text" class="form-control" name="name" value="{{ old('name') }}" required></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Tier *</label><select class="form-select" name="tier" required><option value="platinum">Platinum</option><option value="gold">Gold</option><option value="silver">Silver</option><option value="standard" selected>Standard</option></select></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Logo *</label><input type="file" class="form-control" name="logo" accept="image/*" required></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Website</label><input type="url" class="form-control" name="website" value="{{ old('website') }}"></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Order</label><input type="number" class="form-control" name="order" value="{{ old('order', 0) }}"></div></div>
            <div class="col-md-6"><div class="mb-3 pt-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}><label class="form-check-label">Active</label></div></div></div>
        </div>
        <hr><div class="d-flex justify-content-between"><a href="{{ route('admin.sponsors.index') }}" class="btn btn-secondary">Cancel</a><button type="submit" class="btn btn-primary">Create</button></div>
    </form>
</div></div>
@endsection
