@extends('admin.layouts.app')
@section('title', 'Sponsors')
@section('page-title', 'Sponsors')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center"><span>All Sponsors</span><a href="{{ route('admin.sponsors.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Add Sponsor</a></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th width="80">Logo</th><th>Name</th><th>Tier</th><th>Status</th><th width="150">Actions</th></tr></thead>
                <tbody>
                    @forelse($sponsors as $sponsor)
                    <tr>
                        <td><img src="{{ asset('storage/' . $sponsor->logo) }}" class="rounded" style="width:70px;height:40px;object-fit:contain"></td>
                        <td><strong>{{ $sponsor->name }}</strong></td>
                        <td><span class="badge bg-info">{{ ucfirst($sponsor->tier) }}</span></td>
                        <td><span class="badge {{ $sponsor->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $sponsor->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.sponsors.edit', $sponsor) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.sponsors.destroy', $sponsor) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty<tr><td colspan="5" class="text-center py-4 text-muted">No sponsors found</td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
