@extends('layouts.frontend')

@section('content')

{{-- Hero Section --}}
<section class="hero-section d-flex align-items-center text-center text-white"
    style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/contact-us-image.jpg') }}') center/cover no-repeat; height: 55vh;">
    <div class="container">
        <h1 class="display-4 fw-bold">Contact Us</h1>
        <p class="lead mt-3">We’d love to hear from you — Let’s connect and build something great together!</p>
    </div>
</section>

{{-- Contact Info Section --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <h2 class="fw-bold">Get in Touch</h2>
            <p class="text-muted">Reach out for any questions, feedback, or partnership opportunities.</p>
        </div>

        <div class="row g-4">

            <!-- Office -->
            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm h-100 text-center">
                    <i class="bi bi-geo-alt text-primary display-5 mb-3"></i>
                    <h6 class="fw-bold">Our Office</h6>
                    <p class="text-muted mb-0">Plot No 39 Yeswant Colony, Alka Sheti Farm Kagal , Kolhapur, Maharashtra, India – 416216</p>
                </div>
            </div>

            <!-- Email -->
            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm h-100 text-center">
                    <i class="bi bi-envelope text-success display-5 mb-3"></i>
                    <h6 class="fw-bold">Email Us</h6>
                    <a href="mailto:adler@techadler.com"
                        class="contact-link">adler@techadler.com</a>
                </div>
            </div>

            <!-- Phone -->
            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm h-100 text-center">
                    <i class="bi bi-telephone text-danger display-5 mb-3"></i>
                    <h6 class="fw-bold">Call Us</h6>
                    <a href="tel:+919404621503" class="contact-link">+919404621503</a>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- Contact Form Section --}}
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold">Send Us a Message</h2>
        <p class="text-muted mb-4">
            Have questions about our courses or want to collaborate with us?
            Fill out the form below and we’ll get back to you shortly.
        </p>
        <div class="row align-items-center g-5">

            <div class="col-md-6">
                {{-- Flash & Validation Messages --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li><i class="bi bi-exclamation-triangle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label fw-semibold">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter subject" required value="{{ old('subject') }}">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label fw-semibold">Message</label>
                        <textarea id="message" name="message" rows="4" class="form-control" placeholder="Write your message..." required>{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-send me-2"></i>Send Message
                    </button>
                </form>
            </div>


            <div class="col-md-6">
                <div class="rounded shadow-sm overflow-hidden">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.982995225402!2d73.85674307472302!3d18.51844138257767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c06889edc6b9%3A0x4c0c3f097a9a8ed4!2sPune%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            new bootstrap.Alert(alert).close();
        }
    }, 4000);
</script>
@endsection


@endsection