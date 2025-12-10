@extends('layouts.app')
@section('title', isset($blog) ? 'Edit Blog' : 'Add Blog')

@section('content')
<div class="card shadow-sm border-0 w-100 mx-auto" style="max-width: 800px;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-journal-text me-2"></i>
            {{ isset($blog) ? 'Edit Blog' : 'Add New Blog' }}
        </h5>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body">
        <form method="POST"
            action="{{ isset($blog) ? route('admin.blogs.update', $blog->id) : route('admin.blogs.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if(isset($blog)) @method('PUT') @endif

            <div class="row g-3">
                <!-- Category -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Select Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ isset($blog) && $blog->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Title -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Blog Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter blog title"
                        value="{{ old('title', $blog->title ?? '') }}" required>
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Featured Image -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Featured Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if(isset($blog) && $blog->image)
                    <div class="mt-2">
                        <img src="{{ asset('uploads/blog_images/' . $blog->image) }}"
                            alt="Blog Image" width="120" class="rounded border">
                    </div>
                    @endif
                    @error('image')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Author -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Author Name</label>
                    <input type="text" name="author" class="form-control" placeholder="Enter author name"
                        value="{{ old('author', $blog->author ?? Auth::user()->name) }}">
                    @error('author')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Blog Content -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Content</label>
                    <textarea name="content" rows="6" class="form-control"
                        placeholder="Enter full blog content...">{{ old('content', $blog->content ?? '') }}</textarea>
                    @error('content')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="draft" {{ old('status', $blog->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $blog->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="col-12 text-end mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save me-1"></i>
                        {{ isset($blog) ? 'Update Blog' : 'Publish Blog' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection