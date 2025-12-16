@extends('admin.layouts.app')
@section('title', 'Testimonials')
@section('page-title', 'Testimonials')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>All Testimonials</span>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Add Testimonial</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th width="60">Photo</th><th>Name</th><th>Title</th><th>Rating</th><th>Status</th><th width="150">Actions</th></tr></thead>
                <tbody>
                    @forelse($testimonials as $t)
                    <tr>
                        <td>@if($t->image)<img src="{{ asset('storage/' . $t->image) }}" class="rounded-circle" style="width:50px;height:50px;object-fit:cover">@else<div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px"><i class="bi bi-person text-muted"></i></div>@endif</td>
                        <td><strong>{{ $t->name }}</strong></td>
                        <td>{{ $t->title }}</td>
                        <td>@for($i=1;$i<=$t->rating;$i++)<i class="bi bi-star-fill text-warning"></i>@endfor</td>
                        <td><span class="badge {{ $t->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $t->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty<tr><td colspan="6" class="text-center py-4 text-muted">No testimonials found</td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
