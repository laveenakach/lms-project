<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
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
    public function courseView($id)
    {
        $course = Course::with([
            'enrollments.student',
            'videos',
            'invoices'
        ])->where('trainer_id', auth()->id())->findOrFail($id);

        return view('trainer.courses.view', compact('course'));
    }
}
