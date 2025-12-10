@extends('layouts.frontend')

@section('content')
<style>
.card-img-top {
    height: 360px;
    object-fit: contain;
}

.card {
    border-radius: 1rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
}

.hero-section {
  background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
              url('{{ asset('images/Power-BI-CS.webp') }}') center center / cover no-repeat fixed;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 60vh; /* avoids extra spacing on desktop */
  padding: 50px 20px; /* top & bottom padding balance */
}

/* Mobile optimization */
@media (max-width: 768px) {
  .hero-section {
    background-attachment: scroll; /* disables fixed bg for smooth mobile scroll */
    min-height: 70vh;
    padding: 50px 15px;
  }
}

  .feature-card {
    border: none;
    border-radius: 15px;
    transition: 0.3s ease;
  }

  .feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }

  .feature-icon {
    width: 90px;
    height: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    border-radius: 50%;
    background: #ffe6f2;
    /* soft pink bg */
    color: #ff2e93;
    /* pink icon */
    font-size: 40px;
    /* bigger icon */
  }
</style>

{{-- Hero Section --}}
<section class="hero-section d-flex align-items-center text-center text-white" 
         style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/data_science_and_artificial_intelligence.avif') }}') center/cover no-repeat; height: 50vh;">
    <div class="container">
        <h1 class="display-4 fw-bold">About Data Science</h1>
        <p class="lead mt-3">Empowering Learners to Become Industry-Ready Data Scientists and AI Experts</p>
    </div>
</section>

{{-- Who We Are Section --}}
<section id="who-we-are" class="pt-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c" 
                     alt="Who We Are" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6">
                <p>AdlerTech Innovations Pvt. Ltd. is recognized as one of the Best IT Companies in India, delivering custom software development, AI & data science solutions, and web & mobile app development services for businesses worldwide.</p>
                <h2 class="fw-bold mb-3">Who We Are</h2>
                <p>
                    At <strong>Data Science</strong>, we believe in the power of data-driven learning. 
                    Our mission is to bridge the gap between traditional education and industry requirements 
                    by offering an engaging, practical, and hands-on learning platform for aspiring 
                    Data Scientists, Analysts, and AI Engineers.
                </p>
                <ul class="mt-3">
                    <li>Industry-Driven Curriculum</li>
                    <li>Hands-on Projects & Assignments</li>
                    <li>Expert-Led Live Classes</li>
                    <li>Dedicated Support & Mentorship</li>
                </ul>

                {{-- Join Now Button with Login Logic --}}
                @if(Auth::check())
                    <a href="#" class="btn btn-pink mt-4">
                        Join Now
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-pink mt-4">
                        Join Now
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Vision & Mission --}}
<section class="bg-light py-5">
    <div class="container text-center">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm h-100 border-0">
                    <i class="bi bi-eye text-primary display-5 mb-3"></i>
                    <h5 class="fw-semibold">Our Vision</h5>
                    <p>To be the most trusted IT partner in India, delivering world-class software development, AI & data science solutions, and digital transformation services that redefine industries.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4 shadow-sm h-100 border-0">
                    <i class="bi bi-bullseye text-primary display-5 mb-3"></i>
                    <h5 class="fw-semibold">Our Mission</h5>
                    <p>To empower businesses through innovative IT solutions, enabling them to maximize efficiency, improve decision-making, and expand their digital presence globally.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===========================
    Hero Section (Fixed Background)
=========================== -->

<section class="hero-section text-white d-flex align-items-center">
  <div class="container text-center">
    <h1 class="display-5 fw-bold mb-3">Need Best Help For Digital Corporating!</h1>
    <p class="lead mb-4">
      Streamline Your Digital Strategy and Corporate Integration for Enhanced Efficiency 
      and Sustainable Growth in Today’s Competitive Market.
    </p>

    <div class="d-flex justify-content-center gap-3 mb-4 flex-wrap">
      <a href="{{ url('/contact') }}" class="btn btn-pink px-4 py-2 rounded-pill">Get a Quote</a>
      <a href="tel:+919404621503" class="btn btn-outline-light px-4 py-2 rounded-pill">Get a Free Consultation</a>
    </div>

    <p class="fw-bold fs-5"><i class="bi bi-telephone-fill"></i> +91 9404621503</p>

    <div class="row mt-5 text-center text-white">
      <div class="col-md-3 col-6 mb-3">
        <h2 class="fw-bold">200+</h2>
        <p class="mb-0">Happy Customers</p>
      </div>
      <div class="col-md-3 col-6 mb-3">
        <h2 class="fw-bold">98%</h2>
        <p class="mb-0">Satisfaction Rate</p>
      </div>
      <div class="col-md-3 col-6 mb-3">
        <h2 class="fw-bold">5+</h2>
        <p class="mb-0">Award Winning</p>
      </div>
      <div class="col-md-3 col-6 mb-3">
        <h2 class="fw-bold">200+</h2>
        <p class="mb-0">Completed Projects</p>
      </div>
    </div>
  </div>
</section>

<!-- ===========================
    Why AdlerTech Innovations Section
=========================== -->
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Why AdlerTech Innovations is the Best IT Company in India</h2>
      <p class="text-muted">We blend innovation, technology, and expertise to deliver excellence in every project.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-4 h-100">
          <div class="feature-icon mb-3"><i class="bi bi-code-slash fs-1 text-pink"></i></div>
          <h6 class="fw-bold">Custom Software Development</h6>
          <p class="text-secondary small mb-0">Successful delivery of projects across industries and domains.</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-4 h-100">
          <div class="feature-icon mb-3"><i class="bi bi-cpu fs-1 text-pink"></i></div>
          <h6 class="fw-bold">Latest Technology Stack</h6>
          <p class="text-secondary small mb-0">We use modern frameworks, AI tools, and cloud solutions for maximum impact.</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-4 h-100">
          <div class="feature-icon mb-3"><i class="bi bi-phone fs-1 text-pink"></i></div>
          <h6 class="fw-bold">Web & Mobile App Development</h6>
          <p class="text-secondary small mb-0">We focus on your goals, not just technology.</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-4 h-100">
          <div class="feature-icon mb-3"><i class="bi bi-graph-up fs-1 text-pink"></i></div>
          <h6 class="fw-bold">AI & Data Science Solutions</h6>
          <p class="text-secondary small mb-0">One-stop partner for development, analytics, and marketing.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Meet Our Founders Section --}}
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-5">Meet Our Founders</h2>
        <div class="row g-5 justify-content-center align-items-stretch">
            
            <!-- Founder 1 -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('images/ranapratap-1.jpg') }}" class="card-img-top rounded-top" alt="Ranapratap Mote">
                    <div class="card-body text-start">
                        <h5 class="fw-bold mb-1 text-center">Ranapratap Mote</h5>
                        <p class="text-muted text-center mb-3">Founder & CEO</p>
                        <p class="text-secondary">
                            At the heart of <strong>Adler Tech Innovations</strong> lies a dedicated team of forward-thinking professionals, led by our visionary Founder and CEO, Ranapratap Mote.
                        </p>
                        <p class="text-secondary">
                            He is the visionary leader behind Adler Tech Innovations. With a strong background in technology and entrepreneurship, Ranapratap founded the company with the goal of bridging the gap between business needs and technological innovation. As CEO, he is dedicated to fostering a culture of innovation, excellence, and client-centricity.
                        </p>
                        <p class="text-secondary mb-0">
                            With over <strong>7 years of experience</strong> in the tech industry, Ranapratap is passionate about driving growth and transforming ideas into impactful digital solutions. His leadership ensures that the company stays ahead of technological trends while maintaining the highest standards of quality and customer satisfaction.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Founder 2 -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('images/MYPIC.jpg') }}" class="card-img-top rounded-top" alt="Mrs. Shilpa Honnannavar">
                    <div class="card-body text-start">
                        <h5 class="fw-bold mb-1 text-center">Mrs. Shilpa Honnannavar</h5>
                        <p class="text-muted text-center mb-3">Co-Founder, AdlerTech Innovations</p>
                        <p class="text-secondary">
                            With <strong>9+ years of experience</strong> as a Data Scientist, Mrs. Shilpa specializes in advanced analytics, predictive modeling, and machine learning. She has mentored <strong>300+ professionals</strong> in Data Science and AI/ML, and her career spans global companies like Target, JCPenney, Symbiosis, and Imarticus Learning.
                        </p>
                        <p class="text-secondary mb-0">
                            At AdlerTech, she drives the EdTech vision — combining real-world expertise with hands-on training to prepare students and professionals for <strong>future-ready careers</strong> in technology.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- Team Section --}}
<section class="py-5">
    <div class="container text-center">
        <h2 class="fw-bold">Meet Our Experts</h2>
        <p>Our team is composed of talented individuals who are experts in their respective fields, from software developers and IT consultants to product designers and project managers. Together, we collaborate to provide innovative, customized solutions that address the unique challenges our clients face.</p>
        <div class="row g-4 justify-content-center">
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="card-img-top rounded-top" alt="Instructor 1">
                    <div class="card-body">
                        <h6 class="fw-bold mb-0">Dr. Arjun Patel</h6>
                        <small class="text-muted">AI Research Scientist</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="card-img-top rounded-top" alt="Instructor 2">
                    <div class="card-body">
                        <h6 class="fw-bold mb-0">Ms. Neha Sharma</h6>
                        <small class="text-muted">Senior Data Scientist</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" class="card-img-top rounded-top" alt="Instructor 3">
                    <div class="card-body">
                        <h6 class="fw-bold mb-0">Mr. Rohan Gupta</h6>
                        <small class="text-muted">Machine Learning Expert</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="cta-section text-center text-white py-5" 
         style="background: linear-gradient(135deg, #007bff, #6610f2);">
    <div class="container">
        <h2 class="mb-4">Start Your Data Science Journey Today!</h2>
        @if(Auth::check())
            <a href="#" class="btn btn-light btn-lg">Explore Courses</a>
        @else
            <a href="{{ route('register') }}" class="btn btn-pink btn-lg">Join for Free</a>
        @endif
    </div>
</section>
@endsection
