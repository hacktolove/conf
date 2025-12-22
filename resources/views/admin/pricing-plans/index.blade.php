@extends('admin.layouts.app')
@section('title', 'Pricing Plans')
@section('page-title', 'Pricing Plans')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>All Pricing Plans</span>
        <a href="{{ route('admin.pricing-plans.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Add Plan</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Name</th><th>Price</th><th>Duration</th><th>Featured</th><th>Status</th><th width="150">Actions</th></tr></thead>
                <tbody>
                    @forelse($plans as $plan)
                    <tr>
                        <td><strong>{{ $plan->name }}</strong></td>
                        <td>{{ $plan->currency }} {{ number_format($plan->price, 2) }}</td>
                        <td>{{ $plan->duration }}</td>
                        <td>@if($plan->is_featured)<span class="badge bg-warning">Featured</span>@endif</td>
                        <td><span class="badge {{ $plan->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $plan->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.pricing-plans.edit', $plan) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.pricing-plans.destroy', $plan) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4 text-muted">No plans found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
