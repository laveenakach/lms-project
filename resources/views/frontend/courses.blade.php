@extends('layouts.frontend')

@section('content')

{{-- Hero Section --}}
<section class="hero-section d-flex align-items-center text-center text-white"
    style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
         url('{{ asset('images/futuristic-artificial-intelligence.jpg') }}') center/cover no-repeat; height: 50vh;">
    <div class="container">
        <h1 class="display-4 fw-bold">Our Courses</h1>
        <p class="lead mt-3">Learn Data Science, Machine Learning & AI from Industry Experts</p>
    </div>
</section>

{{-- Course Categories --}}
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Explore Course Categories</h2>
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="p-4 bg-white shadow-sm rounded h-100">
                    <i class="bi bi-graph-up-arrow text-primary display-5 mb-3"></i>
                    <h6>Data Science</h6>
                    <p class="small text-muted">Master data analysis, visualization, and predictive modeling.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-4 bg-white shadow-sm rounded h-100">
                    <i class="bi bi-cpu text-warning display-5 mb-3"></i>
                    <h6>Machine Learning</h6>
                    <p class="small text-muted">Build intelligent systems using supervised and unsupervised algorithms.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-4 bg-white shadow-sm rounded h-100">
                    <i class="bi bi-robot text-danger display-5 mb-3"></i>
                    <h6>Artificial Intelligence</h6>
                    <p class="small text-muted">Learn AI fundamentals, deep learning, and neural networks.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-4 bg-white shadow-sm rounded h-100">
                    <i class="bi bi-database text-success display-5 mb-3"></i>
                    <h6>Big Data Analytics</h6>
                    <p class="small text-muted">Handle large-scale data processing using Hadoop, Spark, and Python.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Featured Courses --}}
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Featured Courses</h2>

        <div class="row g-4">
            @foreach($courses as $course)
            <div class="col-md-3 col-sm-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="{{ $course->thumbnail ? asset('uploads/course_thumbnails/'.$course->thumbnail) : asset('images/default-user.png') }}"
                        class="card-img-top" alt="{{ $course->title }}">
                    <div class="card-body">
                        <h6 class="fw-bold">{{ $course->title }}</h6>
                        <p class="small">{{ Str::limit($course->description, 80) }}</p>

                        @if(Auth::check())
                        <a href="{{ route('frontend.course.details', $course->id) }}" class="btn btn-primary btn-sm">
                            View Details
                        </a>
                        @else
                        <a href="{{ route('register') }}" class="btn btn-warning btn-sm">Enroll Now</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if(Auth::check())
        {{-- ✅ Pagination --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $courses->links('pagination::bootstrap-5') }}
        </div>
         @else

         @endif
    </div>
</section>


{{-- Why Choose Us --}}
<section class="bg-light py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Why Learn with Data Science LMS?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 border rounded h-100">
                    <i class="bi bi-person-video3 text-primary display-5 mb-3"></i>
                    <h6>Expert Mentors</h6>
                    <p class="small text-muted">Learn from professionals with years of hands-on data science experience.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded h-100">
                    <i class="bi bi-laptop text-success display-5 mb-3"></i>
                    <h6>Practical Learning</h6>
                    <p class="small text-muted">Real-world projects and datasets to make you job-ready.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded h-100">
                    <i class="bi bi-award text-warning display-5 mb-3"></i>
                    <h6>Certification</h6>
                    <p class="small text-muted">Earn globally recognized certificates for your completed courses.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="cta-section text-center text-white py-5"
    style="background: linear-gradient(135deg, #6610f2, #007bff);">
    <div class="container">
        <h2 class="mb-4">Ready to Upskill in Data Science?</h2>
        @if(Auth::check())
        <a href="{{ route('courses.index') }}" class="btn btn-light btn-lg">Start Learning</a>
        @else
        <a href="{{ route('register') }}" class="btn btn-warning btn-lg">Join for Free</a>
        @endif
    </div>
</section>
@endsection