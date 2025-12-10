@extends('layouts.frontend')

@section('content')

<style>
  #testimonialCarousel {
    position: relative;
    padding-bottom: 50px;
    /* gives space for indicators below */
  }

  #testimonialCarousel .carousel-indicators {
    position: absolute;
    bottom: -40px;
    /* move indicators below the card area */
    left: 50%;
    transform: translateX(-50%);
    margin: 0;
  }

  #testimonialCarousel .carousel-indicators [data-bs-target] {
    background-color: #e83e8c;
    width: 10px;
    height: 10px;
    border-radius: 50%;
  }

  #testimonialCarousel .carousel-indicators .active {
    width: 12px;
    height: 12px;
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
<section class="hero-section">
  <div class="container text-center">
    <h1>Master Data Science & AI Skills Online</h1>
    <p class="lead mt-3">Join our interactive platform and learn from top instructors through live classes, projects, and assessments.</p>

    @if(Auth::user())
    <a href="#" class="btn btn-pink btn-lg mt-4">Get Started for Free</a>
    @else
    <a href="{{ route('register') }}" class="btn btn-pink btn-lg mt-4">Get Started for Free</a>
    @endif
  </div>
</section>

{{-- About Us Section --}}
<section id="about" class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="https://images.unsplash.com/photo-1581090700227-1e37b190418e" alt="About Us" class="img-fluid rounded shadow">
      </div>
      <div class="col-md-6">
        <h2>About Our Platform</h2>
        <p class="mt-3">Data Science LMS is designed to provide a complete learning ecosystem for aspiring data scientists, analysts, and AI engineers. We combine live instructor-led training, assignments, and real-world projects to ensure a hands-on learning experience.</p>
        <ul class="mt-3">
          <li>Comprehensive Data Science Curriculum</li>
          <li>Real-Time Project Submission Portal</li>
          <li>Recorded Class Videos Access Anytime</li>
          <li>Attendance and Performance Tracking</li>
        </ul>
        <a href="#courses" class="btn btn-primary mt-3">Explore Courses</a>
      </div>
    </div>
  </div>
</section>

{{-- Features Section --}}
<section id="features" class="py-5">
  <div class="container text-center">
    <h2 class="fw-bold mb-5">Why Choose Our Platform?</h2>

    <div class="row g-4">

      <div class="col-md-4">
        <div class="card feature-card p-4 shadow-sm">
          <div class="feature-icon">
            <i class="bi bi-bar-chart-line"></i>
          </div>
          <h5 class="fw-semibold">Hands-on Learning</h5>
          <p class="text-muted">Work on real-world projects and gain practical data science experience.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card feature-card p-4 shadow-sm">
          <div class="feature-icon">
            <i class="bi bi-camera-video"></i>
          </div>
          <h5 class="fw-semibold">Live & Recorded Sessions</h5>
          <p class="text-muted">Attend live classes and re-watch all sessions anytime from your dashboard.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card feature-card p-4 shadow-sm">
          <div class="feature-icon">
            <i class="bi bi-award"></i>
          </div>
          <h5 class="fw-semibold">Certified Instructors</h5>
          <p class="text-muted">Learn from industry experts and earn valuable professional certificates.</p>
        </div>
      </div>
    </div>
  </div>
</section>


{{-- Courses Section --}}
<section id="courses" class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="mb-5">Popular Courses</h2>
    <div class="row g-4">
      <div class="col-md-3">
        <div class="card feature-card" style="height: 400px;">
          <img src="{{ asset('images/istockphoto-1397855482-612x612.jpg') }}" height="200px" class="card-img-top" alt="Python">
          <div class="card-body">
            <a class="a-link" href="{{ route('frontend.courses.data-science-ai-ml') }}">
              <h5>Data Science, AI & Machine Learning Program</h5>
            </a>
            <p>In today’s world, where information is key, data science helps organizations use data to make smart decisions and plan for the future.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card feature-card" style="height: 400px;">
          <img src="{{ asset('images/microsoft-power-bi-1.jpeg')}}" class="card-img-top" height="200px" alt="Machine Learning">
          <div class="card-body">
            <a class="a-link" href="{{ route('frontend.courses.powerbi-analytics') }}">
              <h5>Microsoft Power BI & Analytics Program</h5>
            </a>
            <p>Master the Art of Data Visualization, Business Insights & Analytics with Power BI</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card feature-card" style="height: 400px;">
          <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c" class="card-img-top" height="200px" alt="AI">
          <div class="card-body">
            <a class="a-link" href="{{ route('frontend.courses.placement-assistance') }}">
              <h5>Placement Assistance & Mock Interview Preparation Program</h5>
            </a>
            <p>This program is specially designed to bridge the gap between learning and employability with end-to-end career support.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card feature-card" style="height: 400px;">
          <img src="{{ asset('images/Data-Analytics.webp') }}" class="card-img-top" height="200px" alt="AI">
          <div class="card-body">
            <a class="a-link" href="{{ route('frontend.courses.data-analytics') }}">
              <h5>Data Analytics Program</h5>
            </a>
            <p>Master data visualization, reporting, and business insights with real-world projects.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="py-5" id="testimonials">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">What Our Learners Say</h2>
      <p class="text-muted">Hear from professionals and students who transformed their careers through our Data Science programs.</p>
    </div>

    <!-- Carousel -->
    <div id="testimonialCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
      <div class="carousel-inner">

        <!-- Testimonial 1 -->
        <div class="carousel-item active">
          <div class="d-flex justify-content-center">
            <div class="card border-0 shadow-sm text-center p-4 rounded-4" style="max-width: 500px;">
              <img src="{{ asset('images/testimonialAvatarMan.webp') }}" alt="Student" class="rounded-circle mx-auto mb-3" width="90" height="90" style="object-fit: cover;">
              <h5 class="fw-semibold mb-1">Aarav Sharma</h5>
              <p class="text-muted small mb-2">Data Analyst at Deloitte</p>
              <p class="fst-italic text-secondary">“The platform made learning Data Science simple and practical. Real projects and mentor feedback helped me land my dream role.”</p>
              <div class="text-warning">★★★★★</div>
            </div>
          </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="carousel-item">
          <div class="d-flex justify-content-center">
            <div class="card border-0 shadow-sm text-center p-4 rounded-4" style="max-width: 500px;">
              <img src="{{ asset('images/testimonialAvatarWoman.webp') }}" alt="Student" class="rounded-circle mx-auto mb-3" width="90" height="90" style="object-fit: cover;">
              <h5 class="fw-semibold mb-1">Priya Nair</h5>
              <p class="text-muted small mb-2">Machine Learning Engineer</p>
              <p class="fst-italic text-secondary">“The structured curriculum and hands-on approach gave me confidence to switch from a non-tech background to AI.”</p>
              <div class="text-warning">★★★★☆</div>
            </div>
          </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="carousel-item">
          <div class="d-flex justify-content-center">
            <div class="card border-0 shadow-sm text-center p-4 rounded-4" style="max-width: 500px;">
              <img src="{{ asset('images/testimonialAvatarMan2.webp') }}" alt="Student" class="rounded-circle mx-auto mb-3" width="90" height="90" style="object-fit: cover;">
              <h5 class="fw-semibold mb-1">Rahul Mehta</h5>
              <p class="text-muted small mb-2">Data Scientist at StartUpX</p>
              <p class="fst-italic text-secondary">“The mentors were industry experts who guided me through every project. The placement support was top-notch!”</p>
              <div class="text-warning">★★★★★</div>
            </div>
          </div>
        </div>

      </div>

      <!-- Carousel controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>

      <!-- Carousel indicators -->
      <div class="carousel-indicators mt-5" style="margin-top: 50px;">
        <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2"></button>
      </div>
    </div>
  </div>
</section>

{{-- Contact Section --}}
<section id="contact" class="bg-light py-5">
  <div class="container text-center">
    <h2>Enroll Now</h2>
    <p class="mb-4">Data Science and AI course admissions.</p>
    <a href="https://forms.gle/mqws7LqyrbAu3wjz5" target="_blank" class="btn btn-primary">Enroll Your Seats Now</a>
  </div>
</section>
@endsection