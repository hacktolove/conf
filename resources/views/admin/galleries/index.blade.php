@extends('admin.layouts.app')
@section('title', 'Gallery')
@section('page-title', 'Gallery')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center"><span>All Gallery Items</span><a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Add Item</a></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th width="80">Image</th><th>Title</th><th>Type</th><th>Category</th><th>Status</th><th width="150">Actions</th></tr></thead>
                <tbody>
                    @forelse($galleries as $item)
                    <tr>
                        <td><img src="{{ asset('storage/' . $item->image) }}" class="rounded" style="width:70px;height:50px;object-fit:cover"></td>
                        <td>{{ $item->title ?: 'No Title' }}</td>
                        <td><span class="badge {{ $item->type == 'video' ? 'bg-danger' : 'bg-primary' }}">{{ ucfirst($item->type) }}</span></td>
                        <td>{{ $item->category }}</td>
                        <td><span class="badge {{ $item->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $item->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.galleries.edit', $item) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty<tr><td colspan="6" class="text-center py-4 text-muted">No gallery items found</td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
