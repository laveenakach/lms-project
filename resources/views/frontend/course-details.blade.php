@extends('layouts.frontend')

@section('title', $course->title)

@section('content')
{{-- Hero Section --}}
<section class="hero-section d-flex align-items-center text-center text-white"
    style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
         url('{{ asset('images/futuristic-artificial-intelligence.jpg') }}') center/cover no-repeat; height: 50vh;">
    <div class="container">
        <h1 class="display-4 fw-bold">Our Courses Details</h1>
        <p class="lead mt-3">Learn Data Science, Machine Learning & AI from Industry Experts</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <img src="{{ $course->thumbnail ? asset('uploads/course_thumbnails/'.$course->thumbnail) : asset('images/default-course.jpg') }}" 
                     class="img-fluid rounded shadow-sm" alt="{{ $course->title }}">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold text-primary">{{ $course->title }}</h2>
                <p class="text-muted">{{ $course->description }}</p>
                @if($course->trainer)
                    <p><strong>Trainer:</strong> {{ $course->trainer->name }}</p>
                @endif
                <p><strong>Total Videos:</strong> {{ $course->videos->count() }}</p>
                <a href="{{ route('frontend.courses') }}" class="btn btn-outline-primary btn-sm mt-3">
                    <i class="bi bi-arrow-left"></i> Back to Courses
                </a>
            </div>
        </div>

        <div class="mt-4">
            <h4 class="fw-bold mb-3">Course Videos</h4>
            @if($videos->count() > 0)
                <div class="row g-3">
                    @foreach($videos as $video)
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body">
                                    <h6 class="fw-semibold">{{ $video->title }}</h6>
                                    <video width="100%" height="200" controls class="rounded">
                                        <source src="{{ asset('uploads/course_videos/'.$video->video_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No videos available for this course yet.</p>
            @endif
        </div>

        {{-- ✅ Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $videos->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
@endsection
