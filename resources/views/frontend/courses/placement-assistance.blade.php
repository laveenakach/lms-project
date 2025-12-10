@extends('layouts.frontend')

@section('content')

{{-- Hero Section --}}
<section class="hero-section d-flex align-items-center text-center text-white"
    style="background:linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/Placement-Assistance-&-Mock-Interview-Preparation.webp') }}') center/cover no-repeat; height: 50vh;">
    <div class="container">
        <h1 class="display-5 fw-bold">Placement Assistance & Mock Interview Preparation Program</h1>
        <p class="lead mt-3">Bridge the gap between learning and employability with complete career readiness.</p>
    </div>
</section>

{{-- Why This Program --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold">Why This Program?</h2>
        <p class="text-center mx-auto" style="max-width: 900px;">
            Landing your first job in Data Analytics, AI, and ML is not just about technical
            skills – it’s about being interview-ready, confident, and marketable.
            This program is specially designed to bridge the gap between learning and
            employability with end-to-end career support.
        </p>
    </div>
</section>

{{-- Program Duration --}}
<section class="py-5 position-relative overflow-hidden">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-md-6" data-aos="fade-right">
                <h2 class="fw-bold text-primary mb-4 text-uppercase">
                    <i class="bi bi-hourglass-split me-2"></i> Program Duration
                </h2>
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="bi bi-calendar-event text-danger me-2"></i> Total Duration: <strong>3 Months</strong></li>
                            <li class="mb-2"><i class="bi bi-journal-code text-success me-2"></i> Theory & Hands-on Exercises: <strong>2 Months</strong></li>
                            <li><i class="bi bi-trophy text-warning me-2"></i> Capstone Projects & Interview Prep: <strong>1 Month</strong></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 text-center" data-aos="fade-right">
                <img src="{{ asset('images/handshake.jpeg') }}" alt="Who is this Program for"
                    class="img-fluid rounded shadow" style="width: 100%; height:340px;">
            </div>
        </div>
    </div>
</section>



{{-- What’s Included - Mock Interview Preparation --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">What’s Included in this Program</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Mock Interview Preparation</h5>
                        <ul class="list-unstyled">
                            <li>✔ Multiple HR + Technical Mock Interviews with feedback</li>
                            <li>✔ Exposure to real-world interview scenarios</li>
                            <li>✔ Domain-specific interview practice (Data Analyst, BI Analyst, ML Engineer, etc.)</li>
                            <li>✔ Soft Skills & Communication Training</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Placement Assistance</h5>
                        <ul class="list-unstyled">
                            <li>✔ Resume & CV Building tailored for data/AI careers</li>
                            <li>✔ LinkedIn Profile Optimization</li>
                            <li>✔ Job Search Strategy & Application Guidance</li>
                            <li>✔ Exclusive AdlerTech Job Alerts & Referrals</li>
                            <li>✔ Placement Assistance support for 6 months</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Career Guidance Workshops</h5>
                        <ul class="list-unstyled">
                            <li>✔ Personal Branding on LinkedIn & GitHub</li>
                            <li>✔ Portfolio Building (Projects + Case Studies)</li>
                            <li>✔ Aptitude & Business Case Study Practice</li>
                            <li>✔ Salary Negotiation Tips</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Tools & Platforms Covered --}}
<section class="py-5" style="background:linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('images/SERVICES-RISHI.webp') }}') center/cover no-repeat;">
    <div class="container">
        <h2 class="text-center text-white fw-bold mb-5">Tools & Platforms Covered</h2>
        <div class="row text-center text-white g-4">
            <div class="col-md-3">
                <p>💻 Google Meet / MS Teams (Mock Interviews)</p>
            </div>
            <div class="col-md-3">
                <p>📄 Resume Builders & ATS Tools</p>
            </div>
            <div class="col-md-3">
                <p>🌐 LinkedIn & GitHub (Branding)</p>
            </div>
            <div class="col-md-3">
                <p>📊 Excel, SQL, Power BI, Python</p>
            </div>
        </div>
    </div>
</section>

{{-- Who Can Join --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Who Can Join?</h2>
        <ul class="list-unstyled text-center" style="max-width: 700px; margin: 0 auto;">
            <li>✔ Students / Freshers completing Data Science, AI & ML training</li>
            <li>✔ Career Switchers entering Analytics or AI</li>
            <li>✔ Working professionals preparing for interviews in new roles</li>
        </ul>
    </div>
</section>

{{-- Program Duration --}}
<section class="py-5 position-relative overflow-hidden">
    <div class="container">
        <div class="row align-items-center g-4">
             <div class="col-md-6 text-center" data-aos="fade-right">
                <img src="{{ asset('images/placement.webp') }}" alt="Who is this Program for"
                    class="img-fluid rounded shadow" style="width: 100%; height:320px;">
            </div>
            <div class="col-md-6" data-aos="fade-right">
                <div class="container text-center">
                    <h2 class="fw-bold mb-4">Program Outcomes</h2>
                    <ul class="list-unstyled d-inline-block text-start">
                        <li>✔ A Job-ready Resume & LinkedIn Profile</li>
                        <li>✔ Real Interview Experience with Feedback</li>
                        <li>✔ Strong Confidence in Technical + HR Rounds</li>
                        <li>✔ Placement Assistance for 8 Months</li>
                        <li>✔ Access to Career Support Resources</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Top Recruiters</h2>
        <p class="text-muted mb-5">Our learners get hired by leading global companies</p>

        <!-- Row 1 -->
        <div class="logo-slider">
            <div class="logo-track">
                @for ($i = 1; $i <= 12; $i++)
                    <img src="{{ asset('images/logos/logo'.$i.'.webp') }}" class="logo-img">
                @endfor
                @for ($i = 1; $i <= 12; $i++)
                    <img src="{{ asset('images/logos/logo'.$i.'.webp') }}" class="logo-img">
                @endfor
            </div>
        </div>

        <!-- Row 2 -->
        <div class="logo-slider mt-4">
            <div class="logo-track reverse">
                @for ($i = 13; $i <= 24; $i++)
                    <img src="{{ asset('images/logos/logo'.$i.'.webp') }}" class="logo-img">
                @endfor
                @for ($i = 13; $i <= 24; $i++)
                    <img src="{{ asset('images/logos/logo'.$i.'.webp') }}" class="logo-img">
                @endfor
            </div>
        </div>

        <!-- Row 3 -->
        <div class="logo-slider mt-4">
            <div class="logo-track">
                @for ($i = 25; $i <= 48; $i++)
                    <img src="{{ asset('images/logos/logo'.$i.'.webp') }}" class="logo-img">
                @endfor
                @for ($i = 25; $i <= 48; $i++)
                    <img src="{{ asset('images/logos/logo'.$i.'.webp') }}" class="logo-img">
                @endfor
            </div>
        </div>
    </div>
</section>

{{-- Enroll Now Section --}}
<section class="py-5 text-white text-center"
    style="background-color:#d05695;">
    <div class="container">
        <h2 class="fw-bold mb-3">Start Your Journey with AdlerTech</h2>
        <p class="lead mb-4">Get interview-ready and launch your dream career in Analytics, AI, and Data Science.</p>
        <a href="tel:+919404621503" class="btn btn-light me-2"><i class="bi bi-telephone"></i> +91 9404621503</a>
        <a href="mailto:adler@techadler.com" class="btn btn-outline-light"><i class="bi bi-envelope"></i> adler@techadler.com</a>

        <div class="mt-4">
            <a href="https://wa.me/919404621503" class="text-white mx-2"><i class="bi bi-whatsapp fs-3"></i></a>
            <a href="https://www.linkedin.com/company/adlertech-innovations-opc-private-ltd/" class="text-white mx-2"><i class="bi bi-linkedin fs-3"></i></a>
            <a href="https://www.facebook.com/profile.php?id=61573029323642&sk=about_details" class="text-white mx-2"><i class="bi bi-facebook fs-3"></i></a>
            <a href="https://www.instagram.com/adlertech.ds/" class="text-white mx-2"><i class="bi bi-instagram fs-3"></i></a>
        </div>
    </div>
</section>

@endsection