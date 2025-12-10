@extends('layouts.app')

@section('title', 'Trainer Dashboard')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-0">
                <i class="bi bi-speedometer2 me-2"></i>Trainer Dashboard
            </h2>
            <small class="text-muted">Manage your batches, assignments, and attendance with ease.</small>
        </div>
        <p class="text-muted mb-0">
            Welcome, <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
        </p>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-4">

        {{-- Attendance --}}
        <div class="col-md-4 col-lg-4">
            <a href="{{ route('attendances.index') }}" class="text-decoration-none">
                <div class="card dashboard-card border-0 shadow-sm bg-gradient-primary text-white h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-circle bg-white bg-opacity-25 me-3">
                            <i class="bi bi-calendar-check display-6"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">{{ $attendanceCount }}</h4>
                            <small>Attendances</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Assignments --}}
        <div class="col-md-4 col-lg-4">
            <a href="{{ route('student.assignments.index') }}" class="text-decoration-none">
                <div class="card dashboard-card border-0 shadow-sm bg-gradient-success text-white h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-circle bg-white bg-opacity-25 me-3">
                            <i class="bi bi-graph-up display-6"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">{{ $assignmentCount }}</h4>
                            <small>Assignments</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Projects --}}
        <div class="col-md-4 col-lg-4">
            <a href="{{ route('student.projects.index') }}" class="text-decoration-none">
                <div class="card dashboard-card border-0 shadow-sm bg-gradient-warning text-white h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-circle bg-white bg-opacity-25 me-3">
                            <i class="bi bi-folder2-open display-6"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">{{ $projectCount }}</h4>
                            <small>Projects</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Optional: Add motivational quote --}}
    <div class="mt-5 text-center">
        <p class="text-muted fst-italic">
            “A great trainer inspires, empowers, and creates future leaders.”
        </p>
    </div>

    {{-- Charts Section --}}
<div class="row g-4 mt-4">
    <div class="col-lg-8">
    <!-- <div class="card ...">
        <div class="card-body">
            <canvas id="trainerChart" height="120"></canvas>
        </div>
    </div> -->
    <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 fw-semibold">
                    <i class="bi bi-bar-chart-line text-primary me-2"></i> Activity Overview
                </div>
                <div class="card-body">
                    <canvas id="trainerChart" height="120"></canvas>
                </div>
            </div>
</div>

</div>


</div>

{{-- Styles --}}
<style>
    .dashboard-card {
        border-radius: 1rem;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .dashboard-card::after {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .dashboard-card:hover::after {
        opacity: 1;
    }

    .dashboard-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df, #224abe);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #1cc88a, #13855c);
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, #f6c23e, #dda20a);
    }

    .text-muted small {
        font-size: 0.85rem;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('trainerChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Attendances', 'Assignments', 'Projects'],
            datasets: [{
                label: 'Count',
                data: [
                    {{ $attendanceCount }},
                    {{ $assignmentCount }},
                    {{ $projectCount }}
                ],
                backgroundColor: [
                    'rgba(0, 123, 255, 0.7)',   // Primary blue
                    'rgba(40, 167, 69, 0.7)',   // Success green
                    'rgba(255, 193, 7, 0.7)'    // Warning yellow
                ],
                borderColor: [
                    'rgba(0, 123, 255, 1)',
                    'rgba(40, 167, 69, 1)',
                    'rgba(255, 193, 7, 1)'
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
