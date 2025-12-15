@extends('admin.layouts.app')
@section('title', 'Statistics')
@section('page-title', 'Statistics')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center"><span>All Statistics</span><a href="{{ route('admin.statistics.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Add Statistic</a></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Title</th><th>Value</th><th>Suffix</th><th>Icon</th><th>Status</th><th width="150">Actions</th></tr></thead>
                <tbody>
                    @forelse($statistics as $stat)
                    <tr>
                        <td><strong>{{ $stat->title }}</strong></td>
                        <td>{{ $stat->value }}</td>
                        <td>{{ $stat->suffix }}</td>
                        <td><i class="{{ $stat->icon }}"></i> {{ $stat->icon }}</td>
                        <td><span class="badge {{ $stat->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $stat->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.statistics.edit', $stat) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.statistics.destroy', $stat) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty<tr><td colspan="6" class="text-center py-4 text-muted">No statistics found</td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
