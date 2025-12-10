@extends('layouts.frontend')

@section('title', 'Data Science, AI & Machine Learning Program')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<section class="hero-section text-white text-center d-flex align-items-center justify-content-center position-relative overflow-hidden"
    style="background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), url('{{ asset('images/data_science_and_ai_banner.webp') }}') center/cover no-repeat; height: 65vh;">
    <div class="container" data-aos="zoom-in">
        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">
            Data Science, AI & Machine Learning Program
        </h1>
        <p class="lead mb-4">Upskill for the future with real-world projects, GenAI tools, and expert mentorship.</p>
        <a href="{{ route('register') }}" class="btn btn-pink btn-lg px-4 shadow-lg hover-lift">
            <i class="bi bi-rocket-takeoff me-2"></i> Enroll Now
        </a>
    </div>
</section>

{{-- ================= WHO IS THIS PROGRAM FOR ================= --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-md-6" data-aos="fade-right">
                <img src="{{ asset('images/Power-BI-CS.webp') }}" alt="Who is this program for" 
                     class="img-fluid rounded-4 shadow hover-lift">
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <h2 class="fw-bold mb-4 text-primary">Who is this Program for?</h2>
                <ul class="list-unstyled fs-5">
                    <li class="mb-2"><i class="bi bi-person-workspace logo-color me-2"></i> Students entering the tech industry with high-demand skills.</li>
                    <li class="mb-2"><i class="bi bi-briefcase logo-color me-2"></i> Job seekers shifting to AI, ML & Data Science careers.</li>
                    <li class="mb-2"><i class="bi bi-graph-up logo-color me-2"></i> Working professionals aiming to upskill and stay competitive.</li>
                    <li><i class="bi bi-lightbulb logo-color me-2"></i> Entrepreneurs & freelancers leveraging AI for business growth.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ================= PROGRAM DURATION ================= --}}
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
                            <li class="mb-2"><i class="bi bi-calendar-event text-danger me-2"></i> Total Duration: <strong>6 Months</strong></li>
                            <li class="mb-2"><i class="bi bi-journal-code text-success me-2"></i> Theory & Hands-on Exercises: <strong>5 Months</strong></li>
                            <li><i class="bi bi-trophy text-warning me-2"></i> Capstone Projects & Interview Prep: <strong>1 Month</strong></li>
                        </ul>
                    </div>
                </div>

                <div class="p-4 rounded shadow bg-white">
                    <h5 class="fw-semibold text-secondary mb-3">
                        <i class="bi bi-lightbulb me-2 text-warning"></i> Learning Journey
                    </h5>
                    <ul class="mb-3">
                        <li>3 Months: Python, Machine Learning</li>
                        <li>1 Month: MLOps, Gen AI, Project Management</li>
                        <li>1 Month: SQL, Power BI, Tableau</li>
                        <li>1 Month: Capstone Projects & Interview Preparation</li>
                    </ul>
                    <p class="mb-0"><i class="bi bi-calendar-check text-primary me-2"></i> 
                        <strong>Batches:</strong> Weekday & Weekend options available
                    </p>
                </div>
            </div>

            <div class="col-md-6 text-center" data-aos="fade-left">
                <img src="{{ asset('images/istockphoto-1397855482-612x612.jpg') }}"
                     alt="Program Duration Illustration"
                     class="img-fluid rounded-4 shadow hover-lift"
                     style="max-height: 420px;">
            </div>
        </div>
    </div>
</section>

{{-- ================= WHY LEARN DATA SCIENCE ================= --}}
<section class="py-5 bg-light">
    <div class="container" data-aos="fade-up">
        <h2 class="fw-bold text-center mb-4 text-primary">Why Learn Data Science & Gen AI?</h2>
        <p class="text-center mx-auto mb-5" style="max-width: 700px;">
            In today’s world, where information is key, data science helps organizations use data to make 
            smart decisions and plan for the future. Here’s why learning Data Science & Gen AI is a game changer:
        </p>
        <div class="row g-4 text-center">
            @php
                $reasons = [
                    ['icon'=>'bi-bar-chart-line', 'title'=>'Future-Proof Career', 'desc'=>'AI & Data Science jobs projected to grow 30%+ by 2030.'],
                    ['icon'=>'bi-currency-dollar', 'title'=>'High-Paying Jobs', 'desc'=>'Among the top 3 most in-demand IT careers globally.'],
                    ['icon'=>'bi-cpu', 'title'=>'Generative AI Boom', 'desc'=>'Tools like ChatGPT, MidJourney & Copilot are reshaping industries.'],
                ];
            @endphp

            @foreach($reasons as $r)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body py-5">
                        <i class="bi {{ $r['icon'] }} display-5 logo-color mb-3"></i>
                        <h5 class="fw-bold">{{ $r['title'] }}</h5>
                        <p class="text-muted mb-0">{{ $r['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PROGRAM HIGHLIGHTS ================= --}}
<section class="py-5">
    <div class="container" data-aos="fade-up">
        <h2 class="fw-bold text-center mb-5 text-primary">Program Highlights</h2>
        <div class="row g-4">
            @php
                $highlights = [
                    ['bi-person-badge', 'Placement Support & Career Guidance'],
                    ['bi-briefcase', '7+ Real-World Capstone Projects'],
                    ['bi-mic', 'Mock Interviews & Resume Building'],
                    ['bi-people', '1-to-1 Mentorship & Career Counselling'],
                    ['bi-wallet2', 'Affordable Fees with Flexible Payments'],
                    ['bi-mortarboard', 'Access to Expert Faculty & Trainers'],
                    ['bi-laptop', 'Remote Learning with Interactive Sessions'],
                    ['bi-gift', 'First 2 Demo Sessions FREE'],
                ];
            @endphp

            @foreach($highlights as [$icon, $title])
            <div class="col-6 col-md-3 text-center">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body py-4">
                        <i class="bi {{ $icon }} display-5 logo-color mb-3"></i>
                        <h6 class="fw-semibold">{{ $title }}</h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= JOB ROLES ================= --}}
<section class="py-5 text-white" 
    style="background:linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('images/data-science-tools-img.jpg') }}') center/cover no-repeat;">
    <div class="container" data-aos="fade-up">
        <h2 class="fw-bold text-center mb-5">Job Roles in Data Science & Gen AI</h2>
        <div class="row g-4 text-center">
            @php
                $roles = [
                    ['bi-graph-up', 'Data Scientist'],
                    ['bi-cpu', 'Machine Learning Engineer'],
                    ['bi-bar-chart', 'Business Intelligence Analyst'],
                    ['bi-database', 'Data Analyst'],
                    ['bi-robot', 'AI Engineer'],
                    ['bi-chat-left-text', 'NLP Engineer'],
                    ['bi-lightning-charge', 'Generative AI Specialist'],
                    ['bi-cloud', 'Cloud AI Architect'],
                ];
            @endphp

            @foreach($roles as [$icon, $title])
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body">
                        <i class="bi {{ $icon }} display-5 text-primary mb-3"></i>
                        <h6 class="fw-semibold text-dark">{{ $title }}</h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= TOOLS & TECHNOLOGIES ================= --}}
<section class="py-5 text-center bg-light">
    <div class="container">
        <h2 class="fw-bold text-primary mb-5" data-aos="fade-up">Tools & Technologies You’ll Learn</h2>
        <div class="d-flex flex-wrap justify-content-center align-items-center gap-4" data-aos="fade-up" data-aos-delay="200">
            @php
                $tools = ['Python.png','Sql.jpeg','Numpy.png','Pandas.png','Scikit-learn.png','Tensorflow.jpeg','Matplotlib.png','Aws.png','Powerbi.jpeg','Tableau.png','Openai.png','Chatgpt.png','Langchain.jpeg'];
            @endphp
            @foreach($tools as $tool)
                <img src="{{ asset('tools_technologies/'.$tool) }}" alt="{{ $tool }}" 
                     class="img-fluid tech-logo hover-lift" style="height:60px;">
            @endforeach
        </div>
    </div>
</section>

{{-- ================= LEARNING PATH ================= --}}
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-5 text-primary">Learning Path</h2>
        <div class="row align-items-center g-4">
            <div class="col-md-6" data-aos="fade-right">
                <ol class="list-group list-group-numbered shadow-sm">
                    <li class="list-group-item">Foundation – Python, Statistics, SQL</li>
                    <li class="list-group-item">Data Analysis – Pandas, NumPy, Data Wrangling</li>
                    <li class="list-group-item">Visualization – Power BI, Tableau, Matplotlib</li>
                    <li class="list-group-item">Machine Learning – Regression, Classification, Clustering</li>
                    <li class="list-group-item">Deep Learning – Neural Networks, TensorFlow, PyTorch</li>
                    <li class="list-group-item">Generative AI – NLP, LLMs, ChatGPT, LangChain</li>
                    <li class="list-group-item">Capstone Projects – Real-world industry problems</li>
                    <li class="list-group-item">Career Prep – Resume, Mock Interviews, Placement Support</li>
                </ol>
            </div>
            <div class="col-md-6 text-center" data-aos="fade-left">
                <img src="{{ asset('images/futuristic-artificial-intelligence.jpg') }}" alt="Learning Path" 
                     class="img-fluid rounded-4 shadow hover-lift">
            </div>
        </div>
    </div>
</section>

{{-- ================= ADLERTECH VS OTHERS ================= --}}
<section class="py-5 bg-light">
    <div class="container" data-aos="fade-up">
        <h2 class="fw-bold text-center mb-5 text-primary">AdlerTech vs Others</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4 h-100">
                    <h4 class="logo-color fw-bold mb-3">AdlerTech</h4>
                    <ul class="list-unstyled">
                        <li>✅ Industry-oriented, hands-on & project-based learning</li>
                        <li>✅ 1:1 mentorship with industry experts</li>
                        <li>✅ Dedicated career support team</li>
                        <li>✅ Mock interviews & portfolio building</li>
                        <li>✅ 7+ real-world capstone projects</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4 h-100">
                    <h4 class="fw-bold mb-3 text-secondary">Others</h4>
                    <ul class="list-unstyled">
                        <li>❌ Mostly theory-focused, limited practical exposure</li>
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

{{-- ================= ENROLL NOW ================= --}}
<section id="enroll" class="py-5 text-center text-white" style="background-color: #d05695;">
    <div class="container">
        <h2 class="fw-bold mb-3">Ready to Begin Your AI & Data Science Journey?</h2>
        <p class="lead mb-4">Book a free counselling session with our experts today!</p>
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

@push('styles')
<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }
    .tech-logo {
        filter: grayscale(80%);
        transition: all 0.3s ease;
    }
    .tech-logo:hover {
        filter: grayscale(0);
        transform: scale(1.1);
    }
</style>
@endpush
