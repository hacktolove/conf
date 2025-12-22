@extends('admin.layouts.app')

@section('title', 'Hero Slides')
@section('page-title', 'Hero Slides')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>All Hero Slides</span>
        <a href="{{ route('admin.hero-slides.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Add Slide
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="80">Image</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Selected</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slides as $slide)
                    <tr class="{{ $slide->is_selected ? 'table-success' : '' }}">
                        <td>
                            @if($slide->image)
                                <img src="{{ asset('storage/' . $slide->image) }}" alt="" class="rounded" style="width: 70px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 70px; height: 50px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $slide->title }}</strong></td>
                        <td>{{ Str::limit($slide->subtitle, 50) }}</td>
                        <td>{{ $slide->order }}</td>
                        <td>
                            <span class="badge {{ $slide->is_active ? 'badge-active' : 'badge-inactive' }}">
                                {{ $slide->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            @if($slide->is_selected)
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle"></i> Selected
                                </span>
                            @else
                                <span class="badge bg-secondary">Not Selected</span>
                            @endif
                        </td>
                        <td>
                            @if(!$slide->is_selected)
                            <form action="{{ route('admin.hero-slides.select', $slide) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" title="Select this slide">
                                    <i class="bi bi-check-circle"></i> Select
                                </button>
                            </form>
                            @endif
                            <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                        <td colspan="7" class="text-center py-4 text-muted">No slides found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
