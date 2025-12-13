@extends('layouts.app')
@section('title', 'My Courses')
@section('content')

<div class="container">
    @if($courses->count() > 0)
    <h2 class="mb-4"><strong>Courses Assigned to You</strong></h2>

    @foreach($courses as $course)
    <div class="card mb-4 shadow-sm p-3">
        <h4><strong>{{ $course->title }}</strong></h4>
        <!-- <p>{{ $course->description }}</p> -->

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Enrollment Status</th>
                    <th>Video Lectures</th>
                    <th>Assignments</th>
                    <th>Projects</th>
                    <th>Video Progress</th>
                    <th>Assignment Progress</th>
                    <th>Overall Progress</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($course->enrollments as $enroll)
                <tr>
                    <td>{{ $enroll->student->name }}</td>
                    <td>{{ $enroll->status }}</td>
                    <td>{{ $course->videos->count() }}</td>
                    <td>{{ $course->assignments->count() }}</td>
                    <td>{{ $course->projects->count() }}</td>
                    <td>
                        @php
                            $studentId = $enroll->student_id;

                            // Get all video IDs of this course
                            $courseVideoIds = $course->videos->pluck('id')->toArray();
                            $totalVideos = count($courseVideoIds);

                            // Count completed videos
                            $completedVideos = \App\Models\VideoCompletion::where('student_id', $studentId)
                                ->whereIn('video_id', $courseVideoIds)
                                ->where('is_completed', true)
                                ->count();

                            $progress = $totalVideos > 0 ? round(($completedVideos / $totalVideos) * 100) : 0;
                        @endphp

                        <div class="progress mt-1">
                            <div class="progress-bar bg-info"
                                style="width: {{ $progress }}%">
                                {{ $progress }}%
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="progress mt-1">
                            <div class="progress-bar bg-info"
                                style="width: {{ $enroll->assignment_progress }}%">
                                {{ $enroll->assignment_progress }}%
                            </div>
                        </div>
                    </td>
                    <td>
                        <!-- <strong>{{ $enroll->overall_progress }}%</strong> -->
                         <div class="progress mt-1">
                            <div class="progress-bar
                                {{ $enroll->overall_progress >= 80 ? 'bg-success' :
                                ($enroll->overall_progress >= 40 ? 'bg-warning' : 'bg-danger') }}"
                                style="width: {{ $enroll->overall_progress }}%">
                                {{ $enroll->overall_progress }}%
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('trainer.course.view', ['id' => $course->id, 'studentId' => $enroll->student_id]) }}" 
                            class="btn btn-sm btn-primary">
                        View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
    @else

    <div class="alert alert-info">
        <strong>No courses assigned to you yet.</strong>
    </div>
     @endif
</div>

@endsection
