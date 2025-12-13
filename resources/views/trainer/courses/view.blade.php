@extends('layouts.app')
@section('title', 'View Course')

@section('content')
<div class="container py-4">

<div class="card shadow border-0 mx-auto" style="max-width: 950px;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0">
                <i class="bi bi-journal-bookmark me-2"></i> Course Overview
            </h5>

            <a href="{{ route('trainer.courses') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body p-4">

            <!-- Course Info Row -->
            <div class="row g-4">

                <!-- Thumbnail -->
                <div class="col-md-4 text-center">
                    @if($course->thumbnail)
                        <img src="{{ asset('uploads/course_thumbnails/'.$course->thumbnail) }}"
                             class="img-fluid rounded border"
                             style="max-height: 220px; width: 100%; object-fit: cover;">
                    @else
                        <img src="{{ asset('no-image.png') }}"
                             class="img-fluid rounded border"
                             style="max-height: 220px; width: 100%; object-fit: cover;">
                    @endif
                </div>

                <!-- Course Details -->
                <div class="col-md-8">
                    <h3 class="fw-bold text-primary">{{ $course->title }}</h3>

                    <p class="mb-1">
                        <strong>Trainer:</strong> {{ $course->trainer->name ?? 'N/A' }}
                    </p>
                    <p class="mb-1">
                        <strong>Student:</strong> {{ $student->name ?? 'N/A' }}
                    </p>
                    <p class="mb-1">
                        <strong>Status:</strong>
                        <span class="badge bg-success">{{ ucfirst($course->status) }}</span>
                    </p>

                    <p class="mt-3">
                        <strong>Description:</strong><br>
                        {{ $course->description ?? 'No description available.' }}
                    </p>

                    <!-- Progress Boxes -->
                    <div class="row text-center mt-3">
                        <div class="col-md-6">
                            <div class="border rounded p-3 bg-light">
                                <h6 class="text-primary fw-bold mb-1">Video Completion</h6>
                                <h4 class="fw-bold">{{ $videoProgress }}%</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 bg-light">
                                <h6 class="text-primary fw-bold mb-1">Assignments</h6>
                                <h4 class="fw-bold">{{ $assignments->count() }}</h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <hr class="my-4">

            <!-- Course Videos -->
            <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-camera-video me-2"></i> Course Videos
            </h5>

            @if($course->videos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered align-middle table-hover">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Watch</th>
                                <th>Duration</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($course->videos as $index => $video)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $video->title }}</td>
                                    <td>{{ $video->description ?? '—' }}</td>

                                    <td class="text-center">

                                        @if($video->video_path)
                                            <video id="videoPlayer{{ $video->id }}" width="200" controls>
                                                <source src="{{ asset('uploads/course_videos/'.$video->video_path) }}" type="video/mp4">
                                            </video>

                                        @elseif($video->video_url)
                                            <a href="{{ $video->video_url }}" target="_blank"
                                               class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-box-arrow-up-right"></i> Watch
                                            </a>

                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif

                                    </td>

                                    <td class="text-center">
                                        {{ $video->duration ?? 'N/A' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            @else
                <p class="text-muted">No videos uploaded yet.</p>
            @endif

            <hr>

            <!-- Assignments -->
            <h5 class="fw-bold text-primary mb-3 mt-4">
                <i class="bi bi-file-earmark-text me-2"></i> Assignments
            </h5>

            @if($assignments->count() > 0)
                <ul class="list-group">
                    @foreach($assignments as $assignment)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>
                                <strong>{{ $assignment->title }}</strong><br>
                                <small class="text-muted">{{ $assignment->description }}</small>
                            </span>

                            <span class="badge bg-info">{{ ucfirst($assignment->status) }}</span>

                            @if($assignment->file_path)
                                <a href="{{ asset('uploads/assignments/' . $assignment->file_path) }}" 
                                class="btn btn-sm btn-primary mt-2" 
                                target="_blank">
                                    <i class="bi bi-file-earmark-arrow-down"></i> View File
                                </a>
                            @else
                                <span class="text-muted d-block mt-2">No File Uploaded</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No assignments assigned yet.</p>
            @endif

            <!-- Projects -->
             <h5 class="fw-bold text-primary mb-3 mt-4">
                <i class="bi bi-file-earmark-text me-2"></i> Projects
            </h5>

            @if($projects->count() > 0)
                <ul class="list-group">
                    @foreach($projects as $project)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>
                                <strong>{{ $project->title }}</strong><br>
                                <small class="text-muted">{{ $project->description }}</small>
                            </span>

                            <span class="badge bg-info">{{ ucfirst($project->status) }}</span>

                            @if($project->file_path)
                                <a href="{{ asset('uploads/Projects/' . $project->file_path) }}" 
                                class="btn btn-sm btn-primary mt-2" 
                                target="_blank">
                                    <i class="bi bi-file-earmark-arrow-down"></i> View File
                                </a>
                            @else
                                <span class="text-muted d-block mt-2">No File Uploaded</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No assignments assigned yet.</p>
            @endif

        </div>
@endsection
