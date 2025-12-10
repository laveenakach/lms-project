@extends('layouts.app')
@section('title', isset($certification) ? 'Edit Certification' : 'Add Certification')

@section('content')
<div class="card shadow-sm border-0 w-100 mx-auto" style="max-width: 700px;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-award me-2"></i>
            {{ isset($certification) ? 'Edit Certification' : 'Add Certification' }}
        </h5>
        <a href="{{ route('certifications.index') }}" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body">
        <form method="POST"
              action="{{ isset($certification) ? route('certifications.update', $certification->id) : route('certifications.store') }}"
              enctype="multipart/form-data">
            @csrf
            @if(isset($certification)) @method('PUT') @endif

            <div class="row g-3">
                <!-- Student -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Select Student</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">-- Select Student --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ isset($certification) && $certification->student_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Title -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Certification Title</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ old('title', $certification->title ?? '') }}" required>
                </div>

                <!-- Description -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="3"
                              placeholder="Enter certification details...">{{ old('description', $certification->description ?? '') }}</textarea>
                </div>

                <!-- File Upload -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Upload File (PDF/Image)</label>
                    <input type="file" name="file_path" class="form-control">
                    @if(isset($certification) && $certification->file_path)
                        <div class="mt-2">
                            <a href="{{ asset('uploads/certifications/' . $certification->file_path) }}" target="_blank">
                                <i class="bi bi-file-earmark-arrow-down"></i> View Current File
                            </a>
                        </div>
                    @endif
                </div>

                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save me-1"></i>
                        {{ isset($certification) ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
