@extends('layouts.frontend')

@section('content')
{{-- Hero Section --}}
<section class="hero-section d-flex align-items-center text-center text-white" 
         style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/blog.webp') }}') center/cover no-repeat; height: 50vh;">
    <div class="container">
        <h1 class="display-4 fw-bold">Our Blogs & Insights</h1>
        <p class="lead mt-3">Explore the world of Data Science, AI, and Technology Trends</p>
    </div>
</section>

{{-- Blogs Section --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            {{-- Left Column: Blogs --}}
            <div class="col-lg-9">
                <h2 class="fw-bold mb-4">{{ $selectedCategory ? $selectedCategory->name . ' Articles' : 'Latest Articles' }}</h2>
                
                <div class="row g-4">
                    @forelse($blogs as $blog)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0 h-100 hover-lift">
                            <img src="{{ asset('uploads/blog_images/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 230px; object-fit: cover;">
                            <div class="card-body">
                                <small class="text-muted">
                                    <i class="bi bi-folder2-open me-1"></i>{{ $blog->category->name ?? 'Uncategorized' }} |
                                    <i class="bi bi-calendar3 me-1"></i>{{ $blog->created_at->format('M d, Y') }}
                                </small>
                                <h5 class="fw-bold mt-2">{{ $blog->title }}</h5>
                                <p class="text-muted small">{{ Str::limit($blog->short_description, 100) }}</p>
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-outline-primary btn-sm mt-2">
                                    Read More <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No blogs found in this category.</p>
                    </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-5">
                    {{ $blogs->appends(['category' => request('category')])->links() }}
                </div>
            </div>

            {{-- Right Column: Categories Sidebar --}}
            <div class="col-lg-3">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white fw-semibold">
                        <i class="bi bi-list me-2"></i> Blog Categories
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('blogs.index') }}" 
                           class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                           All Articles
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('blogs.index', ['category' => $category->name]) }}"
                               class="list-group-item list-group-item-action {{ request('category') == $category->name ? 'active' : '' }}">
                               {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
