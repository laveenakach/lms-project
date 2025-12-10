@extends('layouts.app')
@section('title', 'View Course')

@section('content')
<div class="card shadow-sm border-0 w-100 mx-auto" style="max-width: 900px;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-eye me-2"></i> View Course Details</h5>
        <div>
            <a href="{{ route('courses.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="card-body">
        <!-- Course Info -->
        <div class="row g-4">
            <div class="col-md-4 text-center">
                @if($course->thumbnail)
                    <img src="{{ asset('uploads/course_thumbnails/'.$course->thumbnail) }}" class="img-fluid rounded border mb-2" style="max-height: 200px;">
                @else
                    <img src="{{ asset('no-image.png') }}" class="img-fluid rounded border mb-2" style="max-height: 200px;">
                @endif
            </div>

            <div class="col-md-8">
                <h4 class="fw-bold text-primary mb-2">{{ $course->title }}</h4>
                <p class="mb-1"><strong>Trainer:</strong> {{ $course->trainer->name ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Student:</strong> {{ $course->student->name ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Status:</strong>
                    <span class="badge {{ $course->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($course->status) }}
                    </span>
                </p>
                <p class="mt-3"><strong>Description:</strong><br>{{ $course->description }}</p>
            </div>
        </div>

        <hr>

        <!-- Course Videos -->
        <h5 class="fw-bold text-primary mb-3"><i class="bi bi-camera-video me-2"></i>Course Videos</h5>
        @if($course->videos->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Video Link</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course->videos as $index => $video)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $video->title }}</td>
                                <td>{{ $video->description ?? '—' }}</td>
                                <td>
                                    @if($video->video_path)
                                        <!-- <a href="{{ asset('uploads/course_videos/'.$video->video_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-play-circle"></i> View
                                        </a> -->
                                        <video id="videoPlayer{{ $video->id }}" width="100%" controls>
                                        <source src="{{ asset('uploads/course_videos/'.$video->video_path) }}" type="video/mp4">
                                    </video>
                                    @elseif($video->video_url)
                                        <a href="{{ $video->video_url }}" target="_blank" class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-box-arrow-up-right"></i> Watch Online
                                        </a>
                                    @else
                                        <span class="text-muted">No video</span>
                                    @endif
                                </td>
                                <td>{{ $video->duration ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No videos available for this course.</p>
        @endif
    </div>
</div>
<script>
document.getElementById("videoPlayer{{ $video->id }}").addEventListener('ended', function () {
    fetch("{{ route('video.complete', $video->id) }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    });
});
</script>

@endsection
