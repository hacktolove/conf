@extends('admin.layouts.app')
@section('title', 'View Message')
@section('page-title', 'View Message')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted">From</h6>
                <p><strong>{{ $contactMessage->name }}</strong><br>{{ $contactMessage->email }}<br>{{ $contactMessage->phone }}</p>
            </div>
            <div class="col-md-6 text-md-end">
                <h6 class="text-muted">Received</h6>
                <p>{{ $contactMessage->created_at->format('F d, Y \a\t H:i') }}</p>
            </div>
        </div>
        <hr>
        <h5>{{ $contactMessage->subject ?: 'No Subject' }}</h5>
        <div class="mt-3 p-3 bg-light rounded">
            {!! nl2br(e($contactMessage->message)) !!}
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">Back to Messages</a>
            <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->subject }}" class="btn btn-primary"><i class="bi bi-reply"></i> Reply via Email</a>
        </div>
    </div>
</div>
@endsection
