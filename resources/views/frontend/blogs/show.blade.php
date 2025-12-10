@extends('layouts.frontend')

@section('content')

{{-- Hero Section --}}
<section class="hero-section d-flex align-items-center text-center text-white"
    style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/blog.webp') }}') center/cover no-repeat; height: 50vh;">
    <div class="container">
        <h1 class="display-4 fw-bold">Our Blogs datails</h1>
        <p class="lead mt-3">Explore the world of Data Science, AI, and Technology Trends</p>
    </div>
</section>

{{-- Blog Content --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm p-4">
                    <img src="{{ asset('uploads/blog_images/' . $blog->image) }}" class="img-fluid rounded mb-4" alt="{{ $blog->title }}">

                    <h1 class="display-5 fw-bold">{{ $blog->title }}</h1>
                    <p class="mt-3">
                        <i class="bi bi-folder2-open me-1"></i>{{ $blog->category->name ?? 'Uncategorized' }} |
                        <i class="bi bi-person-circle me-1"></i>{{ $blog->author ?? 'Admin' }} |
                        <i class="bi bi-calendar3 me-1"></i>{{ $blog->created_at->format('M d, Y') }}
                    </p>
                    <div class="blog-content">
                        {!! nl2br(e($blog->content)) !!}
                    </div>
                </div>

                {{-- Share / Back Buttons --}}
                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Blogs
                    </a>
                    <div>
                        <span class="me-2 fw-semibold">Share:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                            target="_blank" class="text-primary me-2"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}"
                            target="_blank" class="text-info me-2"><i class="bi bi-twitter-x fs-5"></i></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}"
                            target="_blank" class="text-primary"><i class="bi bi-linkedin fs-5"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection