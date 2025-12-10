@extends('layouts.frontend')

@section('content')

{{-- Hero Section --}}

<section class="hero-section d-flex align-items-center text-center text-white"
    style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
         url('{{ asset('images/Industry-trainer-program2.jpg') }}') center/cover no-repeat; height: 50vh;">
    <div class="container">
        <h1 class="display-4 fw-bold">Trainer Program</h1>
    </div>
</section>

{{-- Technologies Section --}}
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <h2 class="fw-bold mb-4">AdlerTech Trainer Program – Share Your Knowledge, Inspire the Next Generation</h2>
                <p> At AdlerTech Innovations, we believe great trainers create great tech talent.
                    This program is designed for passionate professionals who want to share expertise,
                    teach cutting-edge IT skills, and shape the future workforce.</p>
                <p>If you are an industry expert in Python Programming , Data Science, Full Stack Web Development, Microsoft Power BI, AI & Advanced Data Science, or other in-demand technologies, we invite you to join the AdlerTech Trainer Program as a corporate trainer or course instructor.</p>

            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/esyd_adults_teaching.jpg') }}" alt="Trainer Courses" style="width:750px;" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

{{-- Why Join Section --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Why Join the AdlerTech Trainer Program?</h2>
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <h5 class="fw-bold text-primary mb-2">Flexible Engagement</h5>
                    <p>Work part-time, full-time, or as a freelance trainer at your convenience.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <h5 class="fw-bold text-success mb-2">Industry Courses</h5>
                    <p>Teach high-demand technologies like Python, Data Science, and AI.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <h5 class="fw-bold text-danger mb-2">Attractive Compensation</h5>
                    <p>Earn per session or program with competitive trainer pay rates.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <h5 class="fw-bold text-info mb-2">Global Reach</h5>
                    <p>Train students and professionals across India and beyond.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Technologies Section --}}
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <img src="{{ asset('images/trainer-program-1.jpg') }}" alt="Trainer Courses" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-4">Technologies & Courses You Can Teach</h2>
                <ul class="list-unstyled">
                    <li>✅ Python Programming (Beginner to Advanced)</li>
                    <li>✅ Data Science with Python</li>
                    <li>✅ Full Stack Web Development (MERN / Laravel)</li>
                    <li>✅ Microsoft Power BI & Analytics</li>
                    <li>✅ AI & Advanced Data Science</li>
                    <li>✅ Cloud Computing, DevOps, and More</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Who Can Apply Section --}}
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-5">Who Can Apply?</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <i class="bi bi-briefcase display-4 text-primary mb-3"></i>
                <p>Minimum 2 years of industry or teaching experience.</p>
            </div>
            <div class="col-md-3">
                <i class="bi bi-megaphone display-4 text-success mb-3"></i>
                <p>Strong communication and presentation skills.</p>
            </div>
            <div class="col-md-3">
                <i class="bi bi-laptop display-4 text-danger mb-3"></i>
                <p>Ability to deliver practical, hands-on training sessions.</p>
            </div>
            <div class="col-md-3">
                <i class="bi bi-diagram-3 display-4 text-info mb-3"></i>
                <p>Familiarity with tools and real-world project workflows.</p>
            </div>
        </div>

        <h3 class="fw-bold mt-5 mb-4">How It Works</h3>
        <div class="row g-4">
            <div class="col-md-3">
                <i class="bi bi-person-lines-fill text-primary display-5 mb-2"></i>
                <h6>Apply Online</h6>
                <p>Submit your trainer profile and experience.</p>
            </div>
            <div class="col-md-3">
                <i class="bi bi-play-circle text-success display-5 mb-2"></i>
                <h6>Demo Session</h6>
                <p>Showcase your teaching and communication skills.</p>
            </div>
            <div class="col-md-3">
                <i class="bi bi-box-arrow-in-right text-danger display-5 mb-2"></i>
                <h6>Onboarding</h6>
                <p>Access our trainer portal, tools, and schedules.</p>
            </div>
            <div class="col-md-3">
                <i class="bi bi-lightbulb text-warning display-5 mb-2"></i>
                <h6>Start Teaching</h6>
                <p>Inspire learners and help them achieve success.</p>
            </div>
        </div>
    </div>
</section>

{{-- FAQ Section --}}
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordion">

            <div class="accordion-item">
                <h2 class="accordion-header" id="q1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#a1">
                        Do I need prior teaching experience to join?
                    </button>
                </h2>
                <div id="a1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        While prior teaching is preferred, industry professionals with strong subject expertise can also apply for our IT Trainer Jobs in India.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="q2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a2">
                        What subjects can I teach?
                    </button>
                </h2>
                <div id="a2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can teach any of our listed courses, including Python, Data Science, Web Development, AI, and Microsoft Power BI.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="q3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a3">
                        Can I work part-time as a trainer?
                    </button>
                </h2>
                <div id="a3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, our Corporate Trainer Opportunities include flexible part-time, weekend, and project-based roles.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="q4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a4">
                        Is the training conducted online or offline?
                    </button>
                </h2>
                <div id="a4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        We offer both online instructor-led training and classroom sessions depending on the course and location.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="q5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a5">
                        How do I apply?
                    </button>
                </h2>
                <div id="a5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Simply fill out our Trainer Program application form, and we’ll get in touch with you for the next steps.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Contact Section --}}
<section class="py-5 text-center text-white" style="background-color: #d05695;">
    <div class="container">
        <h2 class="fw-bold mb-4">Enroll Today & Transform Your Career</h2>
        <p class="mb-4">
            Join AdlerTech Innovations — the Best IT Company in India for Industry Trainer Program —
            and take the first step toward mastering technologies that shape the future.
        </p>

        <p><strong>Email:</strong>
            <a href="mailto:adler@techadler.com" class="contact-link text-white">adler@techadler.com</a>
        </p>

        <p><strong>Call:</strong>
            <a href="tel:+919404621503" class="contact-link text-white">+91-9404621503</a>
        </p>

        <p class="opacity-75 mb-4">Based in Kolhapur, India | Remote-ready team | Fast onboarding</p>

        <div class="mt-4">
            <a href="https://www.instagram.com/adlertechconnect/?utm_source=qr&igsh=NWlnc3ozYjRvNHB6#" class="btn btn-outline-light rounded-pill mx-2 px-4">Instagram</a>
            <a href="{{ url('/contact') }}" class="btn btn-light text-pink rounded-pill mx-2 px-4">Contact Us</a>
        </div>
    </div>
</section>

@endsection

<style>
    .btn-pink {
        background-color: #ff007f;
        color: #fff;
        transition: 0.3s;
    }

    .btn-pink:hover {
        background-color: #e60073;
        color: #fff;
    }

    .contact-link {
        color: #6c757d;
        text-decoration: none;
        transition: 0.3s;
    }

    .contact-link:hover {
        color: #ff007f !important;
    }

    .text-pink {
        color: #d05695 !important;
    }

    .btn-light:hover {
        background-color: #f8d8e6;
        color: #d05695 !important;
    }

    .contact-link {
        text-decoration: none;
        transition: 0.3s;
    }

    .contact-link:hover {
        color: #ffe6f2 !important;
        text-decoration: underline;
    }
</style>