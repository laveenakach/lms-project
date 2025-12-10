@extends('layouts.frontend')

@section('title', 'Data Analytics Program')

@section('content')

{{-- Hero Section --}}
<section class="hero-section text-white text-center d-flex align-items-center justify-content-center"
    style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
            url('{{ asset('images/Data-Analytics-Program-banner-image.webp') }}') center/cover no-repeat; height: 60vh;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Data Analytics Program</h1>
        <p class="lead mb-4">Master data visualization, reporting, and business insights with real-world projects.</p>
        <a href="{{ route('register') }}" class="btn btn-pink btn-lg px-4">Enroll Now</a>
    </div>
</section>

{{-- Who is this Program for --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset('images/Data-Analytics.webp') }}" alt="Who is this Program for"
                    class="img-fluid rounded shadow" style="width: 100%; height:300px;">
            </div>
            <div class="col-md-6">
                <h2 class="text-center fw-bold mb-4">Who is this Program for?</h2>
                <ul class="list-unstyled text-center" style="max-width: 800px; margin: 0 auto;">
                    <li>✔ Graduate & Final-Year Students (BCA, MCA, B.Tech, MBA, B.Sc, M.Sc)</li>
                    <li>✔ Working Professionals looking to transition into Analytics / BI</li>
                    <li>✔ Job Seekers aiming for Data Analyst / BI Developer roles</li>
                </ul>
            </div>
        </div>
    </div>
</section>

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
                            <li class="mb-2"><i class="bi bi-calendar-event text-danger me-2"></i> Program Duration: <strong>3 Months</strong></li>
                            <li class="mb-2"><i class="bi bi-journal-code text-success me-2"></i> Theory and Hands-on Exercises: <strong>2 Months</strong></li>
                            <li><i class="bi bi-trophy text-warning me-2"></i> Capstone Projects and Interview Preparation: <strong>1 Month</strong></li>
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
                        <li>1 Month – Excel for Data Analytics, SQL for Data Analytics</li>
                        <li>1 Month – Power BI for Visualization, Python for Data Analysis</li>
                        <li>1 Month – Capstone Projects and Interview Preparation</li>
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
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Future Demand & Scope (2025 – 2030)</h2>
        <div class="row g-4 text-center">
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-white shadow-sm rounded-3 h-100">
                    <p>📈 <strong>High Growth Industry:</strong> Data Analytics & AI projected to grow 30%+ annually.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-white shadow-sm rounded-3 h-100">
                    <p>🌍 <strong>Across Sectors:</strong> Finance, Healthcare, Retail, IT, E-commerce & Manufacturing demand professionals.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-white shadow-sm rounded-3 h-100">
                    <p>💡 <strong>Rising Job Roles:</strong> Data Analyst, BI Analyst, Data Engineer, AI/ML Specialist.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-white shadow-sm rounded-3 h-100">
                    <p>🌏 <strong>Global Opportunities:</strong> Skilled data professionals in high demand worldwide.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-white shadow-sm rounded-3 h-100">
                    <p>💰 <strong>Attractive Salaries:</strong> Entry-level Data Analysts earn ₹5–8 LPA with rapid career growth.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-white shadow-sm rounded-3 h-100">
                    <p>🚀 <strong>Future-Proof Career:</strong> Learning Data Analytics ensures global opportunities in the AI era.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Program Highlights --}}
<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Program Highlights</h2>
        <div class="row g-4">
            @php
            $highlights = [
            ['bi-person-badge','Placement Support & Career Guidance'],
            ['bi-briefcase','2 Real-World Capstone Projects'],
            ['bi-mic','Mock Interviews & Resume Building'],
            ['bi-people', '1-to-1 Mentorship & Career Counselling'],
            ['bi-wallet2', 'Affordable Fees with Flexible Payments'],
            ['bi-mortarboard', 'Access to Expert Faculty & Industry Trainers'],
            ['bi-laptop', 'Remote Learning with Interactive Sessions'],
            ['bi-gift', 'First 2 Demo Sessions FREE'],
            ];
            @endphp

            @foreach ($highlights as [$icon, $title])
            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm border-0 h-100 text-center">
                    <div class="card-body">
                        <i class="bi {{ $icon }} display-5 logo-color mb-3"></i>
                        <p class="fw-semibold">{{ $title }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Job Roles --}}
<section class="py-5 bg-light">
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold mb-4">Job Roles in Data Analytics</h2>
                <ul class="list-unstyled d-inline-block text-start">
                    <li>✔ Data Analyst</li>
                    <li>✔ Data Science / ML Intern</li>
                    <li>✔ BI Analyst / Reporting Analyst</li>
                    <li>✔ Business Analyst</li>
                    <li>✔ Junior Data Engineer</li>
                </ul>
            </div>
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset('images/Data-Analytics-1.jpeg') }}" alt="Who is this Program for"
                    class="img-fluid rounded shadow" style="width: 100%; height:300px;">
            </div>
        </div>
    </div>
</section>

{{-- Tools & Technologies --}}
<section class="py-5">
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
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">AdlerTech vs Others</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-3 h-100">
                    <h5 class="fw-bold mb-3 text-primary">AdlerTech</h5>
                    <ul class="list-unstyled">
                        <li>✔ Industry-oriented, hands-on & project-based learning</li>
                        <li>✔ 1:1 mentorship with industry experts</li>
                        <li>✔ Dedicated career support team, mock interviews, portfolio building</li>
                        <li>✔ 2 real-world capstone projects with industry relevance</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-3 h-100">
                    <h5 class="fw-bold mb-3 text-danger">Others</h5>
                    <ul class="list-unstyled">
                        <li>❌ Mostly theory-focused with limited practical exposure</li>
                        <li>❌ Generic trainers, less personalized guidance</li>
                        <li>❌ Limited or no placement support</li>
                        <li>❌ Few or generic projects</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
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

{{-- Enroll Now --}}
<section class="py-5 text-white text-center"
    style="background-color:#d05695;">
    <div class="container">
        <h2 class="fw-bold mb-3">Start Your Journey with AdlerTech</h2>
        <p class="lead mb-4">Become a Data Analyst and kickstart your career with hands-on analytics training and placement support.</p>
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