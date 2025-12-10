<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Adlertech Learning')</title>

    <!-- ✅ jQuery FIRST (must be at the top before Vite or Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- ✅ CSS Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- ✅ Laravel Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #0f172a, #1e293b);
            color: #fff;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px 0;
            transition: width 0.3s ease;
            overflow-x: hidden;
            z-index: 50;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cbd5e1;
            padding: 12px 20px;
            text-decoration: none;
            font-weight: 500;
            white-space: nowrap;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #334155;
            color: #fff;
            border-left: 4px solid #6366f1;
        }

        .sidebar.collapsed a span {
            display: none;
        }

        .content {
            margin-left: 260px;
            transition: margin-left 0.3s ease;
            padding: 0;
        }

        .content.expanded {
            margin-left: 80px;
        }

        .header {
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
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

        /* Sidebar Dropdown Styling */
        .dropdown {
            display: flex;
            flex-direction: column;
        }

        .dropdown-btn {
            padding: 12px 20px;
            color: #cbd5e1;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            flex-direction: column;
            background: transparent;
            margin-left: 12px;
        }

        .dropdown-content a {
            color: #94a3b8;
            padding: 8px 12px;
            text-decoration: none;
            transition: color .15s;
        }

        .dropdown-content a:hover {
            color: #fff;
        }

        .dropdown.open>.dropdown-btn {
            background: rgba(255, 255, 255, 0.04);
            color: #fff;
        }

        .dropdown.open .dropdown-content {
            display: flex;
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

    <div class="sidebar" id="sidebar">
        @include('includes.sidebar')
    </div>

    <div class="content" id="content">
        <div class="header">@include('includes.header')</div>
        <main class="mt-6 p-4">

            {{-- Toast Notification --}}
            @if (session('success') || session('error'))
            <div id="toast-container" class="position-fixed top-0 end-0 p-3 mt-5 animate-slide-in" style="z-index: 9999;">
                <div class="toast show text-white {{ session('success') ? 'bg-success' : 'bg-danger' }}">
                    <div class="d-flex justify-content-between align-items-center px-3 py-2">
                        <div>
                            <i class="bi {{ session('success') ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }}"></i>
                            {{ session('success') ?? session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white ms-2" onclick="closeToast()"></button>
                    </div>
                </div>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- ✅ Bootstrap & DataTables JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // ✅ Global Loader Hide
        document.onreadystatechange = function() {
            const loader = document.getElementById('global-loader');
            if (document.readyState === "complete") {
                setTimeout(() => loader.classList.add('hidden'), 600);
            }
        };


        // ✅ Toast logic
        function closeToast() {
            const toast = document.getElementById('toast-container');
            if (toast) {
                toast.classList.add('animate-slide-out');
                setTimeout(() => toast.remove(), 400);
            }
        }
        setTimeout(closeToast, 4000);


        // ✅ Sidebar toggle
        // ✅ Sidebar toggle + Responsive behavior
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const toggleBtn = document.getElementById('sidebarToggle');

            // 🔹 Toggle manually when button is clicked
            if (toggleBtn && sidebar && content) {
                toggleBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('collapsed');
                    content.classList.toggle('expanded');
                });
            }

            // 🔹 Auto collapse sidebar when on mobile (<992px)
            function handleResponsiveSidebar() {
                if (window.innerWidth < 992) {
                    sidebar.classList.add('collapsed');
                    content.classList.add('expanded');
                } else {
                    sidebar.classList.remove('collapsed');
                    content.classList.remove('expanded');
                }
            }

            // Run once on load
            handleResponsiveSidebar();

            // 🔹 Handle screen resize dynamically
            window.addEventListener('resize', handleResponsiveSidebar);
        });


        // ✅ Sidebar Dropdown Toggle
        document.addEventListener('DOMContentLoaded', function() {
            // event delegation: handles existing and future dropdowns
            document.body.addEventListener('click', function(e) {
                const btn = e.target.closest('.dropdown-btn');

                // if click was on a dropdown button -> toggle that dropdown
                if (btn) {
                    e.preventDefault();

                    const parent = btn.closest('.dropdown');
                    const isOpen = parent.classList.contains('open');

                    // close any other open dropdowns (optional)
                    document.querySelectorAll('.dropdown.open').forEach(d => {
                        if (d !== parent) {
                            d.classList.remove('open');
                            const ic = d.querySelector('.toggle-icon');
                            if (ic) ic.classList.replace('bi-chevron-up', 'bi-chevron-down');
                        }
                    });

                    // toggle current
                    parent.classList.toggle('open', !isOpen);
                    const icon = btn.querySelector('.toggle-icon');
                    if (icon) {
                        icon.classList.toggle('bi-chevron-down', isOpen); // if was open set to down
                        icon.classList.toggle('bi-chevron-up', !isOpen); // if now open set to up
                    }
                    return;
                }

                // click outside any dropdown closes all open dropdowns
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown.open').forEach(d => {
                        d.classList.remove('open');
                        const ic = d.querySelector('.toggle-icon');
                        if (ic) {
                            ic.classList.remove('bi-chevron-up');
                            ic.classList.add('bi-chevron-down');
                        }
                    });
                }
            });

            // optional: handle sidebar collapsed state — hide dropdown content when collapsed
            const observer = new MutationObserver(() => {
                const collapsed = document.getElementById('sidebar')?.classList.contains('collapsed');
                document.querySelectorAll('.dropdown').forEach(d => {
                    if (collapsed) {
                        d.classList.remove('open');
                        const ic = d.querySelector('.toggle-icon');
                        if (ic) {
                            ic.classList.remove('bi-chevron-up');
                            ic.classList.add('bi-chevron-down');
                        }
                    }
                });
            });

            const sidebar = document.getElementById('sidebar');
            if (sidebar) {
                observer.observe(sidebar, {
                    attributes: true,
                    attributeFilter: ['class']
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>