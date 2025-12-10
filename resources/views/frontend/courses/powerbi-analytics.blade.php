@extends('layouts.frontend')

@section('content')

{{-- Hero Section --}}
<section class="hero-section d-flex align-items-center text-center text-white"
    style="background: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)), 
                 url('{{ asset('images/power-bi-img.jpg') }}') center/cover no-repeat; height: 60vh;">
    <div class="container">
        <h1 class="display-5 fw-bold">Microsoft Power BI & Analytics Program</h1>
        <p class="lead mt-3">Master the Art of Data Visualization, Business Insights & Analytics with Power BI</p>
    </div>
</section>

{{-- Who is this Program for --}}
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset('images/microsoft-power-bi-1.jpeg') }}" alt="Who is this Program for"
                    class="img-fluid rounded shadow" style="width: 100%; height:300px;">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Who is this Program for?</h2>
                <ul class="list-unstyled">
                    <li><i class="bi bi-check-circle-fill text-primary me-2"></i> Graduate & Final-Year Students (BCA, MCA, B.Tech, MBA, B.Sc, M.Sc)</li>
                    <li><i class="bi bi-check-circle-fill text-primary me-2"></i> Working Professionals looking to transition into Analytics / BI</li>
                    <li><i class="bi bi-check-circle-fill text-primary me-2"></i> MIS Executives & Reporting Analysts upgrading skills</li>
                    <li><i class="bi bi-check-circle-fill text-primary me-2"></i> Job Seekers aiming for Data Analyst / BI Developer roles</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light position-relative overflow-hidden">
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
                <div class="p-4 rounded shadow bg-white text-start">
                    <h5 class="fw-semibold text-secondary mb-3">
                        <i class="bi bi-lightbulb me-2 text-warning"></i> This is How Your Learning Journey Will Progress:
                    </h5>
                    <ul class="mb-3">
                        <li>1 Month – Data Analysis Fundamentals, SQL for Business Analytics</li>
                        <li>1 Month – Power BI Essentials, Visualization & Dashboards</li>
                        <li>1 Month – Advanced BI Concepts, Capstone Projects & Interview Prep</li>
                    </ul>
                    <p class="mb-0"><i class="bi bi-calendar-check text-primary me-2"></i>
                        <strong>Batches:</strong> Weekday & Weekend batches available
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Future Demand & Scope --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Future Demand & Scope (2025 – 2030)</h2>
            <p class="text-muted">Why Power BI & Analytics is a Future-Proof Career Path</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="bi bi-graph-up-arrow text-success me-2"></i> BI & Analytics market to reach <strong>$55B+ by 2030</strong>.</li>
                    <li class="list-group-item"><i class="bi bi-bar-chart text-primary me-2"></i> 97% of companies will rely on analytics for decision-making.</li>
                    <li class="list-group-item"><i class="bi bi-pie-chart text-warning me-2"></i> Power BI leads the BI market with <strong>36% share</strong>.</li>
                    <li class="list-group-item"><i class="bi bi-briefcase text-danger me-2"></i> Demand for BI Analysts & Developers to grow <strong>25% annually</strong> in India.</li>
                    <li class="list-group-item"><i class="bi bi-building text-info me-2"></i> Applicable across industries – Banking, Retail, Healthcare, IT, Education.</li>
                    <li class="list-group-item"><i class="bi bi-cpu text-secondary me-2"></i> Future-ready with AI & ML integration in BI tools.</li>
                </ul>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/microsoft-power-bi-2.jpg') }}" class="img-fluid rounded shadow" alt="Future Scope" style="width: 100%; height:280px;">
            </div>
        </div>
    </div>
</section>

{{-- Program Highlights --}}
<section class="bg-light py-5 text-center">
    <div class="container">
        <h2 class="fw-bold mb-5">Program Highlights</h2>
        <div class="row g-4">
            @php
            $highlights = [
            'Placement Support & Career Guidance',
            '2 Real-World Capstone Projects',
            'Mock Interviews & Resume Building',
            '1-to-1 Mentorship & Career Counselling',
            'Affordable Fees with Flexible Payments',
            'Access to Expert Faculty & Industry Trainers',
            'Remote Learning with Interactive Sessions',
            'First 2 Demo Sessions FREE'
            ];
            @endphp
            @foreach($highlights as $highlight)
            <div class="col-md-3 col-6">
                <div class="card shadow-sm border-0 h-100 p-3 hover-lift">
                    <div class="card-body">
                        <i class="bi bi-check2-circle text-primary display-6 mb-2"></i>
                        <p class="fw-semibold small">{{ $highlight }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Job Roles --}}
<section class="py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Job Roles in Power BI & Analytics</h2>
        <div class="row g-4">
            @php
            $roles = [
            'MIS Executive / Reporting Analyst',
            'Data Visualization Specialist',
            'Analytics Manager (BI/Power BI Team)',
            'Business Intelligence (BI) Intern',
            'Business Analyst (Data Focused)',
            'Data Analyst (Junior Level)',
            'Power BI Developer',
            'BI Consultant',
            'BI Analyst'
            ];
            @endphp
            @foreach($roles as $role)
            <div class="col-md-4">
                <div class="p-4 border rounded shadow-sm h-100">
                    <i class="bi bi-person-workspace text-primary display-5 mb-2"></i>
                    <h6 class="fw-semibold">{{ $role }}</h6>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Tools & Technologies --}}
<section class="bg-light py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-5">Tools & Technologies You’ll Learn</h2>
        <div class="d-flex flex-wrap justify-content-center align-items-center gap-4">
            @php
            $tools = ['Python.png','Sql.jpeg','Numpy.png','Pandas.png','Powerbi.jpeg','Tableau.png','Xls.png','Matplotlib.png'];
            @endphp
            @foreach($tools as $tool)
            <img src="{{ asset('tools_technologies/'.$tool) }}" alt="{{ $tool }}"
                class="img-fluid tech-logo hover-lift" style="height:60px;">
            @endforeach
        </div>
    </div>
</section>

{{-- AdlerTech vs Others --}}
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">AdlerTech vs Others</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="p-4 rounded shadow-sm bg-light h-100">
                    <h5 class="fw-bold text-primary mb-3">AdlerTech</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle text-success me-2"></i> Industry-oriented, hands-on & project-based learning</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> 1:1 mentorship with industry experts</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> Dedicated career support team, mock interviews, portfolio building</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> 2 real-world capstone projects with industry relevance</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded shadow-sm bg-white h-100">
                    <h5 class="fw-bold text-danger mb-3">Others</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-x-circle text-danger me-2"></i> Mostly theory-focused with limited practical exposure</li>
                        <li><i class="bi bi-x-circle text-danger me-2"></i> Generic trainers, less personalized guidance</li>
                        <li><i class="bi bi-x-circle text-danger me-2"></i> Limited or no placement support</li>
                        <li><i class="bi bi-x-circle text-danger me-2"></i> Few or generic projects</li>
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
<section class="cta-section text-center text-white py-5"
    style="background-color:#d05695;">
    <div class="container">
        <h2 class="mb-3 fw-bold">Start Your Power BI & Analytics Journey Today!</h2>
        <p class="mb-4">Join AdlerTech’s industry-driven program and become a Power BI professional in just 3 months!</p>
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