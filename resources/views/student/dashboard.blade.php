@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">
                <i class="bi bi-speedometer2 me-2"></i> Student Dashboard
            </h2>
            <p class="text-muted">Welcome back, <strong>{{ Auth::user()->name }}</strong> 👋</p>
        </div>
        <div>
            <button class="btn btn-outline-primary shadow-sm">
                <i class="bi bi-mortarboard me-1"></i> My Learning Path
            </button>
        </div>
    </div>

    {{-- Stats Section --}}
    <div class="row g-4">
        @php
            $stats = [
                ['title'=>'Attendances','count'=>$attendanceCount,'icon'=>'bi-calendar-check','color'=>'primary','route'=>'attendances.index'],
                ['title'=>'Assignments','count'=>$assignmentCount,'icon'=>'bi-graph-up','color'=>'success','route'=>'student.assignments.index'],
                ['title'=>'Projects','count'=>$projectCount,'icon'=>'bi-folder2-open','color'=>'warning','route'=>'student.projects.index'],
                ['title'=>'Courses','count'=>$courseCount,'icon'=>'bi-book','color'=>'info','route'=>'courses.index'],
                ['title'=>'Certificates','count'=>$certificationCount,'icon'=>'bi-award','color'=>'danger','route'=>'certifications.index'],
            ];
        @endphp

        @foreach($stats as $item)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <a href="{{ route($item['route']) }}" class="text-decoration-none">
                <div class="card shadow-lg border-0 rounded-4 dashboard-card bg-gradient-{{ $item['color'] }} text-white position-relative overflow-hidden h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3 bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="bi {{ $item['icon'] }} fs-2 text-white"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-0 text-white">{{ $item['count'] }}</h3>
                            <p class="mb-0 text-white">{{ $item['title'] }}</p>
                        </div>
                    </div>
                    <div class="animated-glow position-absolute top-0 end-0 w-100 h-100 opacity-25"></div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    {{-- Charts & Activity Section --}}
    <div class="row g-4 mt-4">
        {{-- Course Progress --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 fw-semibold">
                    <i class="bi bi-bar-chart-line text-primary me-2"></i> My Learning Progress
                </div>
                <div class="card-body">
                    <canvas id="progressChart" height="120"></canvas>
                </div>
            </div>
        </div>

        {{-- Recent Activities --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 fw-semibold">
                    <i class="bi bi-clock-history text-primary me-2"></i> Recent Activities
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item"><i class="bi bi-journal-check text-success me-2"></i> Submitted an assignment</li>
                        <li class="list-group-item"><i class="bi bi-calendar-day text-info me-2"></i> Marked attendance</li>
                        <li class="list-group-item"><i class="bi bi-book text-primary me-2"></i> Completed a course module</li>
                        <li class="list-group-item"><i class="bi bi-award text-warning me-2"></i> Received new certificate</li>
                        <li class="list-group-item"><i class="bi bi-chat-dots text-danger me-2"></i> Commented on project</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Styles --}}
<style>
    .dashboard-card {
        transition: all 0.3s ease;
    }
    .dashboard-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
    }

    .animated-glow {
        background: radial-gradient(circle at top right, rgba(255,255,255,0.3), transparent 70%);
        animation: glowMove 4s ease-in-out infinite alternate;
    }
    @keyframes glowMove {
        from { transform: translate(0,0); }
        to { transform: translate(-20px,20px); }
    }

    .bg-gradient-primary { background: linear-gradient(135deg, #007bff, #0056d2); }
    .bg-gradient-success { background: linear-gradient(135deg, #28a745, #1e7e34); }
    .bg-gradient-warning { background: linear-gradient(135deg, #ffc107, #d39e00); }
    .bg-gradient-info { background: linear-gradient(135deg, #17a2b8, #0d6670); }
    .bg-gradient-danger { background: linear-gradient(135deg, #dc3545, #a71d2a); }
</style>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('progressChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Attendances', 'Assignments', 'Projects', 'Courses', 'Certifications'],
            datasets: [{
                label: 'Count',
                data: [
                    {{ $attendanceCount }},
                    {{ $assignmentCount }},
                    {{ $projectCount }},
                    {{ $courseCount }},
                    {{ $certificationCount }}
                ],
                backgroundColor: [
                    'rgba(0, 123, 255, 0.7)',    // Primary blue
                    'rgba(40, 167, 69, 0.7)',    // Success green
                    'rgba(255, 193, 7, 0.7)',    // Warning yellow
                    'rgba(23, 162, 184, 0.7)',   // Info cyan
                    'rgba(220, 53, 69, 0.7)'     // Danger red
                ],
                borderColor: [
                    'rgba(0, 123, 255, 1)',
                    'rgba(40, 167, 69, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(23, 162, 184, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 1,
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: '#eee' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
});
</script>
@endsection
