@extends('layouts.app')
@section('title', 'Create Notification')

@section('content')
<div class="card shadow-sm border-0 w-100 mx-auto" style="max-width: 700px;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Create Notification</h5>
        <a href="{{ route('notifications.index') }}" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.notifications.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Message</label>
                <textarea name="message" rows="4" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Date</label>
                <input type="date" name="date" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Attachment (optional)</label>
                <input type="file" name="attachment" class="form-control">
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-send"></i> Create
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
