<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Science Online Learning Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* --- Header Contact Bar --- */
        .top-bar {
            background: #f8f9fa;
            font-size: 0.9rem;
            padding: 6px 0;
        }

        .top-bar i {
            color: #0056b3;
        }

        /* --- Navbar --- */
        .navbar {
            background: linear-gradient(90deg, #002b5c, #0056b3);
        }

        .navbar-brand {
            font-weight: 700;
            color: #fff !important;
        }

        .nav-link {
            color: #fff !important;
            margin-right: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #d63384 !important;
        }

        .a-link {
            color: #463e3e !important;
            margin-right: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .a-link:hover {
            color: #d63384 !important;
        }

        /* --- Hero Section --- */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
            url("{{ asset('images/istockphoto-1397855482-612x612.jpg') }}") center/cover no-repeat;
            color: #fff;
            text-align: center;
            padding: 140px 20px;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero-section p {
            font-size: 1.2rem;
            margin-top: 20px;
        }

        /* --- Footer --- */
        footer {
            background: #002b5c;
            color: #fff;
            padding: 50px 0 20px 0;
        }

        footer a {
            color: #d63384;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .footer-logo {
            width: 166px;
            margin-bottom: 15px;
        }

        .social-icons a {
            display: inline-block;
            margin-right: 10px;
            font-size: 1.3rem;
            color: #fff;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #d63384;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 20px;
            padding-top: 15px;
            font-size: 0.9rem;
        }

        .navbar .dropdown-menu {
            border-radius: 10px;
            border: none;
            padding: 8px 0;
            min-width: 180px;
        }

        .navbar .dropdown-item {
            font-weight: 500;
            color: #333;
        }

        .navbar .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .navbar .dropdown-toggle::after {
            display: none;
            /* hides default arrow */
        }

        /* Loader overlay */
        #global-loader {
            position: fixed;
            inset: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #f8fafc, #eef2ff);
            z-index: 99999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
            opacity: 1;
            visibility: visible;
        }

        #global-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        /* Image loader (logo or icon) */
        .loader-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            animation: spin 1.5s linear infinite;
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        }

        /* Optional glowing circle behind image */
        .glow-circle {
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(99, 102, 241, 0.1);
            animation: pulse 1.5s ease-in-out infinite;
        }

        /* Text styling */
        .loader-text {
            font-weight: 600;
            color: #4f46e5;
            margin-top: 15px;
            font-size: 1.1rem;
            animation: fadeIn 1.2s ease-in-out infinite alternate;
        }

        /* Animations */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(0.95);
                opacity: 0.6;
            }

            50% {
                transform: scale(1.05);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0.6;
            }

            to {
                opacity: 1;
            }
        }

        /* chatbot */

        #chatbot-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99999;
        }

        .chatbot-btn {
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .chatbot-btn:hover {
            transform: scale(1.1);
        }

        .chatbot-box {
            display: none;
            position: absolute;
            bottom: 80px;
            right: 0;
            width: 320px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: fadeInUp 0.3s ease;
        }

        .chatbot-header {
            background: #4e73df;
            color: #fff;
            padding: 10px 15px;
            font-size: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #chatbot-close {
            cursor: pointer;
            font-size: 1.2rem;
        }

        .chatbot-messages {
            height: 250px;
            overflow-y: auto;
            padding: 10px;
            background: #f8f9fc;
        }

        .chatbot-input-area {
            display: flex;
            border-top: 1px solid #e0e0e0;
        }

        .chatbot-input-area input {
            flex: 1;
            border: none;
            padding: 10px;
            outline: none;
        }

        .chatbot-input-area button {
            background: #4e73df;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 0 15px 0 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .toggle-icon {
            transition: transform 0.3s ease;
        }

        .show>a .toggle-icon {
            transform: rotate(180deg);
        }

        .logo-color {
            color: #d05695;
        }

        .btn-pink {
            background-color: #e83e8c;
            color: #fff;
            border: none;
        }

        .btn-pink:hover {
            background-color: #d63384;
            color: #fff;
        }

        .recruit-logo {
            width: 120px;
            height: auto;
            object-fit: contain;
            transition: 0.3s;
        }

        .recruit-logo:hover {
            transform: scale(1.08);
        }

        .logo-slider {
            overflow: hidden;
            white-space: nowrap;
            width: 100%;
        }

        .logo-track {
            display: flex;
            gap: 40px;
            animation: scroll 20s linear infinite;
        }

        /* reverse direction for middle row */
        .logo-track.reverse {
            animation-direction: reverse;
        }

        .logo-img {
            width: 120px;
            height: auto;
            object-fit: contain;
            transition: 0.3s;
        }

        .logo-img:hover {
            transform: scale(1.1);
        }

        @keyframes scroll {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        .contact-link {
            color: #6c757d;
            /* default muted color */
            text-decoration: none;
            transition: 0.3s;
        }

        .contact-link:hover {
            color: #ff007f !important;
            /* pink hover */
        }

        div#navbarNav {
            width: 720px;
        }
    </style>
</head>

<body>

    <div id="global-loader">
        <div class="text-center position-relative">
            <div class="glow-circle mx-auto"></div>
            <img src="{{ asset('images/loader.png') }}" alt="Loading" class="loader-image mx-auto">
            <p class="loader-text">Loading, please wait...</p>
        </div>
    </div>

    {{-- Header Contact Bar --}}
    <div class="top-bar">
        <div class="container d-flex justify-content-between">
            <div>
                <a class="contact-link" href="tel:+919404621503"><i class="bi bi-telephone me-2"></i> +91 98765 43210 </a>
                <a class="contact-link" href="mailto:support@datasciencelms.com"><span class="ms-3"><i class="bi bi-envelope me-2"></i>adler@techadler.com</span> </a>
            </div>
            <div>
                <a href="#" class="text-dark me-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-dark me-2"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-dark me-2"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-dark"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/logo.png') }}" alt="LMS Logo" width="25%" class="me-2">
                Data Science
            </a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon text-white"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li><a class="nav-link" href="/">Home</a></li>
                    <li><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="coursesDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Courses
                            <i class="bi bi-caret-down-fill ms-1 toggle-icon"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="coursesDropdown">
                            <li><a class="dropdown-item" href="{{ route('frontend.courses.data-science-ai-ml') }}">Data Science, AI & ML Program</a></li>
                            <li><a class="dropdown-item" href="{{ route('frontend.courses.powerbi-analytics') }}">Microsoft Power BI & Analytics</a></li>
                            <li><a class="dropdown-item" href="{{ route('frontend.courses.placement-assistance') }}">Placement Assistance & Mock Interview</a></li>
                            <li><a class="dropdown-item" href="{{ route('frontend.courses.data-analytics') }}">Data Analytics Program</a></li>
                            <!-- <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('frontend.courses') }}">All Courses</a></li> -->
                        </ul>
                    </li>

                    <li><a class="nav-link" href="{{ route('blogs.index')}}">Blogs</a></li>
                    <li><a class="nav-link" href="{{ route('frontend.trainer_program')}}">Trainer Program</a></li>
                    <li><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    @guest
                    <li>
                        <a class="btn btn-pink ms-3 px-3" href="{{ route('login') }}">Login</a>
                    </li>
                    @endguest

                    @auth
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            <i class="bi bi-caret-down-fill me-1"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                            <li>
                                @php
                                $role = Auth::user()->role ?? 'student';
                                $dashboardRoute = match($role) {
                                'admin' => route('admin.dashboard'),
                                'trainer' => route('trainer.dashboard'),
                                default => route('student.dashboard'),
                                };
                                @endphp
                                <a class="dropdown-item" href="{{ $dashboardRoute }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>


    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center text-md-start">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-3">
                    <img src="{{ asset('images/logo.png') }}" alt="LMS Logo" class="footer-logo">
                    <p>Empowering learners with cutting-edge Data Science education through live sessions, interactive projects, and expert mentorship.</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a class="nav-link" href="/">Home</a></li>
                        <li><a class="nav-link" href="{{ route('about') }}">About</a></li>
                        <li><a class="nav-link" href="{{ route('frontend.courses') }}">Courses</a></li>
                        <li><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h5>Courses</h5>
                    <ul class="list-unstyled">
                        <li><a class="nav-link" href="{{ route('frontend.courses.data-science-ai-ml') }}">Data Science, AI & ML Program</a></li>
                        <li><a class="nav-link" href="{{ route('frontend.courses.powerbi-analytics') }}">Microsoft Power BI & Analytics</a></li>
                        <li><a class="nav-link" href="{{ route('frontend.courses.placement-assistance') }}">Placement Assistance & Mock Interview</a></li>
                        <li><a class="nav-link" href="{{ route('frontend.courses.data-analytics') }}">Data Analytics Program</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h5>Contact Us</h5>
                    <p><i class="bi bi-geo-alt me-2"></i>Plot No 39 Yeswant Colony, Alka Sheti Farm Kagal , Kolhapur, Maharashtra, India – 416216</p>
                    <a class="nav-link mb-3" href="tel:+91 98765 43210"><i class="bi bi-telephone me-2"></i> +919404621503</a>
                    <a class="nav-link" href="mailto:adler@techadler.com"><i class="bi bi-envelope me-2"></i>adler@techadler.com</p></a>
                </div>
            </div>

            <div class="footer-bottom text-center mt-4">
                © {{ date('Y') }} DataScienceLMS. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- Chatbot Widget -->
    <div id="chatbot-widget">
        <button id="chatbot-toggle" class="chatbot-btn">
            <i class="bi bi-chat-dots"></i>
        </button>

        <div id="chatbot-box" class="chatbot-box">
            <div class="chatbot-header">
                <strong>Ask Me Anything!</strong>
                <span id="chatbot-close">&times;</span>
            </div>
            <div id="chatbot-messages" class="chatbot-messages"></div>
            <div class="chatbot-input-area">
                <input type="text" id="chatbot-input" placeholder="Type your message..." />
                <button id="chatbot-send"><i class="bi bi-send"></i></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.onreadystatechange = function() {
            const loader = document.getElementById('global-loader');
            if (document.readyState === "complete") {
                setTimeout(() => loader.classList.add('hidden'), 600);
            }
        };


        document.addEventListener("DOMContentLoaded", function() {
            const chatbotBtn = document.getElementById("chatbot-toggle");
            const chatbotBox = document.getElementById("chatbot-box");
            const chatbotClose = document.getElementById("chatbot-close");
            const sendBtn = document.getElementById("chatbot-send");
            const input = document.getElementById("chatbot-input");
            const messages = document.getElementById("chatbot-messages");

            chatbotBtn.addEventListener("click", () => chatbotBox.style.display = "block");
            chatbotClose.addEventListener("click", () => chatbotBox.style.display = "none");

            sendBtn.addEventListener("click", sendMessage);
            input.addEventListener("keypress", (e) => {
                if (e.key === "Enter") sendMessage();
            });

            function sendMessage() {
                const text = input.value.trim();
                if (!text) return;

                addMessage("You", text, "right");
                input.value = "";


                // inside sendMessage()
                fetch('/chatbot/reply', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            message: text
                        })
                    })
                    .then(res => res.json())
                    .then(data => addMessage("Bot", data.reply, "left"));


                // Simulate chatbot response (You can replace with real API call)
                // setTimeout(() => {
                //     addMessage("Bot", "Thanks for your message! How can I help you?", "left");
                // }, 1000);
            }

            function addMessage(sender, text, side) {
                const msg = document.createElement("div");
                msg.className = `chat-msg ${side}`;
                msg.innerHTML = `<strong>${sender}:</strong> <span>${text}</span>`;
                messages.appendChild(msg);
                messages.scrollTop = messages.scrollHeight;
            }
        });


        document.addEventListener("DOMContentLoaded", function() {
            const dropdown = document.getElementById("coursesDropdown");
            const icon = dropdown.querySelector(".toggle-icon");

            dropdown.addEventListener("show.bs.dropdown", function() {
                icon.classList.remove("bi-caret-down-fill");
                icon.classList.add("bi-caret-up-fill");
            });

            dropdown.addEventListener("hide.bs.dropdown", function() {
                icon.classList.remove("bi-caret-up-fill");
                icon.classList.add("bi-caret-down-fill");
            });
        });
    </script>
</body>

</html>