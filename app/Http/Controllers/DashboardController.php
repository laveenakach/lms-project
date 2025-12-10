<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Assignment;
use App\Models\Project;
use App\Models\Course;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Certification;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Only show counts if admin is logged in
        if (Auth::user()->role === 'admin') {
            $data = [
                'usersCount' => User::count(),
                'attendanceCount' => Attendance::count(),
                'courseCount' => Course::count(),
                'certificationCount' => Certification::count(),
                'notificationCount' => Notification::count(),
            ];
            return view('admin.dashboard', $data);
        }

        return redirect()->route('home');
    }

    public function studentdashboard()
    {
        $userId = Auth::id();

        $courseIds = \DB::table('course_enrollments')
        ->where('student_id', $userId)
        ->pluck('course_id');

        $attendanceCount = Attendance::where('user_id', $userId)->count();
        $assignmentCount = Assignment::whereIn('course_id', $courseIds)->count();
        $projectCount = Project::where('student_id', $userId)->count();
        $courseCount = Course::where('student_id', $userId)->count();
        $certificationCount = Certification::where('student_id', $userId)->count();
    
        return view('student.dashboard', compact(
            'attendanceCount',
            'assignmentCount',
            'projectCount',
            'courseCount',
            'certificationCount'
        ));
    }

    public function trainerdashboard()
    {
        $attendanceCount = Attendance::where('user_id', Auth::id())->count();
        $assignmentCount = Assignment::where('trainer_id', Auth::id())->count();
        $projectCount = Project::where('trainer_id', Auth::id())->count();

        return view('trainer.dashboard', compact(
            'attendanceCount',
            'assignmentCount',
            'projectCount'
        ));
    }
}
