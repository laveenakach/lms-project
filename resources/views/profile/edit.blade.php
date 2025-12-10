@extends('layouts.app')

@section('page_title', 'Update Profile')

@section('content')
<style>
    .profile-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        max-width: 700px;
        width: 100%;
        margin: 20px auto;
        padding: 20px;
        transition: all 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .profile-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .profile-header img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #6366f1;
    }

    .profile-header h3 {
        margin-top: 0px;
        font-size: 1.5rem;
        color: #374151;
        font-weight: 600;
    }

    .form-group label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        display: block;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #d1d5db;
        padding: 10px 14px;
        width: 100%;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        outline: none;
    }

    .btn-save {
        background: #6366f1;
        color: #fff;
        border: none;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-save:hover {
        background: #4f46e5;
    }

    .password-eye {
        position: absolute;
        right: 15px;
        top: 10px;
        cursor: pointer;
        color: #6b7280;
    }
</style>

<div class="profile-card">
    <div class="profile-header">
        <img src="{{ Auth::user()->photo ? asset('uploads/profile/'.$user->photo) : asset('images/default-user.png') }}" alt="Profile Photo">
        <h3>{{ Auth::user()->name }}</h3>
        <p class="text-gray-500 text-sm">{{ ucfirst(Auth::user()->role ?? 'User') }}</p>
    </div>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="form-control pr-10" placeholder="Enter new password (optional)">
                        <i class="bi bi-eye-slash password-eye" id="togglePassword"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Profile Picture</label>
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>

            <div class="text-center mt-6">
                <button type="submit" class="btn-save">
                    <i class="bi bi-save me-2"></i> Save Changes
                </button>
            </div>
    </form>
</div>

<script>
    // Password toggle visibility
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    });
</script>
@endsection