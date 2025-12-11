<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Assignment;
use App\Models\VideoCompletion;

class TrainerCourseController extends Controller
{
    // Show all courses assigned to this trainer
    public function courses()
    {
        $trainerId = auth()->id();

        $courses = Course::with([
            'enrollments.student', // fetch enrolled students
            'videos',              // fetch lectures/videos
            'invoices'              // fetch invoice/payment info
        ])->where('trainer_id', $trainerId)->get();

        foreach ($courses as $course) {

            $courseVideoIds = $course->videos->pluck('id')->toArray();
            $totalVideos = count($courseVideoIds);

            foreach ($course->enrollments as $enroll) {

                $studentId = $enroll->student_id;

                // Count only videos belonging to this course
                $completedVideos = VideoCompletion::where('student_id', $studentId)
                    ->whereIn('video_id', $courseVideoIds)
                    ->where('is_completed', true)
                    ->count();

                $progress = $totalVideos > 0 
                    ? round(($completedVideos / $totalVideos) * 100)
                    : 0;

                $enroll->progress = $progress;
            }
        }

        return view('trainer.courses.index', compact('courses'));
    }

    // View a single course
    public function courseView($id,$studentId)
    {
        $course = Course::with([
            'enrollments.student',
            'videos',
            'invoices'
        ])->where('trainer_id', auth()->id())->findOrFail($id);

        $student = User::findOrFail($studentId);

        $courseVideoIds = $course->videos->pluck('id')->toArray();

        $completedVideos = VideoCompletion::where('student_id', $studentId)
            ->whereIn('video_id', $courseVideoIds)
            ->pluck('video_id')
            ->toArray();

        $totalVideos = count($courseVideoIds);
        $completedCount = count($completedVideos);

        $videoProgress = ($totalVideos > 0)
            ? round(($completedCount / $totalVideos) * 100)
            : 0;

        // Assignments
        // $assignments = Assignment::where('course_id', $courseId)->get();

        // $completedAssignments = AssignmentSubmission::where('student_id', $studentId)
        //                         ->pluck('assignment_id')
        //                         ->toArray();

        // $totalAssignments = $assignments->count();
        // $completedAssignmentsCount = count($completedAssignments);

        // $assignmentProgress = ($totalAssignments > 0)
        //     ? round(($completedAssignmentsCount / $totalAssignments) * 100)
        //     : 0;

        $assignments = Assignment::where('course_id', $course->id)
        ->where('trainer_id', auth()->id()) // optional: filter by trainer
        ->get();

            return view('trainer.courses.view', [
            'course' => $course,
            'student' => $student,
            'completedVideos' => $completedVideos,
            'videoProgress' => $videoProgress,
             'assignments' => $assignments,
            // 'completedAssignments' => $completedAssignments,
            // 'assignmentProgress' => $assignmentProgress
        ]);
    }
}
