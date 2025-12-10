@extends('layouts.app')
@section('title', isset($course) ? 'Edit Course' : 'Add Course')

@section('content')
<div class="card shadow-sm border-0 w-100 mx-auto" style="max-width: 900px;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-journal-text me-2"></i>
            {{ isset($course) ? 'Edit Course' : 'Add Course' }}
        </h5>
        <a href="{{ route('courses.index') }}" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body">
        <form method="POST"
              action="{{ isset($course) ? route('courses.update', $course->id) : route('courses.store') }}"
              enctype="multipart/form-data">
            @csrf
            @if(isset($course)) @method('PUT') @endif

            <div class="row g-3">
                <!-- Course Title -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Course Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $course->title ?? '') }}"
                        class="form-control" placeholder="Enter course title" required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Trainer -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Assign Trainer <span class="text-danger">*</span></label>
                    <select name="trainer_id" class="form-select" required>
                        <option value="">-- Select Trainer --</option>
                        @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id }}"
                                {{ old('trainer_id', $course->trainer_id ?? '') == $trainer->id ? 'selected' : '' }}>
                                {{ $trainer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('trainer_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Trainer -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Assign Student <span class="text-danger">*</span></label>
                    <select name="student_id" class="form-select" required>
                        <option value="">-- Select Student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}"
                                {{ old('student_id', $course->student_id ?? '') == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Thumbnail -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Thumbnail <span class="text-danger">*</span></label>
                    <input type="file" name="thumbnail" class="form-control" {{ isset($course) ? '' : 'required' }}>
                    @if(isset($course) && $course->thumbnail)
                        <div class="mt-2">
                            <img src="{{ asset('uploads/course_thumbnails/'.$course->thumbnail) }}" alt="Thumbnail" width="120" class="rounded border">
                        </div>
                    @endif
                    @error('thumbnail')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                @if(auth()->user()->role == 'admin')
                    <div class="form-group">
                        <label class="form-label fw-semibold">Course Fee <span class="text-danger">*</span></label>
                        <input type="number" name="course_fee" class="form-control"
                            placeholder="Enter course fee" value="{{ $course->course_fee ?? '' }}" required>
                    </div>
                @endif

                <!-- Description -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control" rows="4" required>{{ old('description', $course->description ?? '') }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <hr class="my-4">

            <!-- Course Videos Section -->
            <h5 class="fw-bold mb-3 text-primary"><i class="bi bi-camera-reels me-2"></i>Course Videos</h5>

            <div id="video-section">
                <!-- Existing Videos -->
                @if(isset($course) && $course->videos->count() > 0)
                    @foreach($course->videos as $video)
                        <div class="row g-3 video-item align-items-end border-top pt-3">
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Title</label>
                                <input type="text" name="existing_videos[{{ $video->id }}][title]"
                                       value="{{ old('existing_videos.'.$video->id.'.title', $video->title) }}"
                                       class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Description</label>
                                <input type="text" name="existing_videos[{{ $video->id }}][description]"
                                       value="{{ old('existing_videos.'.$video->id.'.description', $video->description) }}"
                                       class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Replace Video (Optional)</label>
                                <input type="file" name="existing_videos[{{ $video->id }}][file]"
                                       class="form-control" accept="video/*">
                                @if($video->video_path)
                                    <a href="{{ asset('uploads/course_videos/'.$video->video_path) }}" target="_blank" class="d-block mt-2 text-decoration-none text-primary">
                                        <i class="bi bi-play-btn"></i> View Current Video
                                    </a>
                                @endif
                            </div>

                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Duration</label>
                                <input type="text" name="existing_videos[{{ $video->id }}][duration]"
                                       value="{{ old('existing_videos.'.$video->id.'.duration', $video->duration) }}"
                                       class="form-control" placeholder="e.g. 05:32">
                            </div>

                            <div class="col-md-1 text-end">
                                <button type="button" class="btn btn-danger btn-sm remove-existing-video" data-id="{{ $video->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif

                <!-- Add New Video Fields -->
                <div class="row g-3 video-item mt-3">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Video Title</label>
                        <input type="text" name="videos[0][title]" class="form-control" placeholder="Enter title">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Description</label>
                        <input type="text" name="videos[0][description]" class="form-control" placeholder="Short description">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Upload Video</label>
                        <input type="file" name="videos[0][file]" class="form-control" accept="video/*">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Duration</label>
                        <input type="text" name="videos[0][duration]" class="form-control" placeholder="e.g. 04:12">
                    </div>

                    <div class="col-md-1 text-end">
                        <button type="button" class="btn btn-danger btn-sm remove-video">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Add More Videos Button -->
            <div class="text-end mt-3">
                <button type="button" id="add-video" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Add Another Video
                </button>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-save me-1"></i>
                    {{ isset($course) ? 'Update Course' : 'Save Course' }}
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    let videoIndex = 1;

    // Add new video block
    document.getElementById('add-video').addEventListener('click', function () {
        const newVideo = `
            <div class="row g-3 video-item mt-3 border-top pt-3">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Video Title</label>
                    <input type="text" name="videos[${videoIndex}][title]" class="form-control" placeholder="Enter title">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Description</label>
                    <input type="text" name="videos[${videoIndex}][description]" class="form-control" placeholder="Short description">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Upload Video</label>
                    <input type="file" name="videos[${videoIndex}][file]" class="form-control" accept="video/*">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Duration</label>
                    <input type="text" name="videos[${videoIndex}][duration]" class="form-control" placeholder="e.g. 04:12">
                </div>
                <div class="col-md-1 text-end">
                    <button type="button" class="btn btn-danger btn-sm remove-video">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>`;
        document.getElementById('video-section').insertAdjacentHTML('beforeend', newVideo);
        videoIndex++;
    });

    // Remove new video block
    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-video')) {
            e.target.closest('.video-item').remove();
        }
    });

    // Remove existing video
    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-existing-video')) {
            const button = e.target.closest('.remove-existing-video');
            const id = button.dataset.id;
            if (confirm('Are you sure you want to delete this video?')) {
                button.closest('.video-item').remove();
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'delete_videos[]';
                input.value = id;
                document.querySelector('form').appendChild(input);
            }
        }
    });
});
</script>
@endsection
