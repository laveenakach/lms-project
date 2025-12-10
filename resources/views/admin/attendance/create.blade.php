@extends('layouts.app')
@section('title', isset($attendance) ? 'Edit Attendance' : 'Add Attendance')

@section('content')
<div class="card shadow-sm border-0 w-100 mx-auto" style="max-width: 700px;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-calendar-plus me-2"></i> 
            {{ isset($attendance) ? 'Edit Attendance' : 'Add Attendance' }}
        </h5>
        <a href="{{ route('attendances.index') }}" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body">
        <form method="POST" 
              action="{{ isset($attendance) ? route('attendances.update', $attendance->id) : route('attendances.store') }}">
            @csrf
            @if(isset($attendance)) @method('PUT') @endif

            <div class="row g-3">
                <!-- User -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Select User</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Select User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" 
                                {{ isset($attendance) && $attendance->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date</label>
                    <input type="date" name="date" class="form-control"
                           value="{{ old('date', $attendance->date ?? now()->toDateString()) }}" required>
                </div>

                <!-- Check in/out -->
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Check In</label>
                    <input type="time" name="check_in" class="form-control" 
                           value="{{ old('check_in', $attendance->check_in ?? '') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Check Out</label>
                    <input type="time" name="check_out" class="form-control" 
                           value="{{ old('check_out', $attendance->check_out ?? '') }}">
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="Present" {{ old('status', $attendance->status ?? '') == 'Present' ? 'selected' : '' }}>Present</option>
                        <option value="Absent" {{ old('status', $attendance->status ?? '') == 'Absent' ? 'selected' : '' }}>Absent</option>
                        <option value="Leave" {{ old('status', $attendance->status ?? '') == 'Leave' ? 'selected' : '' }}>Leave</option>
                    </select>
                </div>

                <!-- Remarks -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Remarks</label>
                    <textarea name="remarks" rows="3" class="form-control" placeholder="Enter remarks...">{{ old('remarks', $attendance->remarks ?? '') }}</textarea>
                </div>

                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save me-1"></i> 
                        {{ isset($attendance) ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
