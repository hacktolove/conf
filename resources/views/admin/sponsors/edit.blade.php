@extends('admin.layouts.app')
@section('title', 'Edit Sponsor')
@section('page-title', 'Edit Sponsor')
@section('content')
<div class="card"><div class="card-body">
    <form action="{{ route('admin.sponsors.update', $sponsor) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
        <div class="row">
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Name *</label><input type="text" class="form-control" name="name" value="{{ old('name', $sponsor->name) }}" required></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Tier *</label><select class="form-select" name="tier" required>@foreach(['platinum','gold','silver','standard'] as $t)<option value="{{ $t }}" {{ $sponsor->tier == $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>@endforeach</select></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Logo</label>@if($sponsor->logo)<div class="mb-2"><img src="{{ asset('storage/' . $sponsor->logo) }}" class="img-thumbnail" style="max-height:80px"></div>@endif<input type="file" class="form-control" name="logo" accept="image/*"></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Website</label><input type="url" class="form-control" name="website" value="{{ old('website', $sponsor->website) }}"></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Order</label><input type="number" class="form-control" name="order" value="{{ old('order', $sponsor->order) }}"></div></div>
            <div class="col-md-6"><div class="mb-3 pt-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $sponsor->is_active) ? 'checked' : '' }}><label class="form-check-label">Active</label></div></div></div>
        </div>
        <hr><div class="d-flex justify-content-between"><a href="{{ route('admin.sponsors.index') }}" class="btn btn-secondary">Cancel</a><button type="submit" class="btn btn-primary">Update</button></div>
    </form>
</div></div>
@endsection
