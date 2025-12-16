@extends('admin.layouts.app')
@section('title', 'Add Statistic')
@section('page-title', 'Add Statistic')
@section('content')
<div class="card"><div class="card-body">
    <form action="{{ route('admin.statistics.store') }}" method="POST">@csrf
        <div class="row">
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Title *</label><input type="text" class="form-control" name="title" value="{{ old('title') }}" required placeholder="e.g., Attendees"></div></div>
            <div class="col-md-3"><div class="mb-3"><label class="form-label">Value *</label><input type="text" class="form-control" name="value" value="{{ old('value') }}" required placeholder="e.g., 15000"></div></div>
            <div class="col-md-3"><div class="mb-3"><label class="form-label">Suffix</label><input type="text" class="form-control" name="suffix" value="{{ old('suffix') }}" placeholder="e.g., +"></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Icon (Bootstrap Icons class)</label><input type="text" class="form-control" name="icon" value="{{ old('icon') }}" placeholder="e.g., bi bi-people"></div></div>
            <div class="col-md-3"><div class="mb-3"><label class="form-label">Order</label><input type="number" class="form-control" name="order" value="{{ old('order', 0) }}"></div></div>
            <div class="col-md-3"><div class="mb-3 pt-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}><label class="form-check-label">Active</label></div></div></div>
        </div>
        <hr><div class="d-flex justify-content-between"><a href="{{ route('admin.statistics.index') }}" class="btn btn-secondary">Cancel</a><button type="submit" class="btn btn-primary">Create</button></div>
    </form>
</div></div>
@endsection
