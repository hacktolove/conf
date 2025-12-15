@extends('admin.layouts.app')

@section('title', 'Speakers')
@section('page-title', 'Speakers')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>All Speakers</span>
        <a href="{{ route('admin.speakers.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Add Speaker
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="60">Photo</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($speakers as $speaker)
                    <tr>
                        <td>
                            @if($speaker->image)
                                <img src="{{ asset('storage/' . $speaker->image) }}" alt="" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-person text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $speaker->name }}</strong>
                            @if($speaker->is_featured)
                                <span class="badge bg-warning">Featured</span>
                            @endif
                        </td>
                        <td>{{ $speaker->title }}</td>
                        <td>{{ $speaker->company }}</td>
                        <td>
                            <span class="badge {{ $speaker->is_active ? 'badge-active' : 'badge-inactive' }}">
                                {{ $speaker->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.speakers.edit', $speaker) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.speakers.destroy', $speaker) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No speakers found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($speakers->hasPages())
    <div class="card-footer">
        {{ $speakers->links() }}
    </div>
    @endif
</div>
@endsection
