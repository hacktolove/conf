@extends('admin.layouts.app')
@section('title', 'Add FAQ')
@section('page-title', 'Add FAQ')
@section('content')
<div class="card"><div class="card-body">
    <form action="{{ route('admin.faqs.store') }}" method="POST">@csrf
        <div class="row">
            <div class="col-md-12"><div class="mb-3"><label class="form-label">Question *</label><input type="text" class="form-control" name="question" value="{{ old('question') }}" required></div></div>
            <div class="col-md-12"><div class="mb-3"><label class="form-label">Answer *</label><textarea class="form-control" name="answer" rows="5" required>{{ old('answer') }}</textarea></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Category</label><input type="text" class="form-control" name="category" value="{{ old('category') }}"></div></div>
            <div class="col-md-3"><div class="mb-3"><label class="form-label">Order</label><input type="number" class="form-control" name="order" value="{{ old('order', 0) }}"></div></div>
            <div class="col-md-3"><div class="mb-3 pt-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}><label class="form-check-label">Active</label></div></div></div>
        </div>
        <hr><div class="d-flex justify-content-between"><a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a><button type="submit" class="btn btn-primary">Create</button></div>
    </form>
</div></div>
@endsection
