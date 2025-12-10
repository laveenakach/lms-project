@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">

    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">
                <i class="bi bi-speedometer2 me-2"></i> Admin Dashboard
            </h2>
            <p class="text-muted">Welcome back, <strong>{{ Auth::user()->name }}</strong> 👋</p>
        </div>
        <div>
            <button class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> New Entry
            </button>
        </div>
    </div>

    {{-- Stats Section --}}
    <div class="row g-4">
        @php
            $stats = [
                ['title'=>'Users','count'=>$usersCount,'icon'=>'bi-people','color'=>'success','route'=>'admin.users.index'],
                ['title'=>'Attendances','count'=>$attendanceCount,'icon'=>'bi-calendar-check','color'=>'primary','route'=>'attendances.index'],
                ['title'=>'Courses','count'=>$courseCount,'icon'=>'bi-book','color'=>'info','route'=>'courses.index'],
                ['title'=>'Notifications','count'=>$notificationCount,'icon'=>'bi-kanban','color'=>'warning','route'=>'notifications.index'],
                ['title'=>'Certifications','count'=>$certificationCount,'icon'=>'bi-award','color'=>'danger','route'=>'certifications.index'],
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
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 fw-semibold">
                    <i class="bi bi-bar-chart-line me-2 text-primary"></i> Activity Overview
                </div>
                <div class="card-body">
                    <canvas id="activityChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 fw-semibold">
                    <i class="bi bi-clock-history me-2 text-primary"></i> Recent Activities
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item"><i class="bi bi-check-circle text-success me-2"></i> New user registered</li>
                        <li class="list-group-item"><i class="bi bi-calendar-event text-info me-2"></i> Attendance updated</li>
                        <li class="list-group-item"><i class="bi bi-award text-warning me-2"></i> Certification issued</li>
                        <li class="list-group-item"><i class="bi bi-envelope text-primary me-2"></i> Notification sent</li>
                        <li class="list-group-item"><i class="bi bi-person-gear text-danger me-2"></i> Admin modified settings</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Dashboard Custom Styles --}}
<style>
    .dashboard-card {
        transition: all 0.3s ease;
        position: relative;
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
    const ctx = document.getElementById('activityChart');

    new Chart(ctx, {
        type: 'bar', // Bar chart
        data: {
            labels: ['Users', 'Attendances', 'Courses', 'Notifications', 'Certifications'],
            datasets: [{
                label: 'Count',
                data: [
                    {{ $usersCount }},
                    {{ $attendanceCount }},
                    {{ $courseCount }},
                    {{ $notificationCount }},
                    {{ $certificationCount }}
                ],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.7)',    // Success green
                    'rgba(0, 123, 255, 0.7)',    // Primary blue
                    'rgba(23, 162, 184, 0.7)',   // Info cyan
                    'rgba(255, 193, 7, 0.7)',    // Warning yellow
                    'rgba(220, 53, 69, 0.7)'     // Danger red
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)',
                    'rgba(0, 123, 255, 1)',
                    'rgba(23, 162, 184, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 1
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
