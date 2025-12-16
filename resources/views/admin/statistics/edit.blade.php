@extends('admin.layouts.app')
@section('title', 'Edit Statistic')
@section('page-title', 'Edit Statistic')
@section('content')
<div class="card"><div class="card-body">
    <form action="{{ route('admin.statistics.update', $statistic) }}" method="POST">@csrf @method('PUT')
        <div class="row">
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Title *</label><input type="text" class="form-control" name="title" value="{{ old('title', $statistic->title) }}" required></div></div>
            <div class="col-md-3"><div class="mb-3"><label class="form-label">Value *</label><input type="text" class="form-control" name="value" value="{{ old('value', $statistic->value) }}" required></div></div>
            <div class="col-md-3"><div class="mb-3"><label class="form-label">Suffix</label><input type="text" class="form-control" name="suffix" value="{{ old('suffix', $statistic->suffix) }}"></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Icon (Bootstrap Icons class)</label><input type="text" class="form-control" name="icon" value="{{ old('icon', $statistic->icon) }}"></div></div>
            <div class="col-md-3"><div class="mb-3"><label class="form-label">Order</label><input type="number" class="form-control" name="order" value="{{ old('order', $statistic->order) }}"></div></div>
            <div class="col-md-3"><div class="mb-3 pt-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $statistic->is_active) ? 'checked' : '' }}><label class="form-check-label">Active</label></div></div></div>
        </div>
        <hr><div class="d-flex justify-content-between"><a href="{{ route('admin.statistics.index') }}" class="btn btn-secondary">Cancel</a><button type="submit" class="btn btn-primary">Update</button></div>
    </form>
</div></div>
@endsection
