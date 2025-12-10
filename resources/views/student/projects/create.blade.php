@extends('layouts.app')
@section('title', isset($project->id) ? 'Edit Project' : 'Submit New Project')

@section('content')
<div class="card shadow-sm border-0 w-100 mx-auto" style="max-width: 700px;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-journal-plus me-2"></i>
            {{ isset($project->id) ? 'Edit Project' : 'Submit New Project' }}
        </h5>
        <a href="{{ route('student.projects.index') }}" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body">
        <form
            action="{{ route('student.projects.store', $project->id) }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @if(isset($project->id)) @method('POST') @endif

            <div class="row g-3">
                <!-- Select Student -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Select Student</label>
                    @if(Auth::user()->role === 'student')
                    {{-- Show student name (read-only) --}}
                    <input type="text"
                        class="form-control"
                        value="{{ Auth::user()->name }}"
                        readonly>

                    {{-- Hidden field to store student_id --}}
                    <input type="hidden"
                        name="student_id"
                        value="{{ Auth::id() }}">

                        <input type="hidden"
                        name="trainer_id"
                        value="{{ $project->trainer_id }}">

                        <input type="hidden"
                        name="status"
                        value="{{ 'Submitted' }}">
                        
                    @else
                    {{-- Trainer view: dropdown list --}}
                    <select name="student_id" class="form-select" required>
                        <option value="">-- Select Student --</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            {{ (isset($project) && $project->student_id == $user->id) ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                        @endforeach
                    </select>

                    <input type="hidden"
                        name="trainer_id"
                        value="{{ Auth::id() }}">

                    @endif
                </div>

                <!-- Project Title -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Project Title <span class="text-danger">*</span></label>
                    <input type="text"
                        name="title"
                        value="{{ old('title', $project->title) }}"
                        class="form-control"
                        placeholder="Enter project title" required>
                </div>

                <!-- Description -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" rows="4" class="form-control" placeholder="Enter project details...">{{ old('description', $project->description) }}</textarea>
                </div>

                <!-- Submission Date -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Submission Date</label>
                    <input type="date"
                        name="submission_date"
                        value="{{ old('submission_date', isset($project->submission_date) ? \Carbon\Carbon::parse($project->submission_date)->format('Y-m-d') : '') }}"
                        class="form-control">
                    @error('submission_date')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Upload File -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Upload File (PDF / DOC / ZIP)</label>
                    <input type="file" name="file" class="form-control">
                    @if(Auth::user()->role === 'trainer')
                    @if($project->file_path)
                    <p class="mt-2 mb-0">
                        <i class="bi bi-file-earmark-text me-1 text-secondary"></i>
                        <a href="{{ asset('storage/'.$project->file_path) }}"
                            target="_blank"
                            class="text-decoration-none">
                            View Current File
                        </a>
                    </p>
                    @endif
                    @endif

                    @error('file')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                @if(Auth::user()->role === 'trainer')
                <!-- Status -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="">-- Select Status --</option>
                        <option value="Assigned" {{ old('status', $project->status ?? '') == 'Assigned' ? 'selected' : '' }}>Assigned</option>
                        <option value="Submitted" {{ old('status', $project->status ?? '') == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                        <option value="Checked" {{ old('status', $project->status ?? '') == 'Checked' ? 'selected' : '' }}>Checked</option>
                        <option value="Approved" {{ old('status', $project->status ?? '') == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ old('status', $project->status ?? '') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                @endif

                <!-- Feedback -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Trainer Feedback</label>
                    <textarea name="feedback" rows="3" class="form-control" placeholder="Trainer's feedback or remarks..." @if(Auth::user()->role === 'student') readonly @endif >{{ old('feedback', $project->feedback ?? '') }}</textarea>
                </div>

                <!-- Buttons -->
                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save me-1"></i>
                        {{ 'Submit' }}
                    </button>
                    <a href="{{ route('student.projects.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection