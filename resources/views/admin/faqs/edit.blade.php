@extends('admin.layouts.app')
@section('title', 'Edit FAQ')
@section('page-title', 'Edit FAQ')
@section('content')
<div class="card"><div class="card-body">
    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">@csrf @method('PUT')
        <div class="row">
            <div class="col-md-12"><div class="mb-3"><label class="form-label">Question *</label><input type="text" class="form-control" name="question" value="{{ old('question', $faq->question) }}" required></div></div>
            <div class="col-md-12"><div class="mb-3"><label class="form-label">Answer *</label><textarea class="form-control" name="answer" rows="5" required>{{ old('answer', $faq->answer) }}</textarea></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Category</label><input type="text" class="form-control" name="category" value="{{ old('category', $faq->category) }}"></div></div>
            <div class="col-md-3"><div class="mb-3"><label class="form-label">Order</label><input type="number" class="form-control" name="order" value="{{ old('order', $faq->order) }}"></div></div>
            <div class="col-md-3"><div class="mb-3 pt-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}><label class="form-check-label">Active</label></div></div></div>
        </div>
        <hr><div class="d-flex justify-content-between"><a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a><button type="submit" class="btn btn-primary">Update</button></div>
    </form>
</div></div>
@endsection
